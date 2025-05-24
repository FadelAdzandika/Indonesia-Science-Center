@extends('layouts.app') {{-- Atau layout admin Anda jika berbeda --}}

@section('title', 'Edit Wahana: ' . $wahana->name)

@section('content')
<div class="container py-4">
    <h1>Edit Wahana: {{ $wahana->name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.wahanas.update', $wahana->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama Wahana <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $wahana->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $wahana->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar Wahana (Opsional)</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($wahana->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $wahana->image) }}" alt="{{ $wahana->name }}" width="150" style="object-fit: cover;">
                    <p><small>Gambar saat ini. Kosongkan jika tidak ingin mengganti gambar.</small></p>
                </div>
            @endif
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_new" name="is_new" value="1" @checked(old('is_new', $wahana->is_new))>
            <label class="form-check-label" for="is_new">Tandai sebagai Wahana Terbaru</label>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection