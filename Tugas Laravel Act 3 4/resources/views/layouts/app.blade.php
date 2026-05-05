<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Inventaris RobuxRadit — Sistem Manajemen Barang">
  <title>@yield('title', 'Inventaris RobuxRadit')</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  @stack('styles')
</head>
<body>

  @include('partials.navbar', ['username' => $username ?? 'Guest'])

  <main class="page-content">
    @include('partials.flash')
    @yield('content')
  </main>

  @include('partials.footer')

  @stack('scripts')
</body>
</html>
