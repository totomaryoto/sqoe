<?php

namespace App\Http\Controllers\Admin;

use App\Models\HeaderDescription;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeaderDescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header_descriptions = HeaderDescription::latest()->when(request()->q, function ($header_descriptions) {
            $header_descriptions = $header_descriptions->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.header-description.index', compact('header_descriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.header-description.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'header_code' => 'required|unique:header_descriptions'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/headers', $image->hashName());

        $header_description = HeaderDescription::create([
            'image'             => $image->hashName(),
            'header_code'       => $request->input('header_code'),
            'title'             => $request->input('title'),
            'description'       => $request->input('description'),
            'modified_by'       => auth()->user()->name,
        ]);

        if ($header_description) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.header-description.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.header-description.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(HeaderDescription $header_description)
    {
        return view('admin.header-description.edit', compact('header_description'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HeaderDescription $header_description)
    {
        $this->validate($request, [
            'header_code' => 'required|unique:header_descriptions,header_code,' . $header_description->id
        ]);

        if ($request->file('image') == "") {
            $header_description = HeaderDescription::findOrFail($header_description->id);

            $header_description->update([

                'header_code'       => $request->input('header_code'),
                'title'             => $request->input('title'),
                'description'       => $request->input('description'),
                'modified_by'       => auth()->user()->name,
            ]);
        } else {

            //remove old image
            Storage::disk('local')->delete('public/headers/' . $header_description->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/headers', $image->hashName());

            $header_description = HeaderDescription::findOrFail($header_description->id);
            $header_description->update([
                'image'             => $image->hashName(),
                'header_code'       => $request->input('header_code'),
                'title'             => $request->input('title'),
                'description'       => $request->input('description'),
                'modified_by'       => auth()->user()->name,
            ]);
        }

        if ($header_description) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.header-description.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.header-description.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $header_description = HeaderDescription::findOrFail($id);
        $image = Storage::disk('local')->delete('public/headers/' . basename($header_description->image));
        $header_description->delete();

        if ($header_description) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
