@extends('layouts.app')

@section('title', 'Dashboard | Indonesia Science Center')

@section('content')
<!-- Hero -->
<section class="hero-isc" style="
  background: #2956d7;
  min-height: 400px;
  display: flex;
  align-items: center;
  position: relative;
  overflow: hidden;
">
  <img src="{{ asset('images/kantor.jpg') }}"
       alt="Foto Kantor ISC"
       style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.18; pointer-events: none; z-index: 1;">
  <div class="container py-5 position-relative" style="z-index:2;">
    <div class="row align-items-center">
      <div class="col-md-8 col-lg-7">
        <h1 class="hero-isc-title mb-3">Selamat Datang di<br>Indonesia Science Center</h1>
        <div class="hero-isc-desc mb-4">
          Pusat Eduwisata Sains Terbesar dan<br>Terinspiratif di Indonesia
        </div>
        <a href="#wahana" class="btn btn-green btn-lg me-2 mb-2">Lihat Wahana</a>
        <a href="#kunjungan" class="btn btn-outline-light btn-lg mb-2">Pesan Kunjungan</a>
      </div>
    </div>
  </div>
</section>

<!-- Wahana Galeri ISC -->
<section id="wahana" class="py-5 bg-section-yellow">
  <div class="container">
    <div class="section-title">WAHANA GALERI ISC</div>
    <div class="row justify-content-center">
      <div class="col-6 col-md-3">
        <div class="isc-card">
          <div class="isc-card-icon"><i class="bi bi-emoji-smile"></i></div>
          <div class="isc-card-title">Taman Jurassic</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="isc-card">
          <div class="isc-card-icon"><i class="bi bi-lightning-charge"></i></div>
          <div class="isc-card-title">Tesla Coil</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="isc-card">
          <div class="isc-card-icon"><i class="bi bi-water"></i></div>
          <div class="isc-card-title">Getaran Gelombang</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="isc-card">
          <div class="isc-card-icon"><i class="bi bi-globe2"></i></div>
          <div class="isc-card-title">Digital World</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Science Activity Program -->
<section class="py-5">
  <div class="container">
    <div class="section-title">SCIENCE ACTIVITY PROGRAM</div>
    <div class="row justify-content-center">
      <div class="col-6 col-md-3">
        <div class="isc-card">
          <div class="isc-card-icon"><i class="bi bi-truck"></i></div>
          <div class="isc-card-title">Mobile Science X</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="isc-card">
          <div class="isc-card-icon">
            <img src="{{ asset('images/flask.png') }}" alt="Sanggar Kerja" style="height:48px;">
          </div>
          <div class="isc-card-title">Sanggar Kerja</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="isc-card">
          <div class="isc-card-icon"><i class="bi bi-mic"></i></div>
          <div class="isc-card-title">Science Show</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="isc-card d-flex flex-column align-items-center justify-content-center h-100">
          <div class="isc-card-icon mb-2" style="height:48px; display:flex; align-items:center; justify-content:center;">
            <img src="{{ asset('images/tenda.png') }}" alt="Science Camp" style="height:48px; max-width:100%;">
          </div>
          <div class="isc-card-title">Science Camp</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Event & Kompetisi -->
<section class="py-5 bg-section-green">
  <div class="container">
    <div class="section-title">EVENT & KOMPETISI</div>
    <div class="row justify-content-center">
      <div class="col-6 col-md-3">
        <div class="isc-card">
          <div class="isc-card-title">English Speech Contest</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="isc-card">
          <div class="isc-card-title">Roket Air Nasional</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="isc-card">
          <div class="isc-card-title">Digital Innovator Competition</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="isc-card">
          <div class="isc-card-title">Lomba Rabef Nasional</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Tentang Kami -->
<section class="py-5">
  <div class="container">
    <div class="section-title">TENTANG KAMI</div>
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="{{ asset('images/tentang-isc.svg') }}" alt="Tentang ISC" class="img-fluid rounded-20">
      </div>
      <div class="col-md-6">
        <p class="lead">Kawasan interaktif yang berorientasi sains dengan wahana, alat peraga, dan program edukasi untuk semua usia. Indonesia Science Center hadir untuk menginspirasi generasi muda Indonesia agar mencintai sains dan teknologi.</p>
        <ul>
          <li>Wahana interaktif & edukatif</li>
          <li>Program sains untuk sekolah & keluarga</li>
          <li>Event & kompetisi nasional</li>
        </ul>
      </div>
    </div>
  </div>
</section>
@endsection