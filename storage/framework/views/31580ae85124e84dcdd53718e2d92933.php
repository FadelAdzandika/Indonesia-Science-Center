 

<?php $__env->startSection('title', 'Daftar Wahana (Admin)'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Wahana (Admin)</h1>
        <div>
            <a href="<?php echo e(route('admin.wahana.create')); ?>" class="btn btn-primary">Tambah Wahana Baru</a>
            
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Gambar</th>
                <th>Video</th>
                <th>Nama Wahana</th>
                <th>Status Terbaru</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $wahanas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wahana): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($wahana->id); ?></td>
                    <td>
                        <?php if($wahana->image): ?>
                            <img src="<?php echo e(asset('storage/' . $wahana->image)); ?>" alt="<?php echo e($wahana->name); ?>" width="100" style="object-fit: cover; height: 70px; border-radius: 4px;">
                        <?php else: ?>
                            <span class="text-muted">N/A</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($wahana->video_embed_url): ?>
                            <a href="<?php echo e($wahana->video_embed_url); ?>" target="_blank" class="btn btn-sm btn-info" title="Lihat Video"><i class="bi bi-play-circle"></i></a>
                            
                        <?php else: ?>
                            <span class="text-muted">N/A</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($wahana->name); ?></td>
                    <td>
                        <?php if($wahana->is_new): ?>
                            <span class="badge bg-success">Ya</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Tidak</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        
                        <a href="<?php echo e(route('admin.wahana.edit', $wahana->id)); ?>" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                        <form action="<?php echo e(route('admin.wahana.destroy', $wahana->id)); ?>" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus wahana ini?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada wahana.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="mt-4">
        <?php echo e($wahanas->links()); ?> 
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Indonesia_Science_Center\resources\views/admin/wahana/index.blade.php ENDPATH**/ ?>