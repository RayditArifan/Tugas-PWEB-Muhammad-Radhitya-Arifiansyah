<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['username' => 'Guest']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['username' => 'Guest']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<header class="site-header">
  <nav class="navbar">
    <div class="brand">
      <img src="<?php echo e(asset('images/Logo Robux.jpg')); ?>" alt="Logo RobuxRadit" class="brand-logo"
           onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';">
      <div class="brand-badge" style="display:none;">RR</div>
      <div>
        <h1>Inventaris RobuxRadit</h1>
        <p>Kelola data barang dengan lebih rapi dan cepat</p>
      </div>
    </div>

    <ul class="nav-menu">
      <li>
        <a href="<?php echo e(route('dashboard', ['username' => $username])); ?>" class="<?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
          Dashboard
        </a>
      </li>
      <li>
        <a href="<?php echo e(route('pengelolaan', ['username' => $username])); ?>" class="<?php echo e((request()->routeIs('pengelolaan') || request()->routeIs('barang.*')) ? 'active' : ''); ?>">
          Pengelolaan
        </a>
      </li>
      <li>
        <a href="<?php echo e(route('profile', ['username' => $username])); ?>" class="<?php echo e(request()->routeIs('profile') ? 'active' : ''); ?>">
          Profil
        </a>
      </li>
      <li>
        <a href="<?php echo e(route('logout')); ?>" class="nav-logout">Keluar</a>
      </li>
    </ul>

    <div class="nav-user">
      <span>👤 <?php echo e($username); ?></span>
    </div>
  </nav>
</header>
<?php /**PATH C:\laragon\www\Robuxraditt\resources\views/components/navbar.blade.php ENDPATH**/ ?>