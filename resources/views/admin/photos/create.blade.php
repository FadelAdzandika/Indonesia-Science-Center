@extends('layouts.app') {{-- Atau layout admin Anda --}}

@section('title', 'Tambah Foto Baru')

@section('content')
<div class="container py-4">
    <h1>Tambah Foto Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.photos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="photo_category_id" class="form-label">Kategori Foto <span class="text-danger">*</span></label>
            <select class="form-select" id="photo_category_id" name="photo_category_id" required>
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('photo_category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Judul Foto (Opsional)</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">File Gambar <span class="text-danger">*</span></label>
            <input type="file" class="form-control" id="image" name="image" required accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
            <div class="form-text">Format yang didukung: JPG, JPEG, PNG, GIF, WEBP. Maksimal 2MB.</div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi (Opsional)</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Foto</button>
        <a href="{{ route('admin.photos.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection