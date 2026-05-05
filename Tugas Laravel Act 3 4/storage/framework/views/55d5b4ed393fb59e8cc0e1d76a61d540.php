<?php echo csrf_field(); ?>

<div class="form-grid">
  <div class="form-group">
    <label for="kode">Kode Barang</label>
    <input type="text" id="kode" name="kode" value="<?php echo e(old('kode', $barang->kode ?? '')); ?>" placeholder="Contoh: BRG-007">
    <?php $__errorArgs = ['kode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="error-message"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>

  <div class="form-group">
    <label for="nama">Nama Barang</label>
    <input type="text" id="nama" name="nama" value="<?php echo e(old('nama', $barang->nama ?? '')); ?>" placeholder="Masukkan nama barang">
    <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="error-message"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>

  <div class="form-group">
    <label for="kategori">Kategori</label>
    <select id="kategori" name="kategori">
      <option value="">Pilih kategori</option>
      <?php $__currentLoopData = ['Gamepass', 'Voucher', 'Private Server']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($kategori); ?>" <?php if(old('kategori', $barang->kategori ?? '') === $kategori): echo 'selected'; endif; ?>><?php echo e($kategori); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php $__errorArgs = ['kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="error-message"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>

  <div class="form-group">
    <label for="stok">Stok</label>
    <input type="number" id="stok" name="stok" min="0" value="<?php echo e(old('stok', $barang->stok ?? 0)); ?>">
    <?php $__errorArgs = ['stok'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="error-message"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>

  <div class="form-group">
    <label for="harga">Harga</label>
    <input type="number" id="harga" name="harga" min="1000" step="1000" value="<?php echo e(old('harga', $barang->harga ?? '')); ?>" placeholder="Contoh: 35000">
    <?php $__errorArgs = ['harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="error-message"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>

  <div class="form-group">
    <label for="tanggal_masuk">Tanggal Masuk</label>
    <input type="date" id="tanggal_masuk" name="tanggal_masuk" value="<?php echo e(old('tanggal_masuk', isset($barang) ? $barang->tanggal_masuk->format('Y-m-d') : date('Y-m-d'))); ?>">
    <?php $__errorArgs = ['tanggal_masuk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="error-message"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
  </div>
</div>

<div class="button-row">
  <button type="submit" class="btn btn-primary"><?php echo e($submitLabel); ?></button>
  <a href="<?php echo e(route('pengelolaan', ['username' => $username])); ?>" class="btn btn-secondary">Batal</a>
</div>
<?php /**PATH C:\laragon\www\Robuxraditt\resources\views/barang/_form.blade.php ENDPATH**/ ?>