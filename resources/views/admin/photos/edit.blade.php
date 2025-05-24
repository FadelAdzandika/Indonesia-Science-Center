@extends('layouts.app') {{-- Atau layout admin Anda --}}

@section('title', 'Edit Foto: ' . ($photo->title ?? 'ID ' . $photo->id))

@section('content')
<div class="container py-4">
    <h1>Edit Foto: {{ $photo->title ?? 'ID ' . $photo->id }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.photos.update', $photo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="photo_category_id" class="form-label">Kategori Foto <span class="text-danger">*</span></label>
            <select class="form-select" id="photo_category_id" name="photo_category_id" required>
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('photo_category_id', $photo->photo_category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Judul Foto (Opsional)</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $photo->title) }}">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Ganti File Gambar (Opsional)</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
            <div class="form-text">Kosongkan jika tidak ingin mengganti gambar. Format yang didukung: JPG, JPEG, PNG, GIF, WEBP. Maksimal 2MB.</div>
            @if ($photo->image_path)
                <div class="mt-2">
                    <p>Gambar saat ini:</p>
                    {{-- Sesuaikan path jika Anda menggunakan disk 'public' dan storage:link --}}
                    {{-- <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->title ?? 'Foto' }}" width="150" class="img-thumbnail"> --}}
                    <img src="{{ asset('uploads/' . $photo->image_path) }}" alt="{{ $photo->title ?? 'Foto' }}" width="150" class="img-thumbnail">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi (Opsional)</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $photo->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('admin.photos.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection