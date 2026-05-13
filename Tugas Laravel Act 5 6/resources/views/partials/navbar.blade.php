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
      @auth
        <li>
          <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            Dashboard
          </a>
        </li>

        <li>
          <a href="{{ route('pengelolaan') }}" class="{{ request()->routeIs('pengelolaan') || request()->routeIs('barang.*') ? 'active' : '' }}">
            Pengelolaan
          </a>
        </li>

        <li>
          <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">
            Profil
          </a>
        </li>
      @endauth

      <li>
        <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'active' : '' }}">
          Tentang
        </a>
      </li>

      <li>
        <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">
          Kontak
        </a>
      </li>

      @guest
        <li>
          <a href="{{ route('login') }}">Login</a>
        </li>
        <li>
          <a href="{{ route('register') }}">Register</a>
        </li>
      @endguest

      @auth
        <li>
          <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="nav-logout">Keluar</button>
          </form>
        </li>
      @endauth
    </ul>

    <div class="nav-user">
      @auth
        <span>👤 {{ auth()->user()->name }}</span>
      @else
        <span>👤 Guest</span>
      @endauth
    </div>
  </nav>
</header>