@extends('layouts.app')

@section('title', 'Daftar Wahana | Indonesia Science Center')

@section('content')
<div class="container py-5">
  <div class="text-center mb-5">
    <h1 class="display-5 fw-bold">Jelajahi Dunia Sains di Wahana Kami</h1>
    <p class="lead text-muted">Temukan petualangan tak terlupakan dan pengetahuan baru di setiap sudut Indonesia Science Center.</p>
  </div>

  @if(isset($wahanas) && $wahanas->isNotEmpty())
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
      @foreach($wahanas as $wahana)
        <div class="col">
          <div class="card h-100 shadow-sm border-0 rounded-lg text-center isc-card-wahana overflow-hidden d-flex flex-column">
            @if($wahana->image)
              <img src="{{ asset('uploads/' . $wahana->image) }}" class="card-img-top" alt="{{ $wahana->name }}" style="height: 220px; object-fit: cover; width: 100%;">
            @else
              <div class="bg-light d-flex align-items-center justify-content-center card-img-top" style="min-height: 220px;">
                <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
              </div>
            @endif
            <div class="card-body d-flex flex-column align-items-center p-4 flex-grow-1">
              <h5 class="card-title fw-semibold">{{ $wahana->name }}</h5>
              <p class="card-text small text-muted">{{ Str::limit($wahana->description, 100) }}</p>
              <div class="mt-auto w-100 pt-3">
                @if($wahana->video_embed_url)
                  <a href="{{ $wahana->video_embed_url }}" target="_blank" class="btn btn-sm btn-outline-danger w-100 mb-2" title="Lihat Video {{ $wahana->name }}">
                    <i class="bi bi-play-circle-fill"></i> Lihat Video
                  </a>
                @endif
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @elseif(isset($wahanas) && $wahanas->isEmpty())
    <div class="text-center py-5">
      <i class="bi bi-search fs-1 text-muted mb-3"></i>
      <h4 class="text-muted">Informasi wahana akan segera hadir.</h4>
      <p class="text-muted">Kami sedang mempersiapkan daftar wahana menarik untuk Anda.</p>
    </div>
  @endif
</div>
@endsection

@push('styles')
<style>
.isc-card-wahana {
  transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}
.isc-card-wahana:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(41,86,215,0.15) !important;
}
.wahana-icon i {
  transition: transform 0.3s ease;
}
.isc-card-wahana:hover .wahana-icon i {
  transform: scale(1.1);
}
</style>
@endpush