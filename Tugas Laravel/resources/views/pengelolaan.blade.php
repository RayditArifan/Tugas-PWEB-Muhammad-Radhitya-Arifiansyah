@extends('layouts.app')

@section('title', 'Pengelolaan Inventaris - RobuxRadit')

@section('content')

<section class="hero">
  <div>
    <span class="hero-tag">Pengelolaan • CRUD Barang • Stok</span>
    <h2>Pengelolaan Inventaris</h2>
    <p>
      Halo <strong>{{ $username }}</strong>, di halaman ini kamu bisa menambah barang, mengubah data, dan menghapus inventaris.
    </p>
  </div>
</section>

<section class="dashboard-section">
  <div class="section-heading section-heading-row">
    <div>
      <h2>Ringkasan Barang</h2>
      <p>Total {{ $totalBarang }} jenis barang terdaftar.</p>
    </div>
    <a href="{{ route('barang.create', ['username' => $username]) }}" class="btn btn-primary">+ Tambah Barang</a>
  </div>

  <div class="card-grid">
    <article class="card stat-card">
      <p class="stat-label">Jenis Barang</p>
      <h3>{{ $totalBarang }}</h3>
      <small>Total jenis</small>
    </article>

    <article class="card stat-card">
      <p class="stat-label">Total Stok</p>
      <h3>{{ $totalStok }}</h3>
      <small>Seluruh unit</small>
    </article>

    <article class="card stat-card">
      <p class="stat-label">Nilai Inventaris</p>
      <h3 class="money-text">Rp {{ number_format($totalNilai, 0, ',', '.') }}</h3>
      <small>Stok x harga</small>
    </article>

    <article class="card stat-card warning-card">
      <p class="stat-label">Stok Menipis</p>
      <h3>{{ $stokMenipis }}</h3>
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
        @forelse ($barangs as $barang)
          <tr>
            <td>{{ $barangs->firstItem() + $loop->index }}</td>
            <td>{{ $barang->kode }}</td>
            <td>{{ $barang->nama }}</td>
            <td><span class="badge-kategori">{{ $barang->kategori }}</span></td>
            <td>{{ $barang->stok }}</td>
            <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
            <td>{{ $barang->tanggal_masuk->translatedFormat('d F Y') }}</td>
            <td>
              @if ($barang->stok < 5)
                <span class="badge badge-low">Menipis</span>
              @else
                <span class="badge badge-safe">Aman</span>
              @endif
            </td>
            <td>
              <div class="action-group">
                <a href="{{ route('barang.edit', ['barang' => $barang->id, 'username' => $username]) }}" class="action-btn edit">Edit</a>
                <form action="{{ route('barang.destroy', ['barang' => $barang->id, 'username' => $username]) }}" method="POST" onsubmit="return confirm('Hapus barang {{ $barang->nama }}?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="action-btn delete">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="9" class="empty-state">Belum ada data barang.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="pagination-box">
    {{ $barangs->links() }}
  </div>
</section>

<div class="stock-note">
  <h2>Keterangan Status Stok</h2>
  <p><strong>Aman</strong> - stok 5 atau lebih, barang masih cukup tersedia.</p>
  <p><strong>Menipis</strong> - stok di bawah 5, segera lakukan penambahan stok.</p>
</div>

@endsection
