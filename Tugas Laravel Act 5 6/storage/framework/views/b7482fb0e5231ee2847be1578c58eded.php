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
      <?php if(auth()->guard()->check()): ?>
        <li>
          <a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
            Dashboard
          </a>
        </li>

        <li>
          <a href="<?php echo e(route('pengelolaan')); ?>" class="<?php echo e(request()->routeIs('pengelolaan') || request()->routeIs('barang.*') ? 'active' : ''); ?>">
            Pengelolaan
          </a>
        </li>

        <li>
          <a href="<?php echo e(route('profile')); ?>" class="<?php echo e(request()->routeIs('profile') ? 'active' : ''); ?>">
            Profil
          </a>
        </li>
      <?php endif; ?>

      <li>
        <a href="<?php echo e(route('tentang')); ?>" class="<?php echo e(request()->routeIs('tentang') ? 'active' : ''); ?>">
          Tentang
        </a>
      </li>

      <li>
        <a href="<?php echo e(route('kontak')); ?>" class="<?php echo e(request()->routeIs('kontak') ? 'active' : ''); ?>">
          Kontak
        </a>
      </li>

      <?php if(auth()->guard()->guest()): ?>
        <li>
          <a href="<?php echo e(route('login')); ?>">Login</a>
        </li>
        <li>
          <a href="<?php echo e(route('register')); ?>">Register</a>
        </li>
      <?php endif; ?>

      <?php if(auth()->guard()->check()): ?>
        <li>
          <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="nav-logout">Keluar</button>
          </form>
        </li>
      <?php endif; ?>
    </ul>

    <div class="nav-user">
      <?php if(auth()->guard()->check()): ?>
        <span>👤 <?php echo e(auth()->user()->name); ?></span>
      <?php else: ?>
        <span>👤 Guest</span>
      <?php endif; ?>
    </div>
  </nav>
</header><?php /**PATH C:\laragon\www\Robuxraditt\resources\views/partials/navbar.blade.php ENDPATH**/ ?>