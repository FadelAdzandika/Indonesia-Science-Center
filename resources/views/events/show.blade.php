@extends('layouts.app')

@section('title', $event->name)

@section('content')
<div class="container py-4">
  <h3 class="mb-4">{{ $event->name }}</h3>
  @if($event->image)
    <div class="mb-3">
      <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" class="img-fluid">
    </div>
  @endif
  <p><strong>Tanggal:</strong> {{ $event->date }}</p>
  <a href="{{ route('events.index') }}" class="btn btn-secondary">Kembali ke Daftar Event</a>
</div>
@endsection