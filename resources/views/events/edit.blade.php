@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
<div class="container py-4">
  <h3 class="mb-4">Edit Event</h3>
  <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="name">Nama Event</label>
      <input type="text" name="name" id="name" class="form-control" value="{{ $event->name }}" required>
    </div>
    <div class="mb-3">
      <label for="date">Tanggal</label>
      <input type="date" name="date" id="date" class="form-control" value="{{ $event->date }}" required>
    </div>
    <div class="mb-3">
      <label for="image">Gambar</label>
      <input type="file" name="image" id="image" class="form-control">
      @if($event->image)
        <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" width="100" class="mt-2">
      @endif
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('events.index') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection