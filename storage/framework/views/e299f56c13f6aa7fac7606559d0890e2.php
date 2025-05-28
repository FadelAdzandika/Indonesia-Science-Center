<?php $__env->startSection('title', 'Dashboard | Indonesia Science Center'); ?>

<?php $__env->startPush('styles'); ?>
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

/* Styles for Teaser Gallery Slider */
.teaser-gallery-slider-container {
    position: relative;
    width: 100%;
    overflow: hidden; /* Crucial for hiding non-visible slides */
}

.teaser-gallery-slider {
    display: flex;
    transition: transform 0.5s ease-in-out; /* Animation for sliding */
    width: fit-content; /* Allow slider to be as wide as its content */
}

.teaser-gallery-slide {
    flex: 0 0 auto; /* Prevent slides from shrinking/growing */
    width: 280px; /* Adjust as needed, or use percentages for responsiveness */
    margin-right: 15px; /* Space between slides */
    box-sizing: border-box;
}

.teaser-gallery-slide .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.teaser-gallery-slide .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.15);
}

.slider-nav-button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    z-index: 10;
    border-radius: 50%;
}
.slider-nav-button.prev { left: 10px; }
.slider-nav-button.next { right: 10px; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero -->
<section class="hero-isc" style="
  background: #2956d7;
  min-height: 400px;
  display: flex;
  align-items: center;
  position: relative;
  overflow: hidden;
">
  <img src="<?php echo e(asset('images/kantor.jpg')); ?>"
       alt="Foto Kantor ISC"
       style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.18; pointer-events: none; z-index: 1;">
  <div class="container py-5 position-relative" style="z-index:2;">
    <div class="row align-items-center">
      <div class="col-md-8 col-lg-7">
        <h1 class="hero-isc-title mb-3">Selamat Datang di<br>Indonesia Science Center</h1>
        <div class="hero-isc-desc mb-4">
          Pusat Eduwisata Sains Terbesar dan<br>Terinspiratif di Indonesia
        </div>
        <a href="<?php echo e(route('wahana.index')); ?>" class="btn btn-green btn-lg me-2 mb-2">Lihat Wahana</a>
        <a href="<?php echo e(route('kunjungan.create')); ?>" class="btn btn-outline-light btn-lg mb-2">Pesan Kunjungan</a>
      </div>
    </div>
  </div>
</section>

<!-- Wahana Terbaru ISC -->
<section id="wahana-terbaru" class="py-5">
  <div class="container">
    <div class="section-title">WAHANA TERBARU ISC</div>
    <div class="row justify-content-center">
      <?php if(isset($latestWahanas) && $latestWahanas->isNotEmpty()): ?>
        <?php $__currentLoopData = $latestWahanas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wahana): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-6 col-md-3 mb-4"> 
            <div class="isc-card h-100 d-flex flex-column text-center"> 
              
              <?php if($wahana->image): ?>
                <img src="<?php echo e(asset('uploads/' . $wahana->image)); ?>" alt="<?php echo e($wahana->name); ?>" class="card-img-top" style="object-fit: cover; height: 120px; border-top-left-radius: 18px; border-top-right-radius: 18px;">
              <?php endif; ?>
               
              <div class="isc-card-title mt-2"><?php echo e($wahana->name); ?></div>
              <p class="small text-muted px-2 mb-0"><?php echo e(Str::limit($wahana->description, 70)); ?></p> 
              <?php if($wahana->video_embed_url): ?>
                <div class="mt-auto p-2 text-center"> 
                  <a href="<?php echo e($wahana->video_embed_url); ?>" target="_blank" class="btn btn-sm btn-outline-danger w-100" title="Lihat Video <?php echo e($wahana->name); ?>">
                    <i class="bi bi-play-circle-fill"></i> Lihat Video
                  </a>
                </div>
              <?php else: ?>
                
                <div style="height: 10px;"></div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
        <div class="col-12"><p class="text-center text-muted">Belum ada wahana terbaru saat ini.</p></div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Wahana Galeri ISC -->
<section id="wahana" class="py-5 bg-section-yellow">
  <div class="container">
    <div class="section-title">WAHANA GALERI ISC</div>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">
      <?php if(isset($allWahanas) && $allWahanas->isNotEmpty()): ?>
        <?php $__currentLoopData = $allWahanas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wahana): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col">
            <div class="isc-card h-100 d-flex flex-column">
              <?php if($wahana->image): ?>
                <img src="<?php echo e(asset('uploads/' . $wahana->image)); ?>" alt="<?php echo e($wahana->name); ?>" class="card-img-top" style="object-fit: cover; height: 120px; border-top-left-radius: 18px; border-top-right-radius: 18px;">
              <?php else: ?>
                
                <div class="d-flex align-items-center justify-content-center" style="height: 120px; background-color: #e9ecef; border-top-left-radius: 18px; border-top-right-radius: 18px;">
                    <i class="bi bi-image text-muted" style="font-size: 2.5rem;"></i>
                </div>
              <?php endif; ?>
              <div class="isc-card-title mt-2"><?php echo e($wahana->name); ?></div>
               <?php if($wahana->video_embed_url): ?>
                <div class="mt-auto p-2 text-center">
                  <a href="<?php echo e($wahana->video_embed_url); ?>" target="_blank" class="btn btn-sm btn-outline-danger w-100" title="Lihat Video <?php echo e($wahana->name); ?>">
                    <i class="bi bi-play-circle-fill"></i> Lihat Video
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
        <div class="col-12"><p class="text-center text-muted">Belum ada wahana yang terdaftar.</p></div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Science Activity Program -->
<section id="science-activity-program" class="py-5">
  <div class="container">
    <div class="section-title">SCIENCE ACTIVITY PROGRAM</div>
    <p class="text-center lead mb-5" style="font-size: 1.25rem; color: #555;">
        Kegiatan Edukatif & Interaktif yang Siap Menyapa Anda.<br>
        Tak hanya berkunjung, Anda juga bisa belajar sambil bermain lewat program sains kami yang dikemas modern dan menyenangkan.
    </p>
    <div class="row justify-content-center">
      <div class="col-6 col-md-3">
        <div class="isc-card h-100 d-flex flex-column text-center"> 
          <div class="isc-card-icon"><i class="bi bi-truck"></i></div>
          <div class="isc-card-title">Mobile Science X</div>
          <p class="small text-muted px-2">Wahana sains keliling yang datang langsung ke sekolah atau komunitas Anda.</p>
          <div class="mt-auto p-2">
            <a href="<?php echo e(route('gallery.isc.index')); ?>" class="btn btn-sm btn-outline-primary">Lihat Galeri</a>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="isc-card h-100 d-flex flex-column text-center"> 
          <div class="isc-card-icon">
            <img src="<?php echo e(asset('images/flask.png')); ?>" alt="Sanggar Kerja" style="height:48px;">
          </div>
          <div class="isc-card-title">Sanggar Kerja</div>
          <p class="small text-muted px-2">Workshop sains tematik yang dirancang khusus di lokasi ISC.</p>
          <div class="mt-auto p-2">
            <a href="<?php echo e(route('gallery.isc.index')); ?>" class="btn btn-sm btn-outline-primary">Lihat Galeri</a>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="isc-card h-100 d-flex flex-column text-center"> 
          <div class="isc-card-icon"><i class="bi bi-mic"></i></div>
          <div class="isc-card-title">Science Show</div>
          <p class="small text-muted px-2">Pertunjukan ilmiah yang spektakuler dan edukatif dengan tema berbeda setiap bulan.</p>
          <div class="mt-auto p-2">
            <a href="<?php echo e(route('gallery.isc.index')); ?>" class="btn btn-sm btn-outline-primary">Lihat Galeri</a>
          </div>
        </div>

      </div>
      <div class="col-6 col-md-3">
        <div class="isc-card h-100 d-flex flex-column text-center"> 
          <div class="isc-card-icon mb-2" style="height:48px; display:flex; align-items:center; justify-content:center;">
            <img src="<?php echo e(asset('images/tenda.png')); ?>" alt="Science Camp" style="height:48px; max-width:100%;">
          </div>
          <div class="isc-card-title">Science Camp</div>
          <p class="small text-muted px-2">Berkemah sambil belajar sains dan bermain outdoor games yang seru.</p>
          <div class="mt-auto p-2"> 
            <a href="<?php echo e(route('gallery.isc.index')); ?>" class="btn btn-sm btn-outline-primary">Lihat Galeri</a>
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
      <?php if(isset($events) && $events->isNotEmpty()): ?>
        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-6 col-md-3 mb-4">
            <div class="isc-card h-100 d-flex flex-column">
              
              <?php if($event->thumbnail): ?>
                <img src="<?php echo e(asset('uploads/' . $event->thumbnail)); ?>" alt="<?php echo e($event->title ?? 'Gambar Event'); ?>" class="card-img-top" style="object-fit: cover; height: 150px; border-top-left-radius: 10px; border-top-right-radius: 10px;">
              <?php endif; ?>
              <div class="isc-card-body p-3 flex-grow-1"> 
                <span class="badge bg-primary mb-2">EVENT</span>
                <div class="isc-card-title"><?php echo e($event->title ?? 'Judul Event'); ?></div>
                
                <?php if($event->description): ?>
                  <p class="isc-card-text small text-muted mt-2 mb-0"><?php echo e(Str::limit(strip_tags($event->description), 70)); ?></p>
                <?php endif; ?>
              </div>
              <?php if(Route::has('events.show') && isset($event->id)): ?>
                <div class="p-3 pt-0 mt-auto text-center"> 
                  <a href="<?php echo e(route('events.show', $event->id)); ?>" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>

      <?php if(isset($competitions) && $competitions->isNotEmpty()): ?>
        <?php $__currentLoopData = $competitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-6 col-md-3 mb-4">
            <div class="isc-card h-100 d-flex flex-column">
              
              <?php if($competition->thumbnail): ?>
                <img src="<?php echo e(asset('uploads/' . $competition->thumbnail)); ?>" alt="<?php echo e($competition->title ?? 'Gambar Kompetisi'); ?>" class="card-img-top" style="object-fit: cover; height: 150px; border-top-left-radius: 10px; border-top-right-radius: 10px;">
              <?php endif; ?>
              <div class="isc-card-body p-3 flex-grow-1">
                <span class="badge bg-success mb-2">KOMPETISI</span>
                <div class="isc-card-title"><?php echo e($competition->title ?? 'Judul Kompetisi'); ?></div>
                
                <?php if($competition->description): ?>
                  <p class="isc-card-text small text-muted mt-2 mb-0"><?php echo e(Str::limit(strip_tags($competition->description), 70)); ?></p>
                <?php endif; ?>
              </div>
              <?php if(Route::has('competitions.show') && isset($competition->id)): ?>
                <div class="p-3 pt-0 mt-auto text-center">
                  <a href="<?php echo e(route('competitions.show', $competition->id)); ?>" class="btn btn-sm btn-outline-success">Lihat Detail</a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>

      <?php if((!isset($events) || $events->isEmpty()) && (!isset($competitions) || $competitions->isEmpty())): ?>
        <div class="col-12">
          <p class="text-center text-white">Tidak ada event atau kompetisi terbaru saat ini.</p>
        </div>
      <?php endif; ?>
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

    <?php if(isset($teaserPhotos) && $teaserPhotos->isNotEmpty()): ?>
        <div class="teaser-gallery-slider-container">
            <div class="teaser-gallery-slider">
                <?php $__currentLoopData = $teaserPhotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="teaser-gallery-slide">
                        <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden image-hover-overlay-container">
                            <img src="<?php echo e(asset('uploads/' . $photo->image_path)); ?>" class="card-img-top" alt="<?php echo e($photo->title ?? 'Foto Galeri ISC'); ?>" style="height: 200px; object-fit: cover; display: block;">
                            <div class="image-hover-overlay">
                                <?php if($photo->title): ?>
                                    <div class="photo-title"><?php echo e($photo->title); ?></div>
                                <?php endif; ?>
                                <?php if($photo->photoCategory): ?>
                                    <div class="photo-category">Kategori: <?php echo e($photo->photoCategory->name); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php if($teaserPhotos->count() > 3): ?> 
                <button class="slider-nav-button prev" onclick="slideGallery('prev')"><i class="bi bi-chevron-left"></i></button>
                <button class="slider-nav-button next" onclick="slideGallery('next')"><i class="bi bi-chevron-right"></i></button>
            <?php endif; ?>
        </div>
        <div class="text-center mt-5">
            <a href="<?php echo e(route('gallery.isc.index')); ?>" class="btn btn-primary btn-lg">Lihat Semua Galeri Foto</a>
        </div>
    <?php else: ?>
        <div class="text-center py-4">
            <i class="bi bi-images fs-1 text-muted mb-3"></i>
            <h4 class="text-muted">Galeri foto ISC akan segera hadir.</h4>
        </div>
    <?php endif; ?>
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

<?php $__env->stopSection(); ?>





<?php $__env->startPush('scripts'); ?>
<script>
    let currentSlide = 0;
    const slider = document.querySelector('.teaser-gallery-slider');
    const slides = document.querySelectorAll('.teaser-gallery-slide');
    let slideWidth = 0; // Akan dihitung
    const visibleSlides = 3; // Jumlah slide yang ingin ditampilkan sekaligus, sesuaikan

    function calculateSlideWidth() {
        if (slides.length > 0) {
            const slideStyle = getComputedStyle(slides[0]);
            slideWidth = slides[0].offsetWidth + parseInt(slideStyle.marginRight);
        } else {
            slideWidth = 0;
        }
    }

    function updateSliderPosition() {
        if (!slider || slides.length === 0) return;
        // Pastikan currentSlide tidak negatif atau melebihi batas yang wajar
        const totalSlides = slides.length;
        currentSlide = Math.max(0, Math.min(currentSlide, totalSlides - visibleSlides));
        slider.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
    }

    function slideGallery(direction) {
        const totalSlides = slides.length;
        if (!slider || totalSlides === 0) return;

        if (direction === 'next') {
            if (currentSlide < totalSlides - visibleSlides) {
                currentSlide++;
            }
        } else if (direction === 'prev') {
            if (currentSlide > 0) {
                currentSlide--;
            }
        }
        updateSliderPosition();
    }

    // Inisialisasi
    if (slider && slides.length > 0) {
        calculateSlideWidth();
        updateSliderPosition(); // Set posisi awal

        window.addEventListener('resize', () => {
            calculateSlideWidth();
            updateSliderPosition(); // Update posisi saat resize
        });
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Indonesia_Science_Center\resources\views/dashboard.blade.php ENDPATH**/ ?>