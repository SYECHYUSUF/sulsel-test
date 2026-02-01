@extends('admin.layouts.app')

@section('title', isset($item) ? 'Edit Domisili' : 'Tambah Domisili')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">{{ isset($item) ? 'Edit' : 'Tambah' }} Domisili</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ isset($item) ? route('master-domisili.update', $item->id) : route('master-domisili.store') }}" method="POST">
                @csrf
                @if(isset($item))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="nama_daerah">Nama Daerah <span class="text-danger">*</span></label>
                    <input type="text" name="nama_daerah" id="nama_daerah" 
                           class="form-control @error('nama_daerah') is-invalid @enderror" 
                           value="{{ old('nama_daerah', $item->nama_daerah ?? '') }}" 
                           placeholder="Contoh: Kota Makassar" required>
                    @error('nama_daerah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
                    <input type="text" name="provinsi" id="provinsi" 
                           class="form-control @error('provinsi') is-invalid @enderror" 
                           value="{{ old('provinsi', $item->provinsi ?? 'Sulawesi Selatan') }}" required>
                    @error('provinsi')
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
                    <a href="{{ route('master-domisili.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
