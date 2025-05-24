@extends('layouts.app')

@section('title', 'Tambah Event')

@section('content')
<div class="container py-4">
  <h3 class="mb-4">Tambah Event</h3>
  <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Judul Event</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea name="description" id="description" class="form-control" rows="5">{{ old('description') }}</textarea>
    </div>
    <div class="mb-3">
        <label for="event_date" class="form-label">Tanggal Event</label>
        <input type="date" name="event_date" id="event_date" class="form-control" value="{{ old('event_date') }}">
    </div>
    <div class="mb-3">
        <label for="thumbnail" class="form-label">Thumbnail (Gambar)</label>
        <input type="file" name="thumbnail" id="thumbnail" class="form-control">
    </div>
    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection