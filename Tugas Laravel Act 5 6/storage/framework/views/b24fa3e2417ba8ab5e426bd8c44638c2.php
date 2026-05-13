<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Inventaris RobuxRadit — Sistem Manajemen Barang">
  <title><?php echo $__env->yieldContent('title', 'Inventaris RobuxRadit'); ?></title>

  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

  <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

  <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <main class="page-content">
    <?php echo $__env->make('partials.flash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
  </main>

  <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\laragon\www\Robuxraditt\resources\views/layouts/app.blade.php ENDPATH**/ ?>