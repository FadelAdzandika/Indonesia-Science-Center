@extends('layouts.app') {{-- Atau layout admin Anda --}}

@section('title', $competition->title)

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card shadow-sm border-0 rounded-lg">
        @if($competition->thumbnail)
          <img src="{{ asset('storage/' . $competition->thumbnail) }}" class="card-img-top rounded-top-lg" alt="{{ $competition->title }}" style="max-height: 450px; object-fit: cover;">
        @endif
        <div class="card-body p-4 p-md-5">
          <h1 class="card-title h2 mb-3">{{ $competition->title }}</h1>
          
          <div class="d-flex align-items-center text-muted mb-2">
            <i class="bi bi-calendar-play me-2" style="font-size: 1.2rem;"></i>
            <span>Mulai: {{ $competition->start_date ? $competition->start_date->translatedFormat('l, d F Y') : 'Akan diumumkan' }}</span>
          </div>
          <div class="d-flex align-items-center text-muted mb-4">
            <i class="bi bi-calendar-check me-2" style="font-size: 1.2rem;"></i>
            <span>Selesai: {{ $competition->end_date ? $competition->end_date->translatedFormat('l, d F Y') : 'Akan diumumkan' }}</span>
          </div>

          @if($competition->description)
            <div class="competition-description fs-5 mb-4">
              <h5 class="text-primary">Deskripsi Kompetisi</h5>
              {!! nl2br(e($competition->description)) !!}
            </div>
          @endif

          <hr class="my-4">

          <div class="text-center">
            <a href="{{ route('admin.competitions.index') }}" class="btn btn-outline-secondary me-2"><i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Daftar Admin</a>
            <a href="{{ route('admin.competitions.edit', $competition->id) }}" class="btn btn-primary"><i class="bi bi-pencil-square me-1"></i> Edit Kompetisi</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection