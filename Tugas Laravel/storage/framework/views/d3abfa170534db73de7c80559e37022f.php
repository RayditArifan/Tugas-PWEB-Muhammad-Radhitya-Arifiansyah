<?php $__env->startSection('title', 'Pengelolaan Inventaris - RobuxRadit'); ?>

<?php $__env->startSection('content'); ?>

<section class="hero">
  <div>
    <span class="hero-tag">Pengelolaan • CRUD Barang • Stok</span>
    <h2>Pengelolaan Inventaris</h2>
    <p>
      Halo <strong><?php echo e($username); ?></strong>, di halaman ini kamu bisa menambah barang, mengubah data, dan menghapus inventaris.
    </p>
  </div>
</section>

<section class="dashboard-section">
  <div class="section-heading section-heading-row">
    <div>
      <h2>Ringkasan Barang</h2>
      <p>Total <?php echo e($totalBarang); ?> jenis barang terdaftar.</p>
    </div>
    <a href="<?php echo e(route('barang.create', ['username' => $username])); ?>" class="btn btn-primary">+ Tambah Barang</a>
  </div>

  <div class="card-grid">
    <article class="card stat-card">
      <p class="stat-label">Jenis Barang</p>
      <h3><?php echo e($totalBarang); ?></h3>
      <small>Total jenis</small>
    </article>

    <article class="card stat-card">
      <p class="stat-label">Total Stok</p>
      <h3><?php echo e($totalStok); ?></h3>
      <small>Seluruh unit</small>
    </article>

    <article class="card stat-card">
      <p class="stat-label">Nilai Inventaris</p>
      <h3 class="money-text">Rp <?php echo e(number_format($totalNilai, 0, ',', '.')); ?></h3>
      <small>Stok x harga</small>
    </article>

    <article class="card stat-card warning-card">
      <p class="stat-label">Stok Menipis</p>
      <h3><?php echo e($stokMenipis); ?></h3>
      <small>Stok &lt; 5</small>
    </article>
  </div>
</section>

<section id="inventaris-section" class="table-section">
  <div class="section-heading">
    <h2>Daftar Inventaris Barang</h2>
    <p>Data berikut berasal dari tabel <code>barangs</code> melalui Model Barang.</p>
  </div>

  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Kategori</th>
          <th>Stok</th>
          <th>Harga</th>
          <th>Tanggal Masuk</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $barangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td><?php echo e($barangs->firstItem() + $loop->index); ?></td>
            <td><?php echo e($barang->kode); ?></td>
            <td><?php echo e($barang->nama); ?></td>
            <td><span class="badge-kategori"><?php echo e($barang->kategori); ?></span></td>
            <td><?php echo e($barang->stok); ?></td>
            <td>Rp <?php echo e(number_format($barang->harga, 0, ',', '.')); ?></td>
            <td><?php echo e($barang->tanggal_masuk->translatedFormat('d F Y')); ?></td>
            <td>
              <?php if($barang->stok < 5): ?>
                <span class="badge badge-low">Menipis</span>
              <?php else: ?>
                <span class="badge badge-safe">Aman</span>
              <?php endif; ?>
            </td>
            <td>
              <div class="action-group">
                <a href="<?php echo e(route('barang.edit', ['barang' => $barang->id, 'username' => $username])); ?>" class="action-btn edit">Edit</a>
                <form action="<?php echo e(route('barang.destroy', ['barang' => $barang->id, 'username' => $username])); ?>" method="POST" onsubmit="return confirm('Hapus barang <?php echo e($barang->nama); ?>?')">
                  <?php echo csrf_field(); ?>
                  <?php echo method_field('DELETE'); ?>
                  <button type="submit" class="action-btn delete">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
            <td colspan="9" class="empty-state">Belum ada data barang.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div class="pagination-box">
    <?php echo e($barangs->links()); ?>

  </div>
</section>

<div class="stock-note">
  <h2>Keterangan Status Stok</h2>
  <p><strong>Aman</strong> - stok 5 atau lebih, barang masih cukup tersedia.</p>
  <p><strong>Menipis</strong> - stok di bawah 5, segera lakukan penambahan stok.</p>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Robuxraditt\resources\views/pengelolaan.blade.php ENDPATH**/ ?>