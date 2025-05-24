@extends('layouts.app') {{-- Atau layout admin Anda jika berbeda --}}

@section('title', 'Tambah Wahana Baru')

@section('content')
<div class="container py-4">
    <h1>Tambah Wahana Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.wahanas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Wahana <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar Wahana (Opsional)</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_new" name="is_new" value="1" @checked(old('is_new'))>
            <label class="form-check-label" for="is_new">Tandai sebagai Wahana Terbaru</label>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Wahana</button>
        <a href="{{ route('admin.wahanas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection