<?php $__env->startSection('title', 'Detail Barang - RobuxRadit'); ?>

<?php $__env->startSection('content'); ?>

<section class="hero">
  <div>
    <span class="hero-tag">Detail - Barang</span>
    <h2>Detail Barang</h2>
    <p>Informasi lengkap barang <strong><?php echo e($barang->nama); ?></strong>.</p>
  </div>
</section>

<section class="dashboard-section">
  <div class="card detail-card">
    <h3><?php echo e($barang->nama); ?></h3>

    <?php if($barang->foto): ?>
      <div class="barang-photo-wrapper" style="text-align: center; margin-bottom: 20px;">
        <img src="<?php echo e(asset('storage/' . $barang->foto)); ?>" alt="Foto <?php echo e($barang->nama); ?>" class="barang-photo" style="max-width: 100%; max-height: 300px; object-fit: contain; border-radius: 8px;">
      </div>
    <?php else: ?>
      <p>Belum ada foto barang.</p>
    <?php endif; ?>

    <table class="detail-table">
      <tr><th>Kode Barang</th><td><?php echo e($barang->kode); ?></td></tr>
      <tr><th>Nama Barang</th><td><?php echo e($barang->nama); ?></td></tr>
      <tr><th>Kategori</th><td><?php echo e($barang->kategori); ?></td></tr>
      <tr><th>Stok</th><td><?php echo e($barang->stok); ?></td></tr>
      <tr><th>Harga</th><td>Rp <?php echo e(number_format($barang->harga, 0, ',', '.')); ?></td></tr>
      <tr><th>Tanggal Masuk</th><td><?php echo e(optional($barang->tanggal_masuk)->translatedFormat('d F Y') ?? '-'); ?></td></tr>
      <tr><th>Status Stok</th><td><?php echo e($barang->stok < 5 ? 'Menipis' : 'Aman'); ?></td></tr>
    </table>

    <div class="button-row">
      <a href="<?php echo e(route('barang.edit', $barang)); ?>" class="btn btn-primary">Edit Barang</a>
      <a href="<?php echo e(route('pengelolaan')); ?>" class="btn btn-secondary">Kembali</a>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Robuxraditt\resources\views/barang/show.blade.php ENDPATH**/ ?>