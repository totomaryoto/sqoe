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
                    <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>CODE</label>
                            <input type="text" name="category_code" value="{{ old('category_code', $category->category_code) }}" placeholder=" Masukkan Code" class="form-control @error('category_code') is-invalid @enderror">

                            @error('category_code')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>NAME</label>
                            <input type="text" name="category_name" value="{{ old('category_name', $category->category_name) }}" placeholder=" Masukkan Nama" class="form-control @error('name') is-invalid @enderror">

                            @error('category_name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>PRICE</label>
                            <input type="number" name="price" value="{{ old('price', $category->price) }}" placeholder=" Masukkan Price" class="form-control @error('price') is-invalid @enderror">

                            @error('price')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>VERSATILITY</label>
                            <input type="number" name="versatility" value="{{ old('versatility', $category->versatility) }}" placeholder=" Masukkan Versatility" class="form-control @error('versatility') is-invalid @enderror">

                            @error('versatility')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>SOUND</label>
                            <input type="text" name="sound" value="{{ old('sound', $category->sound) }}" placeholder=" Masukkan sound" class="form-control @error('sound') is-invalid @enderror">

                            @error('sound')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>DURABILITY</label>
                            <input type="text" name="durability" value="{{ old('durability', $category->durability) }}" placeholder="Masukkan durability" class="form-control @error('durability') is-invalid @enderror">

                            @error('durability')
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