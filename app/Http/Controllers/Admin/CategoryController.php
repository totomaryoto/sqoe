<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->when(request()->q, function ($categories) {
            $categories = $categories->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'category_code' => 'required|unique:categories'
        ]);

        $category = Category::create([
            'category_code' => $request->input('category_code'),
            'category_name' => $request->input('category_name'),
            'price'         => $request->input('price'),
            'versatility'   => $request->input('versatility'),
            'sound'         => $request->input('sound'),
            'durability'    => $request->input('durability'),
            'modified_by'   => auth()->user()->name,
        ]);

        if ($category) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.category.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.category.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'category_code' => 'required|unique:categories,category_code,' . $category->id
        ]);

        $category = Category::findOrFail($category->id);
        $category->update([
            'category_code' => $request->input('category_code'),
            'category_name' => $request->input('category_name'),
            'price'         => $request->input('price'),
            'versatility'   => $request->input('versatility'),
            'sound'         => $request->input('sound'),
            'durability'    => $request->input('durability'),
            'modified_by'   => auth()->user()->name,
        ]);

        if ($category) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.category.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.category.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $category = Category::findOrFail($id);
        $category->delete();

        if ($category) {
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
