@extends('layouts.app')

@section('title', $competition->title ?? 'Detail Kompetisi')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card shadow-sm border-0 rounded-lg">
        @if($competition->thumbnail)
          <img src="{{ asset('public/uploads/' . $competition->thumbnail) }}" class="card-img-top rounded-top-lg" alt="{{ $competition->title ?? 'Gambar Kompetisi' }}" style="max-height: 450px; object-fit: cover;">
        @endif
        <div class="card-body p-4 p-md-5">
          <h1 class="card-title h2 mb-3">{{ $competition->title ?? 'Judul Kompetisi Tidak Tersedia' }}</h1>
          
          <div class="d-flex align-items-center text-muted mb-2">
            <i class="bi bi-calendar-play me-2" style="font-size: 1.2rem;"></i>
            <span>Mulai: {{ $competition->start_date ? $competition->start_date->translatedFormat('l, d F Y') : 'Tanggal akan diumumkan' }}</span>
          </div>
          <div class="d-flex align-items-center text-muted mb-4">
            <i class="bi bi-calendar-check me-2" style="font-size: 1.2rem;"></i>
            <span>Selesai: {{ $competition->end_date ? $competition->end_date->translatedFormat('l, d F Y') : 'Tanggal akan diumumkan' }}</span>
          </div>

          @if($competition->description)
            <div class="competition-description fs-5 mb-4">
              <h5 class="text-primary">Deskripsi Kompetisi</h5>
              <div class="text-break">
                {!! nl2br(e($competition->description)) !!}
              </div>
            </div>
          @endif

          <hr class="my-4">

          <div class="text-center">
            {{-- Tombol ini akan selalu mengarah ke daftar kompetisi publik --}}
            <a href="{{ route('competitions.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Daftar Kompetisi</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection