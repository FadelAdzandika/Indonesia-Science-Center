@extends('layouts.app') {{-- Atau layout admin Anda --}}

@section('title', 'Edit Kompetisi')

@section('content')
<div class="container py-4">
    <h1>Edit Kompetisi: {{ $competition->title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.competitions.update', $competition->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Judul Kompetisi</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $competition->title) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $competition->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $competition->start_date ? $competition->start_date->format('Y-m-d') : '') }}">
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Tanggal Selesai</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $competition->end_date ? $competition->end_date->format('Y-m-d') : '') }}">
        </div>
        <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail (Gambar)</label>
            <input type="file" class="form-control" id="thumbnail" name="thumbnail">
            @if($competition->thumbnail)
                <img src="{{ asset('public/uploads/' . $competition->thumbnail) }}" alt="{{ $competition->title }}" width="150" class="mt-2">
                <p><small>Kosongkan jika tidak ingin mengganti thumbnail.</small></p>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update Kompetisi</button>
        <a href="{{ route('admin.competitions.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection