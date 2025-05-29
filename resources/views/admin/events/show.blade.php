@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card shadow-sm border-0 rounded-lg">
        @if($event->thumbnail)
          <img src="{{ asset('public/uploads/' . $event->thumbnail) }}" class="card-img-top rounded-top-lg" alt="{{ $event->title }}" style="max-height: 450px; object-fit: cover;">
        @endif
        <div class="card-body p-4 p-md-5">
          <h1 class="card-title h2 mb-3">{{ $event->title }}</h1>
          
          <div class="d-flex align-items-center text-muted mb-4">
            <i class="bi bi-calendar-event me-2" style="font-size: 1.2rem;"></i>
            <span>{{ $event->event_date ? $event->event_date->translatedFormat('l, d F Y') : 'Tanggal akan diumumkan' }}</span>
          </div>

          @if($event->description)
            <div class="event-description fs-5 mb-4">
              <h5 class="text-primary">Deskripsi Event</h5>
              {!! nl2br(e($event->description)) !!}
            </div>
          @endif

          <hr class="my-4">

          <div class="text-center">
            @if(Str::startsWith(Route::currentRouteName(), 'admin.'))
              <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary me-2"><i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Daftar Admin</a>
              <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-primary"><i class="bi bi-pencil-square me-1"></i> Edit Event</a>
            @else
              <a href="{{ route('events.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Daftar Event</a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection