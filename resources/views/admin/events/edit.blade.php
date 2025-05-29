@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
<div class="container py-4">
  <h3 class="mb-4">Edit Event</h3>
  <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="title" class="form-label">Judul Event</label>
      <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $event->title) }}" required>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Deskripsi</label>
      <textarea name="description" id="description" class="form-control" rows="5">{{ old('description', $event->description) }}</textarea>
    </div>
    <div class="mb-3">
      <label for="event_date" class="form-label">Tanggal Event</label>
      <input type="date" name="event_date" id="event_date" class="form-control" value="{{ old('event_date', optional($event->event_date)->format('Y-m-d')) }}">
    </div>
    <div class="mb-3">
      <label for="thumbnail" class="form-label">Thumbnail (Gambar)</label>
      <input type="file" name="thumbnail" id="thumbnail" class="form-control">
      @if($event->thumbnail)
        <img src="{{ asset('publicuploads/' . $event->thumbnail) }}" alt="Event Thumbnail" width="100" class="mt-2">
        <p><small>Kosongkan jika tidak ingin mengganti thumbnail.</small></p>
      @endif
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection