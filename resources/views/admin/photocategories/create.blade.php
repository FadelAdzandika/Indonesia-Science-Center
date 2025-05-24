@extends('layouts.app') {{-- Atau layout admin Anda jika berbeda --}}

@section('title', 'Tambah Kategori Foto Baru')

@section('content')
<div class="container py-4">
    <h1>Tambah Kategori Foto Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.photo-categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi (Opsional)</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Kategori</button>
        <a href="{{ route('admin.photo-categories.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection