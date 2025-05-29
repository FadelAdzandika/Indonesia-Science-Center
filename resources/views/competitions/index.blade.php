@extends('layouts.app')

@section('title', 'Daftar Kompetisi')

@section('content')
<div class="container py-5">
  <div class="text-center mb-5">
    <h1 class="display-5 fw-bold">Kompetisi Terkini</h1>
    <p class="lead text-muted">Asah kemampuan dan raih prestasi dalam berbagai kompetisi menarik kami.</p>
  </div>

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if($competitions->isNotEmpty())
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      @foreach($competitions as $competition)
          <div class="col d-flex align-items-stretch">
          <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden w-100 d-flex flex-column"> {{-- Tambahkan h-100 dan pastikan d-flex flex-column --}}
            @if($competition->thumbnail)
              <a href="{{ route('competitions.show', $competition) }}">
                <img src="{{ asset('public/uploads/' . $competition->thumbnail) }}" class="card-img-top" alt="{{ $competition->title }}">
              </a>
            @else
              <a href="{{ route('competitions.show', $competition) }}">
                <div class="bg-secondary d-flex align-items-center justify-content-center card-img-top" style="min-height: 150px;"> {{-- Beri min-height untuk placeholder --}}
                  <span class="text-white-50">Gambar tidak tersedia</span>
                </div>
              </a>
            @endif
            <div class="card-body d-flex flex-column">
              <h5 class="card-title fw-bold mb-2"><a href="{{ route('competitions.show', $competition) }}" class="text-decoration-none text-dark stretched-link">{{ Str::limit($competition->title, 50) }}</a></h5>
              <p class="card-text text-muted small mb-3">
                <i class="bi bi-calendar-play me-1"></i>
                {{ $competition->start_date ? $competition->start_date->translatedFormat('D, d M Y') : 'Segera' }}
                @if($competition->end_date)
                 - {{ $competition->end_date->translatedFormat('D, d M Y') }}
                @endif
              </p>
              @if($competition->description)
                <p class="card-text text-muted flex-grow-1">{{ Str::limit(strip_tags($competition->description), 100) }}</p>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="mt-5 d-flex justify-content-center">
      {{ $competitions->links() }}
    </div>
  @else
    <div class="text-center py-5">
      <i class="bi bi-trophy-fill fs-1 text-muted mb-3"></i>
      <h4 class="text-muted">Belum ada kompetisi yang tersedia saat ini.</h4>
      <p class="text-muted">Nantikan informasi kompetisi kami selanjutnya!</p>
    </div>
  @endif
</div>
@endsection