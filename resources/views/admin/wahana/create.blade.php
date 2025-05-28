@extends('layouts.app')

@section('title', 'Tambah Wahana Baru')

@section('content')
<div class="container py-5">
    <h1>Tambah Wahana Baru</h1>

    <form action="{{ route('admin.wahana.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Wahana</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Wahana</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Field Baru untuk Video Embed URL --}}
        <div class="mb-3">
            <label for="video_embed_url" class="form-label">URL Video Embed (Contoh: https://www.youtube.com/embed/KODE_VIDEO)</label>
            <input type="url" class="form-control @error('video_embed_url') is-invalid @enderror" id="video_embed_url" name="video_embed_url" value="{{ old('video_embed_url') }}" placeholder="Masukkan URL embed video">
            <small class="form-text text-muted">Kosongkan jika tidak ada video. Pastikan URL adalah URL embed, bukan URL halaman biasa.</small>
            @error('video_embed_url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_new" name="is_new" value="1" {{ old('is_new') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_new">Tandai sebagai Wahana Baru</label>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Wahana</button>
        <a href="{{ route('admin.wahana.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
