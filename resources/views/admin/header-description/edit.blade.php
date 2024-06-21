@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Kategori</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-folder"></i> Edit Kategori</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.header-description.update', $header_description->id) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>IMAGE</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        </div>

                        <div class="form-group">
                            <label>CODE</label>
                            <input type="text" name="header_code" value="{{ old('header_code', $header_description->header_code) }}" placeholder=" Masukkan Code" class="form-control @error('header_code') is-invalid @enderror">

                            @error('header_code')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>TITLE</label>
                            <input type="text" name="title" value="{{ old('title', $header_description->title) }}" placeholder=" Masukkan Nama" class="form-control @error('name') is-invalid @enderror">

                            @error('title')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>DESCRIPTION</label>
                            <input type="text" name="description" value="{{ old('description', $header_description->description) }}" placeholder=" Masukkan description" class="form-control @error('description') is-invalid @enderror">

                            @error('description')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> UPDATE</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@stop