<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $__env->yieldContent('title', 'Indonesia Science Center'); ?></title>
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
    background: #2956d7 url("<?php echo e(asset('images/isc.png')); ?>") right bottom no-repeat;
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
  <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light py-3">
  <div class="container">
    <a class="navbar-brand p-0" href="<?php echo e(url('/')); ?>">
      <img src="<?php echo e(asset('images/isc.png')); ?>" alt="Indonesia Science Center" height="40" class="d-inline-block align-text-top">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo e(url('/')); ?>">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo e(request()->routeIs('wahana.index') ? 'active' : ''); ?>" href="<?php echo e(route('wahana.index')); ?>">Wahana</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo e(url('/#science-activity-program')); ?>">Program Sains</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo e(request()->routeIs('gallery.isc.index') ? 'active' : ''); ?>" href="<?php echo e(route('gallery.isc.index')); ?>">Galeri</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="eventDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Event
          </a>
          <ul class="dropdown-menu" aria-labelledby="eventDropdown">
            <li><a class="dropdown-item" href="<?php echo e(route('events.index')); ?>">Event</a></li>
            <li><a class="dropdown-item" href="<?php echo e(route('competitions.index')); ?>">Kompetisi</a></li>
          </ul>
        </li>
      </ul>
      <div class="d-flex align-items-center">
        <?php if(auth()->guard()->check()): ?>
          <span class="me-3">Halo, <?php echo e(Auth::user()->name); ?></span>
          <?php if(Auth::user()->role == 'admin'): ?>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-warning me-2">Admin Dashboard</a>
          <?php endif; ?>
          <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
            <?php echo csrf_field(); ?>
            <button class="btn btn-outline-primary" type="submit">Logout</button>
          </form>
        <?php else: ?>
          <a href="<?php echo e(route('login')); ?>" class="btn btn-primary px-4">Login</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<!-- Main Content -->
<main>
  <?php echo $__env->yieldContent('content'); ?>
</main>

<!-- Footer -->


<footer class="bg-dark text-white pt-5 pb-4">
  <div class="container text-center text-md-start">
    <div class="row text-center text-md-start">

      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 fw-bold text-primary">Indonesia Science Center</h5>
        <p>
          Pusat Eduwisata Sains Terbesar dan Terinspiratif di Indonesia.
        </p>
        
        
      </div>

      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 fw-bold text-primary">Navigasi</h5>
        <p>
          <a href="<?php echo e(route('home')); ?>" class="text-white" style="text-decoration: none;">Beranda</a>
        </p>
        <p>
          <a href="<?php echo e(route('wahana.index')); ?>" class="text-white" style="text-decoration: none;">Wahana</a>
        </p>
        <p>
          <a href="<?php echo e(url('/#science-activity-program')); ?>" class="text-white" style="text-decoration: none;">Program</a>
        </p>
        <p>
          <a href="<?php echo e(route('events.index')); ?>" class="text-white" style="text-decoration: none;">Event</a>
        </p>
        <p>
          <a href="<?php echo e(route('competitions.index')); ?>" class="text-white" style="text-decoration: none;">Kompetisi</a>
        </p>
      </div>

      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 fw-bold text-primary">Informasi</h5>
        <p>
          <a href="<?php echo e(url('/#tentang-kami')); ?>" class="text-white" style="text-decoration: none;">Tentang Kami</a> 
        </p>
        <p>
          <a href="<?php echo e(route('kunjungan.create')); ?>" class="text-white" style="text-decoration: none;">Pesan Kunjungan</a>
        </p>
        <p>
          <a href="#" class="text-white" style="text-decoration: none;">FAQ</a> 
        </p>
        <p>
          <a href="#" class="text-white" style="text-decoration: none;">Kontak</a> 
        </p>
      </div>

      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 fw-bold text-primary">Kontak Kami</h5>
        <p><i class="bi bi-geo-alt-fill me-2"></i> Jl. Sains Terpadu No. 1, Jakarta</p>
        <p><i class="bi bi-envelope-fill me-2"></i> <a href="mailto:info@isc-sains.co.id" class="text-white" style="text-decoration: none;">info@isc-sains.co.id</a></p>
        <p><i class="bi bi-telephone-fill me-2"></i> +62 21 1234 5678</p>
        
        <div class="mt-3">
            <a href="https://www.instagram.com/ppiptek" target="_blank" class="text-white me-3" title="Instagram: @ppiptek">
                <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
            </a>
            <a href="https://www.tiktok.com/@indonesiasciencecenter" target="_blank" class="text-white me-3" title="TikTok: Indonesia Science Center"> 
                <i class="bi bi-tiktok" style="font-size: 1.5rem;"></i>
            </a>
            <a href="https://www.youtube.com/@Humasppiptek" target="_blank" class="text-white" title="YouTube: Indonesia Science Center"> 
                <i class="bi bi-youtube" style="font-size: 1.5rem;"></i>
            </a>
            
        </div>
      </div>
    </div>

    <hr class="mb-4 mt-5">

    <div class="row align-items-center">
      <div class="col-md-7 col-lg-8">
        <p class="text-center text-md-start">
          © <?php echo e(date('Y')); ?> Hak Cipta:
          <a href="<?php echo e(route('home')); ?>" class="text-white fw-bold" style="text-decoration: none;">
            Indonesia Science Center
          </a>
        </p>
      </div>
      <div class="col-md-5 col-lg-4">
        <div class="text-center text-md-end">
          
          <a href="#" class="text-white me-2" style="text-decoration: none;">Kebijakan Privasi</a>
          <a href="#" class="text-white" style="text-decoration: none;">Syarat & Ketentuan</a>
        </div>
      </div>
    </div>
  </div>
</footer>

</body>
</html>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\Indonesia_Science_Center\resources\views/layouts/app.blade.php ENDPATH**/ ?>