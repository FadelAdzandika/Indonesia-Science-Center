<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Indonesia Science Center')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <style>
    nav.navbar {
      background-color: #0066cc;
    }
    nav.navbar .nav-link, nav.navbar .navbar-brand {
      color: white;
    }
    .hero-isc {
    background: #2956d7 url("{{ asset('images/isc.png') }}") right bottom no-repeat;
      background-size: contain;
      min-height: 380px;
      display: flex;
      align-items: center;
      position: relative;
    }
    .hero-isc .container {
      position: relative;
      z-index: 2;
    }
    .hero-isc-title {
      color: #fff;
      font-size: 2.2rem;
      font-weight: bold;
    }
    .hero-isc-desc {
      color: #e0e8ff;
      font-size: 1.2rem;
      margin-bottom: 1.5rem;
    }
    .btn-green {
      background: #4caf50;
      color: #fff;
      border: none;
    }
    .btn-green:hover {
      background: #388e3c;
      color: #fff;
    }
    .section-title {
      font-weight: bold;
      font-size: 1.6rem;
      letter-spacing: 1px;
      margin-bottom: 2rem;
      color: #183153;
      text-align: center;
    }
    .isc-card {
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 2px 12px rgba(41,86,215,0.07);
      padding: 1.5rem 1rem;
      text-align: center;
      margin-bottom: 1.5rem;
      min-height: 170px;
      transition: box-shadow 0.2s;
    }
    .isc-card:hover {
      box-shadow: 0 4px 24px rgba(41,86,215,0.13);
    }
    .isc-card-icon {
      font-size: 2.5rem;
      margin-bottom: 0.7rem;
      color: #2956d7;
    }
    .isc-card-title {
      font-weight: 600;
      font-size: 1.1rem;
      margin-bottom: 0.3rem;
    }
    .bg-section-yellow {
      background: #fff8ed;
    }
    .bg-section-green {
      background: #f1fff3;
    }
    .rounded-20 {
      border-radius: 20px;
    }
    @media (min-width: 768px) {
      .hero-isc-title {
        font-size: 2.8rem;
      }
      .hero-isc {
        min-height: 420px;
      }
    }

    nav.navbar {
  background-color: #fff;
    }
        nav.navbar .nav-link,
        nav.navbar .navbar-brand {
        color: #222 !important;
    }

    nav.navbar .nav-link:hover,
    nav.navbar .navbar-brand:hover {
    color: #0066cc !important; /* Warna teks saat hover */
    text-decoration: underline; /* Tambahkan garis bawah saat hover (opsional) */
    }
  </style>
  @stack('styles')
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light py-3">
  <div class="container">
    <a class="navbar-brand p-0" href="{{ url('/') }}">
      <img src="{{ asset('images/isc.png') }}" alt="Indonesia Science Center" height="40" class="d-inline-block align-text-top">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/') }}">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Wahana</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Program Sains</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="eventDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Event
          </a>
          <ul class="dropdown-menu" aria-labelledby="eventDropdown">
            <li><a class="dropdown-item" href="{{ route('events.index') }}">Event</a></li>
            <li><a class="dropdown-item" href="{{ route('competitions.index') }}">Kompetisi</a></li>
          </ul>
        </li>
      </ul>
      <div class="d-flex align-items-center">
        @auth
          <span class="me-3">Halo, {{ Auth::user()->name }}</span>
          @if(Auth::user()->role == 'admin')
            <a href="{{ route('admin.dashboard') }}" class="btn btn-warning me-2">Admin Dashboard</a>
          @endif
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-outline-primary" type="submit">Logout</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="btn btn-primary px-4">Login</a>
        @endauth
      </div>
    </div>
  </div>
</nav>

<!-- Main Content -->
<main>
  @yield('content')
</main>

<!-- Footer -->
<footer class="bg-dark text-white pt-5 pb-4 mt-5">
  <div class="container">
    <div class="row">
      <!-- Logo and Description -->
      <div class="col-md-4 mb-4">
        <h5 class="mb-3">INDONESIA SCIENCE CENTER</h5>
        <p class="small">Taman Mini Indonesia Indah, Jakarta Timur, DKI Jakarta 13810</p>
        <p class="small mb-2">
          <i class="bi bi-telephone me-2"></i> (021) 1234 5678
        </p>
        <p class="small mb-2">
          <i class="bi bi-envelope me-2"></i> info@indonesiasciencecenter.co.id
        </p>
      </div>
      <!-- Quick Links -->
      <div class="col-md-2 mb-4">
        <h6 class="text-uppercase fw-bold mb-4">Tautan Cepat</h6>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="#" class="text-white text-decoration-none small">Beranda</a></li>
          <li class="mb-2"><a href="#" class="text-white text-decoration-none small">Tentang Kami</a></li>
          <li class="mb-2"><a href="#" class="text-white text-decoration-none small">Galeri</a></li>
          <li class="mb-2"><a href="#" class="text-white text-decoration-none small">Kontak</a></li>
        </ul>
      </div>
      <!-- Programs -->
      <div class="col-md-3 mb-4">
        <h6 class="text-uppercase fw-bold mb-4">Program</h6>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="#" class="text-white text-decoration-none small">Program Reguler Sains</a></li>
          <li class="mb-2"><a href="#" class="text-white text-decoration-none small">Science Show</a></li>
          <li class="mb-2"><a href="#" class="text-white text-decoration-none small">Science Cinema</a></li>
          <li class="mb-2"><a href="#" class="text-white text-decoration-none small">Science Virtual Trip</a></li>
        </ul>
      </div>
      <!-- Social Media -->
      <div class="col-md-3 mb-4">
        <h6 class="text-uppercase fw-bold mb-4">Ikuti Kami</h6>
        <div class="d-flex">
          <a href="#" class="me-3 text-white"><i class="bi bi-facebook fs-4"></i></a>
          <a href="#" class="me-3 text-white"><i class="bi bi-twitter fs-4"></i></a>
          <a href="#" class="me-3 text-white"><i class="bi bi-instagram fs-4"></i></a>
          <a href="#" class="text-white"><i class="bi bi-youtube fs-4"></i></a>
        </div>
      </div>
    </div>
    <div class="border-top pt-4 mt-4">
      <div class="row">
        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
          <p class="small mb-0">&copy; 2025 Indonesia Science Center. All rights reserved.</p>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <p class="small mb-0">
            <a href="#" class="text-white text-decoration-none me-3">Kebijakan Privasi</a>
            <a href="#" class="text-white text-decoration-none">Syarat & Ketentuan</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>