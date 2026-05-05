<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $__env->yieldContent('title', 'Login — Inventaris RobuxRadit'); ?></title>
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body style="padding-top:0; display:flex; flex-direction:column; min-height:100vh; background: linear-gradient(135deg, #1b3a6b, #2980b9, #6b267c);">

  <main style="flex:1; display:flex; align-items:center; justify-content:center; padding: 32px 16px;">
    <?php echo $__env->yieldContent('content'); ?>
  </main>

  <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</body>
</html>
<?php /**PATH C:\laragon\www\Robuxraditt\resources\views/layouts/login.blade.php ENDPATH**/ ?>