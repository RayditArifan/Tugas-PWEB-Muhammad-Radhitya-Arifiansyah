<?php if(session('success')): ?>
  <div class="flash flash-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if(session('error')): ?>
  <div class="flash flash-error"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<?php if(session('info')): ?>
  <div class="flash flash-info"><?php echo e(session('info')); ?></div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\Robuxraditt\resources\views/partials/flash.blade.php ENDPATH**/ ?>