<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .admin-dashboard .card-link {
        text-decoration: none;
        color: inherit;
        display: block;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .admin-dashboard .card-link:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .admin-dashboard .card-icon {
        font-size: 2.5rem; /* Ukuran ikon lebih besar */
        margin-bottom: 0.5rem;
    }
    .admin-dashboard .card-title {
        font-weight: 500;
    }
    .admin-dashboard .quick-actions .btn {
        margin-bottom: 0.5rem; /* Jarak antar tombol */
    }
    .admin-dashboard .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: #333;
        border-bottom: 2px solid #eee;
        padding-bottom: 0.5rem;
    }
    .admin-dashboard .stat-card {
        border-left: 4px solid var(--bs-primary); /* Aksen warna */
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5 admin-dashboard">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold">Admin Dashboard</h1>
            <p class="text-muted">Selamat datang kembali, <?php echo e(Auth::user()->name); ?>!</p>
        </div>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-outline-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
  
  
    <div class="mb-5">
        <h2 class="section-title">Manajemen Konten</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div class="col">
                <a href="<?php echo e(route('admin.wahana.index')); ?>" class="card card-link h-100 text-center shadow-sm border-0">
                    <div class="card-body">
                        <div class="card-icon text-primary"><i class="bi bi-bounding-box-circles"></i></div>
                        <h5 class="card-title">Kelola Wahana</h5>
                        <p class="card-text small text-muted">Tambah, edit, atau hapus data wahana.</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="<?php echo e(route('admin.events.index')); ?>" class="card card-link h-100 text-center shadow-sm border-0">
                    <div class="card-body">
                        <div class="card-icon text-success"><i class="bi bi-calendar-event"></i></div>
                        <h5 class="card-title">Kelola Event</h5>
                        <p class="card-text small text-muted">Atur event dan kegiatan yang akan datang.</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="<?php echo e(route('admin.competitions.index')); ?>" class="card card-link h-100 text-center shadow-sm border-0">
                    <div class="card-body">
                        <div class="card-icon text-warning"><i class="bi bi-trophy"></i></div>
                        <h5 class="card-title">Kelola Kompetisi</h5>
                        <p class="card-text small text-muted">Manajemen data kompetisi.</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="<?php echo e(route('admin.photo-categories.index')); ?>" class="card card-link h-100 text-center shadow-sm border-0">
                    <div class="card-body">
                        <div class="card-icon text-info"><i class="bi bi-images"></i></div>
                        <h5 class="card-title">Kategori Galeri</h5>
                        <p class="card-text small text-muted">Kelola kategori untuk galeri foto.</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="<?php echo e(route('admin.photos.index')); ?>" class="card card-link h-100 text-center shadow-sm border-0">
                    <div class="card-body">
                        <div class="card-icon text-secondary"><i class="bi bi-camera"></i></div>
                        <h5 class="card-title">Foto Galeri</h5>
                        <p class="card-text small text-muted">Upload dan kelola foto dalam galeri.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

  <h4 class="mt-5">Wahana Terbaru</h4>
  <?php if(isset($latestWahanas) && $latestWahanas->isNotEmpty()): ?>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Gambar</th>
          <th>Nama Wahana</th>
          <th>Deskripsi Singkat</th>
          <th>Tanggal Dibuat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $latestWahanas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wahana): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td>
            <?php if($wahana->image): ?>
              <img src="<?php echo e(asset('uploads/' . $wahana->image)); ?>" alt="<?php echo e($wahana->name); ?>" width="100" style="object-fit: cover; height: 60px;">
            <?php else: ?>
              <span class="text-muted">N/A</span>
            <?php endif; ?>
          </td>
          <td><?php echo e($wahana->name); ?></td>
          <td><?php echo e(Str::limit($wahana->description, 50)); ?></td> 
          <td><?php echo e($wahana->created_at->format('d M Y H:i')); ?></td>
          <td>
            <a href="<?php echo e(route('admin.wahana.edit', $wahana->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
            
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>Tidak ada wahana yang ditandai sebagai "terbaru" saat ini.</p>
  <?php endif; ?>

  <h4 class="mt-5">Wahana Lama</h4>
  <?php if(isset($oldWahanas) && $oldWahanas->isNotEmpty()): ?>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Gambar</th>
          <th>Nama Wahana</th>
          <th>Deskripsi Singkat</th>
          <th>Tanggal Dibuat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $oldWahanas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wahana): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td>
            <?php if($wahana->image): ?>
              <img src="<?php echo e(asset('uploads/' . $wahana->image)); ?>" alt="<?php echo e($wahana->name); ?>" width="100" style="object-fit: cover; height: 60px;">
            <?php else: ?>
              <span class="text-muted">N/A</span>
            <?php endif; ?>
          </td>
          <td><?php echo e($wahana->name); ?></td>
          <td><?php echo e(Str::limit($wahana->description, 50)); ?></td>
          <td><?php echo e($wahana->created_at->format('d M Y H:i')); ?></td>
          <td>
            <a href="<?php echo e(route('admin.wahana.edit', $wahana->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>Tidak ada wahana lama (yang tidak ditandai terbaru) saat ini.</p>
  <?php endif; ?>

  <h4 class="mt-5">Daftar Event</h4>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Gambar</th>
        <th>Nama Event</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <tr>
        <td>
          <?php if($event->thumbnail): ?>
            <img src="<?php echo e(asset('uploads/' . $event->thumbnail)); ?>" alt="Event Thumbnail" width="100">
          <?php else: ?>
            Tidak ada gambar
          <?php endif; ?>
        </td>
        <td><?php echo e($event->title); ?></td>
        <td><?php echo e($event->event_date ? $event->event_date->format('d M Y') : '-'); ?></td>
        <td>
          <a href="<?php echo e(route('admin.events.edit', $event)); ?>" class="btn btn-warning btn-sm">Edit</a>
          <form action="<?php echo e(route('admin.events.destroy', $event)); ?>" method="POST" class="d-inline">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus event ini?')">Hapus</button>
          </form>
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <tr>
        <td colspan="4" class="text-center">Belum ada event.</td>
      </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <h4 class="mt-5">Daftar Kompetisi</h4>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Gambar</th>
        <th>Nama Kompetisi</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $__empty_1 = true; $__currentLoopData = $competitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <tr>
        <td>
          <?php if($competition->thumbnail): ?>
            <img src="<?php echo e(asset('uploads/' . $competition->thumbnail)); ?>" alt="Competition Thumbnail" width="100">
          <?php else: ?>
            Tidak ada gambar
          <?php endif; ?>
        </td>
        <td><?php echo e($competition->title); ?></td>
        <td><?php echo e($competition->start_date ? $competition->start_date->format('d M Y') : ($competition->date ? $competition->date->format('d M Y') : '-')); ?></td>
        <td>
          <a href="<?php echo e(route('admin.competitions.edit', $competition)); ?>" class="btn btn-warning btn-sm">Edit</a>
          <form action="<?php echo e(route('admin.competitions.destroy', $competition)); ?>" method="POST" class="d-inline">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus kompetisi ini?')">Hapus</button>
          </form>
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <tr>
        <td colspan="4" class="text-center">Belum ada kompetisi.</td>
      </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Indonesia_Science_Center\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>