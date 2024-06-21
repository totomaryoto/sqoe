@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Dealer</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-folder"></i> Tambah Dealer</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.dealer.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>CODE</label>
                            <input type="text" name="dealer_code" value="{{ old('dealer_code') }}" placeholder="Masukkan Code" class="form-control @error('dealer_code') is-invalid @enderror">

                            @error('dealer_code')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>NAME</label>
                            <input type="text" name="dealer_name" value="{{ old('dealer_name') }}" placeholder="Masukkan Nama" class="form-control @error('dealer_name') is-invalid @enderror">

                            @error('dealer_name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>PROVINCE</label>
                            <input type="text" name="province" value="{{ old('province') }}" placeholder="Masukkan province" class="form-control @error('province') is-invalid @enderror">

                            @error('province')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>ADDRESS</label>
                            <input type="text" name="address" value="{{ old('address') }}" placeholder="Masukkan address" class="form-control @error('address') is-invalid @enderror">

                            @error('address')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>PHONE</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Masukkan phone" class="form-control @error('phone') is-invalid @enderror">

                            @error('phone')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>INSTAGRAM</label>
                            <input type="text" name="instagram" value="{{ old('instagram') }}" placeholder="Masukkan instagram" class="form-control @error('instagram') is-invalid @enderror">

                            @error('instagram')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>FACEBOOK</label>
                            <input type="text" name="facebook" value="{{ old('facebook') }}" placeholder="Masukkan facebook" class="form-control @error('facebook') is-invalid @enderror">

                            @error('facebook')
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