@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title }}</h4>
                <div class="card-header-action">
                    <button id="btn-back" class="btn btn-primary">
                        Kembali
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.setting.simpan') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- About Section -->
                    <div class="form-group">
                        <label for="">About</label>
                        <textarea name="about"
                            class="ckeditor @error('about') is-invalid @enderror" id="ckeditor">
                        {{ $setting->about }}
                    </textarea>
                        @error('about')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Harga Akun Berbayar Section -->
                    <div class="form-group">
                        <label for="">Harga Akun Berbayar</label>
                        <input type="text" name="harga" class="form-control @error('harga') is-invalid @enderror"
                            value="{{ $setting->harga }}">
                        @error('harga')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- No Rekening Section -->
                    <div class="form-group">
                        <label for="">No Rekening</label>
                        <input type="text" name="no_rekening" class="form-control @error('no_rekening') is-invalid @enderror"
                            value="{{ $rekening->no_rekening }}">
                        @error('no_rekening')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Atas Nama Section -->
                    <div class="form-group">
                        <label for="">Atas Nama</label>
                        <input type="text" name="atas_nama" class="form-control @error('atas_nama') is-invalid @enderror"
                            value="{{ $rekening->atas_nama }}">
                        @error('atas_nama')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-success">Perbaharui Pengaturan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
