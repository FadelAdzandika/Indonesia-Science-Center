@extends('layouts.app')

@section('title', 'Edit Wahana: ' . $wahana->name)

@section('content')
<div class="container py-5">
    <h1>Edit Wahana: {{ $wahana->name }}</h1>

    <form action="{{ route('admin.wahana.update', $wahana->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Wahana</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $wahana->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $wahana->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Wahana (Kosongkan jika tidak ingin mengubah)</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
            @if ($wahana->image)
                <div class="mt-2">
                    <img src="{{ asset('public/uploads/' . $wahana->image) }}" alt="{{ $wahana->name }}" style="max-height: 150px; border-radius: 8px;">
                    <p class="small text-muted">Gambar saat ini</p>
                </div>
            @endif
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Field Baru untuk Video Embed URL --}}
        <div class="mb-3">
            <label for="video_embed_url" class="form-label">URL Video Embed (Contoh: https://www.youtube.com/embed/KODE_VIDEO)</label>
            <input type="url" class="form-control @error('video_embed_url') is-invalid @enderror" id="video_embed_url" name="video_embed_url" value="{{ old('video_embed_url', $wahana->video_embed_url) }}" placeholder="Masukkan URL embed video">
            <small class="form-text text-muted">Kosongkan jika tidak ada video. Pastikan URL adalah URL embed, bukan URL halaman biasa.</small>
            @if ($wahana->video_embed_url)
                <div class="mt-2">
                    <p class="small text-muted">Video saat ini:</p>
                    <div class="ratio ratio-16x9" style="max-width: 400px;">
                        <iframe src="{{ $wahana->video_embed_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
            @endif
            @error('video_embed_url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="icon" class="form-label">Ikon (Bootstrap Icon Class)</label>
            <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $wahana->icon) }}">
            @error('icon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">Warna (Bootstrap Text Color Class)</label>
            <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color', $wahana->color) }}">
            @error('color')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_new" name="is_new" value="1" {{ old('is_new', $wahana->is_new) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_new">Tandai sebagai Wahana Baru</label>
        </div>

        <button type="submit" class="btn btn-primary">Update Wahana</button>
        <a href="{{ route('admin.wahana.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
