@extends('layouts.app')

@section('title', 'Dashboard — Inventaris RobuxRadit')

@section('content')

<section class="hero">
  <div>
    <span class="hero-tag">Dashboard • Statistik • Ringkasan</span>
    <h2>Selamat datang, {{ $username }}! 👋</h2>
    <p>
      Pantau statistik inventaris barang Roblox kamu dalam satu tampilan ringkas.
    </p>
  </div>
</section>

@php
  $statCards = [
    [
      'judul' => 'Total Jenis Barang',
      'nilai' => $totalBarang ?? 0,
      'ikon' => '📦',
      'warna' => '',
      'keterangan' => 'Jumlah jenis barang terdaftar',
    ],
    [
      'judul' => 'Total Stok',
      'nilai' => $totalStok ?? 0,
      'ikon' => '📊',
      'warna' => '',
      'keterangan' => 'Total seluruh unit barang',
    ],
    [
      'judul' => 'Total Nilai Inventaris',
      'nilai' => 'Rp ' . number_format($totalNilai ?? 0, 0, ',', '.'),
      'ikon' => '💰',
      'warna' => '',
      'keterangan' => 'Stok × harga per barang',
    ],
    [
      'judul' => 'Stok Menipis',
      'nilai' => $stokMenipis ?? 0,
      'ikon' => '⚠️',
      'warna' => 'warning-card',
      'keterangan' => 'Barang dengan stok kurang dari 5',
    ],
  ];
@endphp

<section id="dashboard" class="dashboard-section">
  <div class="section-heading">
    <h2>Statistik Inventaris</h2>
    <p>Ringkasan data barang saat ini.</p>
  </div>

  <div class="card-grid">
    @forelse ($statCards as $stat)
      <x-stat-card
        :judul="$stat['judul']"
        :nilai="$stat['nilai']"
        :ikon="$stat['ikon']"
        :warna="$stat['warna']"
      >
        {{ $stat['keterangan'] }}
      </x-stat-card>
    @empty
      <article class="card stat-card">
        <p class="stat-label">Belum Ada Statistik</p>
        <h3>0</h3>
        <small>Data statistik belum tersedia.</small>
      </article>
    @endforelse
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

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    console.log('Halaman dashboard berhasil dimuat.');
  });
</script>
@endpush
