@extends('layouts.app')

@section('title', 'Tambah Kompetisi')

@section('content')
<div class="container py-4">
  <h3 class="mb-4">Tambah Kompetisi</h3>
  <form method="POST" action="{{ route('competitions.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Nama Kompetisi</label>
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
    <a href="{{ route('competitions.index') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection