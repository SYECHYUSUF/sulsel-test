@extends('admin.layouts.app')

@section('title', isset($item) ? 'Edit Pekerjaan' : 'Tambah Pekerjaan')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">{{ isset($item) ? 'Edit' : 'Tambah' }} Pekerjaan</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ isset($item) ? route('master-pekerjaan.update', $item->id) : route('master-pekerjaan.store') }}" method="POST">
                @csrf
                @if(isset($item))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="nama_pekerjaan">Nama Pekerjaan <span class="text-danger">*</span></label>
                    <input type="text" name="nama_pekerjaan" id="nama_pekerjaan" 
                           class="form-control @error('nama_pekerjaan') is-invalid @enderror" 
                           value="{{ old('nama_pekerjaan', $item->nama_pekerjaan ?? '') }}" required>
                    @error('nama_pekerjaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1"
                               {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_active">Aktif</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('master-pekerjaan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
