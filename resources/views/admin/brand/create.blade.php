@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Brand</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-folder"></i> Tambah Brand</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.brand.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>CODE</label>
                            <input type="text" name="brand_code" value="{{ old('brand_code') }}" placeholder="Masukkan Code" class="form-control @error('brand_code') is-invalid @enderror">

                            @error('brand_code')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>NAME</label>
                            <input type="text" name="brand_name" value="{{ old('brand_name') }}" placeholder="Masukkan Nama" class="form-control @error('brand_name') is-invalid @enderror">

                            @error('brand_name')
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
@stop