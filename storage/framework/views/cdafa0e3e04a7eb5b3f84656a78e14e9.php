<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <h3 class="mb-4">Login</h3>
      <form method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary w-100 mb-2">Login</button>
      </form>
      <div class="text-center mt-2">
        <span>Belum punya akun?</span>
        <a href="<?php echo e(route('register')); ?>" class="btn btn-link">Register</a>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Indonesia_Science_Center\resources\views/auth/login.blade.php ENDPATH**/ ?>