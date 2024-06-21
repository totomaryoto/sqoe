@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Blog</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-folder"></i> Tambah Blog</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>IMAGE</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">

                            @error('image')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>CATEGORY BLOG CODE</label>
                            <input type="text" name="category_blog_code" value="{{ old('category_blog_code') }}" placeholder="Masukkan Code" class="form-control @error('category_blog_code') is-invalid @enderror">

                            @error('category_blog_code')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>BLOG CODE</label>
                            <input type="text" name="blog_code" value="{{ old('blog_code') }}" placeholder="Masukkan Code" class="form-control @error('blog_code') is-invalid @enderror">

                            @error('blog_code')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        

                        <div class="form-group">
                            <label>BLOG TITLE</label>
                            <input type="text" name="blog_title" value="{{ old('blog_title') }}" placeholder="Masukkan Nama" class="form-control @error('blog_title') is-invalid @enderror">

                            @error('blog_title')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>DESCRIPTION</label>
                            <textarea class="form-control content @error('description') is-invalid @enderror" name="description" placeholder="Masukkan Deskripsi" rows="10">{!! old('description') !!}</textarea>
                            @error('description')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>META TITLE</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title') }}" placeholder="Masukkan Nama" class="form-control @error('meta_title') is-invalid @enderror">

                            @error('meta_title')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>META DESCRIPTION</label>
                            <input type="text" name="meta_description" value="{{ old('meta_description') }}" placeholder="Masukkan Nama" class="form-control @error('meta_description') is-invalid @enderror">

                            @error('meta_description')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
<script>
    var editor_config = {
        selector: "textarea.content",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
    };

    tinymce.init(editor_config);
</script>
@stop