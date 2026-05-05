<?php $__env->startSection('title', 'Edit Barang - RobuxRadit'); ?>

<?php $__env->startSection('content'); ?>

<section class="hero">
  <div>
    <span class="hero-tag">Update • Edit Stok Barang</span>
    <h2>Edit Barang</h2>
    <p>Ubah data atau stok barang <strong><?php echo e($barang->nama); ?></strong>.</p>
  </div>
</section>

<section class="form-section">
  <div class="section-heading">
    <h2>Form Edit Barang</h2>
    <p>Perubahan akan disimpan ke tabel barang setelah tombol update ditekan.</p>
  </div>

  <form action="<?php echo e(route('barang.update', ['barang' => $barang->id, 'username' => $username])); ?>" method="POST">
    <?php echo method_field('PUT'); ?>
    <?php echo $__env->make('barang._form', ['submitLabel' => 'Update Barang'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </form>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Robuxraditt\resources\views/barang/edit.blade.php ENDPATH**/ ?>