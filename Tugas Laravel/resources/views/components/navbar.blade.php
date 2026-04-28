@props(['username' => 'Guest'])

<header class="site-header">
  <nav class="navbar">
    <div class="brand">
      <img src="{{ asset('images/Logo Robux.jpg') }}" alt="Logo RobuxRadit" class="brand-logo"
           onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';">
      <div class="brand-badge" style="display:none;">RR</div>
      <div>
        <h1>Inventaris RobuxRadit</h1>
        <p>Kelola data barang dengan lebih rapi dan cepat</p>
      </div>
    </div>

    <ul class="nav-menu">
      <li>
        <a href="{{ route('dashboard', ['username' => $username]) }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
          Dashboard
        </a>
      </li>
      <li>
        <a href="{{ route('pengelolaan', ['username' => $username]) }}" class="{{ (request()->routeIs('pengelolaan') || request()->routeIs('barang.*')) ? 'active' : '' }}">
          Pengelolaan
        </a>
      </li>
      <li>
        <a href="{{ route('profile', ['username' => $username]) }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">
          Profil
        </a>
      </li>
      <li>
        <a href="{{ route('logout') }}" class="nav-logout">Keluar</a>
      </li>
    </ul>

    <div class="nav-user">
      <span>👤 {{ $username }}</span>
    </div>
  </nav>
</header>
