<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dealer;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dealers = Dealer::latest()->when(request()->q, function ($dealers) {
            $dealers = $dealers->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.dealer.index', compact('dealers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dealer.create');
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
            'dealer_code' => 'required|unique:dealers'
        ]);

        $dealer = Dealer::create([
            'dealer_code'    => $request->input('dealer_code'),
            'dealer_name'    => $request->input('dealer_name'),
            'province'       => $request->input('province'),
            'address'        => $request->input('address'),
            'phone'          => $request->input('phone'),
            'instagram'      => $request->input('instagram'),
            'facebook'       => $request->input('facebook'),
            'modified_by'   => auth()->user()->name,
        ]);

        if ($dealer) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.dealer.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.dealer.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dealer $dealer)
    {
        return view('admin.dealer.edit', compact('dealer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dealer $dealer)
    {
        $this->validate($request, [
            'dealer_code' => 'required|unique:dealers,dealer_code,' . $dealer->id
        ]);

        $dealer = Dealer::findOrFail($dealer->id);
        $dealer->update([
            'dealer_code'    => $request->input('dealer_code'),
            'dealer_name'    => $request->input('dealer_name'),
            'province'       => $request->input('province'),
            'address'        => $request->input('address'),
            'phone'          => $request->input('phone'),
            'instagram'      => $request->input('instagram'),
            'facebook'       => $request->input('facebook'),
            'modified_by'   => auth()->user()->name,
        ]);

        if ($dealer) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.dealer.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.dealer.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $dealer = Dealer::findOrFail($id);
        $dealer->delete();

        if ($dealer) {
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
