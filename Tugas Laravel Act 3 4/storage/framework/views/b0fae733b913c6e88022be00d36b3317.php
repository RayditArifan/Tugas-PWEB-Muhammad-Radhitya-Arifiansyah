<?php $__env->startSection('title', 'Login — Inventaris RobuxRadit'); ?>

<?php $__env->startSection('content'); ?>

<section class="login-wrapper">
  <div class="login-card">

    <div class="login-header">
      <img src="<?php echo e(asset('images/Logo Robux.jpg')); ?>" alt="Logo" class="login-logo"
           onerror="this.style.display='none'">
      <h2>Inventaris RobuxRadit</h2>
      <p>Masuk untuk mengelola data barang</p>
    </div>

    <?php if(session('error')): ?>
      <div class="alert alert-error"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <form action="<?php echo e(route('login.process')); ?>" method="POST" class="login-form" novalidate>
      <?php echo csrf_field(); ?>

      <div class="form-group">
        <label for="username">Username</label>
        <input
          type="text"
          id="username"
          name="username"
          value="<?php echo e(old('username')); ?>"
          placeholder="Masukkan username"
          autocomplete="username"
          required
        >
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="Masukkan password"
          autocomplete="current-password"
          required
        >
      </div>

      <button type="submit" class="btn btn-primary btn-full">Masuk</button>
    </form>

    <div class="login-hint">
      <p>Akun pass biar g lupa: <strong>radit</strong> / <strong>robux123</strong></p>
    </div>

  </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Robuxraditt\resources\views/login.blade.php ENDPATH**/ ?>