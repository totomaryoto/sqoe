<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::latest()->when(request()->q, function ($blogs) {
            $blogs = $blogs->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
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
            'blog_code' => 'required|unique:blogs'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/blogs', $image->hashName());

        $blog = Blog::create([
            'image_thumb'        => $image->hashName(),
            'category_blog_code' => $request->input('category_blog_code'),
            'blog_code'          => $request->input('blog_code'),
            'blog_title'         => $request->input('blog_title'),
            'blog_short'         => Str::slug($request->input('blog_title'), '-'),
            'description'        => $request->input('description'),
            'meta_title'         => $request->input('meta_title'),
            'meta_description'   => $request->input('meta_description'),
            'modified_by'        => auth()->user()->name,
        ]);

        if ($blog) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.blog.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.blog.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $this->validate($request, [
            'blog_code' => 'required|unique:blogs,blog_code,' . $blog->id
        ]);

        if ($request->file('image') == "") {

            $blog = Blog::findOrFail($blog->id);
            $blog->update([
                'blog_code'          => $request->input('blog_code'),
                'blog_title'         => $request->input('blog_title'),
                'blog_short'         => Str::slug($request->input('blog_title'), '-'),
                'description'        => $request->input('description'),
                'meta_title'         => $request->input('meta_title'),
                'meta_description'   => $request->input('meta_description'),
                'modified_by'        => auth()->user()->name,
            ]);
        } else {

            //remove old image
            Storage::disk('local')->delete('public/blogs/' . $blog->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/blogs', $image->hashName());

            $blog = Blog::findOrFail($blog->id);
            $blog->update([
                'image'              => $image->hashName(),
                'blog_code'          => $request->input('blog_code'),
                'blog_title'         => $request->input('blog_title'),
                'blog_short'         => Str::slug($request->input('blog_title'), '-'),
                'description'        => $request->input('description'),
                'meta_title'         => $request->input('meta_title'),
                'meta_description'   => $request->input('meta_description'),
                'modified_by'        => auth()->user()->name,
            ]);
        }

        if ($blog) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.blog.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.blog.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $blog = Blog::findOrFail($id);
        $blog->delete();

        if ($blog) {
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
