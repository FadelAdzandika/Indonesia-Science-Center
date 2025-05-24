@extends('layouts.app')

@section('title', 'Dashboard | Indonesia Science Center')

@push('styles')
<style>
.image-hover-overlay-container {
    position: relative;
    overflow: hidden; /* Ensures overlay stays within bounds */
}

.image-hover-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent black */
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
    padding: 10px;
    text-align: center;
}

.image-hover-overlay-container:hover .image-hover-overlay {
    opacity: 1;
}

.image-hover-overlay .photo-title {
    font-size: 1rem;
    font-weight: bold;
    margin-bottom: 0.25rem;
}

.image-hover-overlay .photo-category {
    font-size: 0.85rem;
}
</style>
@endpush

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
        <a href="{{route('wahana.index')}}" class="btn btn-green btn-lg me-2 mb-2">Lihat Wahana</a>
        <a href="{{ route('kunjungan.create') }}" class="btn btn-outline-light btn-lg mb-2">Pesan Kunjungan</a>
      </div>
    </div>
  </div>
</section>

<!-- Wahana Terbaru ISC -->
<section id="wahana-terbaru" class="py-5">
  <div class="container">
    <div class="section-title">WAHANA TERBARU ISC</div>
    <div class="row justify-content-center">
      @if(isset($latestWahanas) && $latestWahanas->isNotEmpty())
        @foreach($latestWahanas as $wahana)
          <div class="col-6 col-md-3 mb-4"> {{-- mb-4 untuk spasi jika ada beberapa baris di mobile --}}
            <div class="isc-card h-100 d-flex flex-column text-center"> {{-- Tambahkan text-center agar konten di tengah --}}
              {{-- Jika ingin menampilkan gambar wahana di sini --}}
              @if($wahana->image)
                <img src="{{ asset('storage/' . $wahana->image) }}" alt="{{ $wahana->name }}" class="card-img-top" style="object-fit: cover; height: 120px; border-top-left-radius: 18px; border-top-right-radius: 18px;">
              @endif
              {{-- <div class="isc-card-icon {{ $wahana->color ?? 'text-primary' }}"><i class="bi {{ $wahana->icon ?? 'bi-app-indicator' }}"></i></div> --}} {{-- Ikon dan warna sudah dihapus dari form, jadi ini mungkin tidak relevan lagi atau bisa di-default-kan --}}
              <div class="isc-card-title mt-2">{{ $wahana->name }}</div>
              <p class="small text-muted px-2 mb-0">{{ Str::limit($wahana->description, 70) }}</p> {{-- Menampilkan 70 karakter deskripsi --}}
            </div>
          </div>
        @endforeach
      @else
        <div class="col-12"><p class="text-center text-muted">Belum ada wahana terbaru saat ini.</p></div>
      @endif
    </div>
  </div>
</section>

<!-- Wahana Galeri ISC -->
<section id="wahana" class="py-5 bg-section-yellow">
  <div class="container">
    <div class="section-title">WAHANA GALERI ISC</div>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">
      @if(isset($allWahanas) && $allWahanas->isNotEmpty())
        @foreach($allWahanas as $wahana)
          <div class="col">
            <div class="isc-card h-100 d-flex flex-column">
              @if($wahana->image)
                <img src="{{ asset('storage/' . $wahana->image) }}" alt="{{ $wahana->name }}" class="card-img-top" style="object-fit: cover; height: 120px; border-top-left-radius: 18px; border-top-right-radius: 18px;">
              @else
                {{-- Placeholder jika tidak ada gambar --}}
                <div class="d-flex align-items-center justify-content-center" style="height: 120px; background-color: #e9ecef; border-top-left-radius: 18px; border-top-right-radius: 18px;">
                    <i class="bi bi-image text-muted" style="font-size: 2.5rem;"></i>
                </div>
              @endif
              <div class="isc-card-title mt-2">{{ $wahana->name }}</div>
            </div>
          </div>
        @endforeach
      @else
        <div class="col-12"><p class="text-center text-muted">Belum ada wahana yang terdaftar.</p></div>
      @endif
    </div>
  </div>
</section>

<!-- Science Activity Program -->
<section class="py-5">
  <div class="container">
    <div class="section-title">SCIENCE ACTIVITY PROGRAM</div>
    <p class="text-center lead mb-5" style="font-size: 1.25rem; color: #555;">
        Kegiatan Edukatif & Interaktif yang Siap Menyapa Anda.<br>
        Tak hanya berkunjung, Anda juga bisa belajar sambil bermain lewat program sains kami yang dikemas modern dan menyenangkan.
    </p>
    <div class="row justify-content-center">
      <div class="col-6 col-md-3">
        <div class="isc-card h-100 d-flex flex-column text-center"> {{-- Tambahkan text-center --}}
          <div class="isc-card-icon"><i class="bi bi-truck"></i></div>
          <div class="isc-card-title">Mobile Science X</div>
          <p class="small text-muted px-2">Wahana sains keliling yang datang langsung ke sekolah atau komunitas Anda.</p>
          <div class="mt-auto p-2">
            <a href="{{ route('gallery.isc.index') }}" class="btn btn-sm btn-outline-primary">Lihat Galeri</a>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="isc-card h-100 d-flex flex-column text-center"> {{-- Tambahkan text-center --}}
          <div class="isc-card-icon">
            <img src="{{ asset('images/flask.png') }}" alt="Sanggar Kerja" style="height:48px;">
          </div>
          <div class="isc-card-title">Sanggar Kerja</div>
          <p class="small text-muted px-2">Workshop sains tematik yang dirancang khusus di lokasi ISC.</p>
          <div class="mt-auto p-2">
            <a href="{{ route('gallery.isc.index') }}" class="btn btn-sm btn-outline-primary">Lihat Galeri</a>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="isc-card h-100 d-flex flex-column text-center"> {{-- Tambahkan text-center --}}
          <div class="isc-card-icon"><i class="bi bi-mic"></i></div>
          <div class="isc-card-title">Science Show</div>
          <p class="small text-muted px-2">Pertunjukan ilmiah yang spektakuler dan edukatif dengan tema berbeda setiap bulan.</p>
          <div class="mt-auto p-2">
            <a href="{{ route('gallery.isc.index') }}" class="btn btn-sm btn-outline-primary">Lihat Galeri</a>
          </div>
        </div>

      </div>
      <div class="col-6 col-md-3">
        <div class="isc-card h-100 d-flex flex-column text-center"> {{-- Tambahkan text-center --}}
          <div class="isc-card-icon mb-2" style="height:48px; display:flex; align-items:center; justify-content:center;">
            <img src="{{ asset('images/tenda.png') }}" alt="Science Camp" style="height:48px; max-width:100%;">
          </div>
          <div class="isc-card-title">Science Camp</div>
          <p class="small text-muted px-2">Berkemah sambil belajar sains dan bermain outdoor games yang seru.</p>
          <div class="mt-auto p-2"> {{-- mt-auto pushes this div to the bottom --}}
            <a href="{{ route('gallery.isc.index') }}" class="btn btn-sm btn-outline-primary">Lihat Galeri</a>
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
      @if(isset($events) && $events->isNotEmpty())
        @foreach($events as $event)
          <div class="col-6 col-md-3 mb-4">
            <div class="isc-card h-100 d-flex flex-column">
              {{-- Menampilkan gambar thumbnail untuk event --}}
              @if($event->thumbnail)
                <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="{{ $event->title ?? 'Gambar Event' }}" class="card-img-top" style="object-fit: cover; height: 150px; border-top-left-radius: 10px; border-top-right-radius: 10px;">
              @endif
              <div class="isc-card-body p-3 flex-grow-1"> {{-- flex-grow-1 untuk mengisi ruang --}}
                <span class="badge bg-primary mb-2">EVENT</span>
                <div class="isc-card-title">{{ $event->title ?? 'Judul Event' }}</div>
                {{-- Menampilkan deskripsi singkat event --}}
                @if($event->description)
                  <p class="isc-card-text small text-muted mt-2 mb-0">{{ Str::limit(strip_tags($event->description), 70) }}</p>
                @endif
              </div>
              @if(Route::has('events.show') && isset($event->id))
                <div class="p-3 pt-0 mt-auto text-center"> {{-- mt-auto untuk mendorong tombol ke bawah jika card flex --}}
                  <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                </div>
              @endif
            </div>
          </div>
        @endforeach
      @endif

      @if(isset($competitions) && $competitions->isNotEmpty())
        @foreach($competitions as $competition)
          <div class="col-6 col-md-3 mb-4">
            <div class="isc-card h-100 d-flex flex-column">
              {{-- Menampilkan gambar thumbnail untuk kompetisi (jika ada dan diinginkan) --}}
              @if($competition->thumbnail)
                <img src="{{ asset('storage/' . $competition->thumbnail) }}" alt="{{ $competition->title ?? 'Gambar Kompetisi' }}" class="card-img-top" style="object-fit: cover; height: 150px; border-top-left-radius: 10px; border-top-right-radius: 10px;">
              @endif
              <div class="isc-card-body p-3 flex-grow-1">
                <span class="badge bg-success mb-2">KOMPETISI</span>
                <div class="isc-card-title">{{ $competition->title ?? 'Judul Kompetisi' }}</div>
                {{-- Menampilkan deskripsi singkat kompetisi --}}
                @if($competition->description)
                  <p class="isc-card-text small text-muted mt-2 mb-0">{{ Str::limit(strip_tags($competition->description), 70) }}</p>
                @endif
              </div>
              @if(Route::has('competitions.show') && isset($competition->id))
                <div class="p-3 pt-0 mt-auto text-center">
                  <a href="{{ route('competitions.show', $competition->id) }}" class="btn btn-sm btn-outline-success">Lihat Detail</a>
                </div>
              @endif
            </div>
          </div>
        @endforeach
      @endif

      @if((!isset($events) || $events->isEmpty()) && (!isset($competitions) || $competitions->isEmpty()))
        <div class="col-12">
          <p class="text-center text-white">Tidak ada event atau kompetisi terbaru saat ini.</p>
        </div>
      @endif
    </div>
  </div>
</section>

<!-- Teaser Galeri Foto ISC -->
<section id="teaser-gallery-isc" class="py-5 bg-light">
  <div class="container">
    <div class="section-title">GALERI FOTO ISC</div>
    <p class="text-center lead mb-5" style="font-size: 1.25rem; color: #555;">
        Lihat momen-momen seru dan menarik dari berbagai kegiatan di Indonesia Science Center.
    </p>
    @if(isset($teaserPhotos) && $teaserPhotos->isNotEmpty())
      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
        @foreach($teaserPhotos as $photo)
          <div class="col ">
            <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden image-hover-overlay-container">
              <img src="{{ asset('uploads/' . $photo->image_path) }}" class="card-img-top" alt="{{ $photo->title ?? 'Foto Galeri ISC' }}" style="height: 200px; object-fit: cover; display: block;">
              <div class="image-hover-overlay">
                @if($photo->title)
                  <div class="photo-title">{{ $photo->title }}</div>
                @endif
                @if($photo->photoCategory)
                  <div class="photo-category">Kategori: {{ $photo->photoCategory->name }}</div>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="text-center mt-5">
        <a href="{{ route('gallery.isc.index') }}" class="btn btn-primary btn-lg">Lihat Semua Galeri Foto</a>
      </div>
    @else
      <div class="text-center py-4">
        <i class="bi bi-images fs-1 text-muted mb-3"></i>
        <h4 class="text-muted">Galeri foto ISC akan segera hadir.</h4>
      </div>
    @endif
  </div>
</section>

<!-- Tentang Kami -->
<section class="py-5" id="tentang-kami">
  <div class="container">
    <div class="section-title">TENTANG KAMI</div>
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <div class="ratio ratio-16x9">
          <iframe 
            src="https://www.youtube.com/embed/Ze922Z21SZE" 
            title="Video Profil Indonesia Science Center" 
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
            allowfullscreen>
          </iframe>
        </div>
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

{{-- Pastikan Anda memiliki @push('scripts') di layout utama jika ingin menggunakan modal --}}
{{-- Jika ingin modal untuk teaser, tambahkan kode modal dan JS seperti di galeri Science Camp --}}
{{-- Untuk saat ini, teaser hanya menampilkan gambar tanpa modal untuk kesederhanaan --}}