@extends('layouts.app')

@section('title', 'Tambah Event')

@section('content')
<div class="container py-4">
  <h3 class="mb-4">Tambah Event</h3>
  <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Nama Event</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="date" class="form-control">
    </div>
    <div class="mb-3">
        <label>Gambar</label>
        <input type="file" name="image" class="form-control">
    </div>
    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('events.index') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection