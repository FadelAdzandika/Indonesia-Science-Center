@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-9 col-xl-8"> {{-- Sedikit lebih ramping --}}
      <article class="event-detail">
        @if($event->thumbnail)
        <div class="mb-4 overflow-hidden rounded-3 shadow-sm"> {{-- Pembungkus gambar dengan shadow --}}
            <img src="{{ asset('public/uploads/' . $event->thumbnail) }}" class="img-fluid w-100" alt="{{ $event->title }}" style="object-fit: cover; max-height: 500px;"> {{-- img-fluid agar responsif, max-height opsional --}}
        </div>
        @endif
       <header class="mb-4">
          <h1 class="display-5 fw-bold mb-3">{{ $event->title }}</h1>
          <div class="d-flex align-items-center text-muted mb-4">
            <i class="bi bi-calendar-event me-2" style="font-size: 1.2rem;"></i>
            <span>{{ $event->event_date ? $event->event_date->translatedFormat('l, d F Y') : 'Tanggal akan diumumkan' }}</span>
          </div>
        </header>
          @if($event->description)
          <section class="event-description fs-5 mb-5">
            {{-- <h5 class="text-primary mb-3">Deskripsi Event</h5> --}}
            <div class="text-break" style="line-height: 1.7;">
                {!! nl2br(e($event->description)) !!}
            </div>
          </section>
        @endif

        <hr class="my-5">

          <div class="text-center">
            {{-- Tombol kembali ini akan selalu mengarah ke daftar event publik --}}
            <a href="{{ route('events.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Daftar Event</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection