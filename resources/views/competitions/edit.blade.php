@extends('layouts.app')

@section('title', 'Edit Kompetisi')

@section('content')
<div class="container py-4">
  <h3 class="mb-4">Edit Kompetisi</h3>
  <form method="POST" action="{{ route('competitions.update', $competition) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label>Nama Kompetisi</label>
      <input type="text" name="name" class="form-control" value="{{ $competition->name }}" required>
    </div>
    <div class="mb-3">
      <label>Tanggal</label>
      <input type="date" name="date" class="form-control" value="{{ $competition->date }}">
    </div>
    <div class="mb-3">
      <label>Gambar</label>
      <input type="file" name="image" class="form-control">
      @if($competition->image)
        <img src="{{ asset('storage/' . $competition->image) }}" alt="Gambar Kompetisi" width="100">
      @endif
    </div>
    <button class="btn btn-success">Update</button>
    <a href="{{ route('competitions.index') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection