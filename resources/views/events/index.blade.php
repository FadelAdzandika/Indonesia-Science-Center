@extends('layouts.app') {{-- Or your main public layout --}}

@section('title', 'Daftar Event')

@section('content')
<div class="container py-5">
  <div class="text-center mb-5">
    <h1 class="display-5 fw-bold">Daftar Event Mendatang</h1>
    <p class="lead text-muted">Temukan berbagai kegiatan menarik dan informatif yang kami selenggarakan.</p>
  </div>

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if($events->isNotEmpty())
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      @foreach($events as $event)
        <div class="col">
          <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden">
            @if($event->thumbnail)
              <a href="{{ route('events.show', $event) }}">
                <img src="{{ asset('storage/' . $event->thumbnail) }}" class="card-img-top" alt="{{ $event->title }}" style="height: 200px; object-fit: cover;">
              </a>
            @else
              <a href="{{ route('events.show', $event) }}">
                <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                  <span class="text-white-50">Gambar tidak tersedia</span>
                </div>
              </a>
            @endif
            <div class="card-body d-flex flex-column">
              <h5 class="card-title fw-bold mb-2"><a href="{{ route('events.show', $event) }}" class="text-decoration-none text-dark stretched-link">{{ Str::limit($event->title, 50) }}</a></h5>
              <p class="card-text text-muted small mb-3">
                <i class="bi bi-calendar-event me-1"></i>
                {{ $event->event_date ? $event->event_date->translatedFormat('D, d M Y') : 'Segera diumumkan' }}
              </p>
              @if($event->description)
                <p class="card-text text-muted flex-grow-1">{{ Str::limit(strip_tags($event->description), 100) }}</p>
              @endif
              {{-- Tombol bisa diletakkan di sini jika diinginkan, atau biarkan card-link yang bekerja --}}
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="mt-5 d-flex justify-content-center">
      {{ $events->links() }} {{-- For pagination --}}
    </div>
  @else
    <div class="text-center py-5">
      <i class="bi bi-calendar-x fs-1 text-muted mb-3"></i>
      <h4 class="text-muted">Belum ada event yang tersedia saat ini.</h4>
      <p class="text-muted">Silakan cek kembali nanti untuk informasi terbaru.</p>
    </div>
  @endif
</div>
@endsection