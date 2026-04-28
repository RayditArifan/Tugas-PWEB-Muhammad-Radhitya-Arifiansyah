@extends('layouts.app')

@section('title', 'Dashboard — Inventaris RobuxRadit')

@section('content')

<section class="hero">
  <div>
    <span class="hero-tag">Dashboard • Statistik • Ringkasan</span>
    <h2>Selamat datang, {{ $username }}! 👋</h2>
    <p>
      Pantau statistik inventaris barang roblox kamu dalam satu tampilan ringkas.
    </p>
  </div>
</section>

<section id="dashboard" class="dashboard-section">
  <div class="section-heading">
    <h2>Statistik Inventaris</h2>
    <p>Ringkasan data barang saat ini.</p>
  </div>

  <div class="card-grid">

    <article class="card stat-card">
      <p class="stat-label">Total Jenis Barang</p>
      <h3>{{ $totalBarang }}</h3>
      <small>Jumlah jenis barang terdaftar</small>
    </article>

    <article class="card stat-card">
      <p class="stat-label">Total Stok</p>
      <h3>{{ $totalStok }}</h3>
      <small>Total seluruh unit barang</small>
    </article>

    <article class="card stat-card">
      <p class="stat-label">Total Nilai Inventaris</p>
      <h3>Rp {{ number_format($totalNilai, 0, ',', '.') }}</h3>
      <small>Stok × harga per barang</small>
    </article>

    <article class="card stat-card warning-card">
      <p class="stat-label">Stok Menipis</p>
      <h3>{{ $stokMenipis }}</h3>
      <small>Barang dengan stok &lt; 5</small>
    </article>

  </div>
</section>

<div class="stock-note">
  <h2>Keterangan Status Stok</h2>
  <p><strong>Aman</strong> berarti stok masih 5 atau lebih.</p>
  <p><strong>Menipis</strong> berarti stok di bawah 5.</p>
</div>


<section class="quick-action-section">
  <div class="section-heading">
    <h2>Aksi Cepat</h2>
    <p>Navigasi langsung ke halaman yang kamu butuhkan.</p>
  </div>
  <div class="quick-grid">
    <a href="{{ route('pengelolaan', ['username' => $username]) }}" class="quick-card">
      <span class="quick-icon">📦</span>
      <h3>Kelola Inventaris</h3>
      <p>Lihat dan kelola seluruh daftar barang.</p>
    </a>
    <a href="{{ route('profile', ['username' => $username]) }}" class="quick-card">
      <span class="quick-icon">👤</span>
      <h3>Profil Saya</h3>
      <p>Lihat informasi akun kamu.</p>
    </a>
  </div>
</section>

@endsection
