@extends('layouts.app')

@section('title', 'Pengelolaan Inventaris - RobuxRadit')

@section('content')

<section class="hero">
  <div>
    <span class="hero-tag">Pengelolaan - CRUD Barang - Stok</span>
    <h2>Pengelolaan Inventaris</h2>
    <p>Halo <strong>{{ $username }}</strong>, di halaman ini kamu bisa menambah, melihat detail, mengubah, dan menghapus barang.</p>
  </div>
</section>

<section class="dashboard-section">
  <div class="section-heading section-heading-row">
    <div>
      <h2>Ringkasan Barang</h2>
      <p>Total {{ $totalBarang }} jenis barang terdaftar.</p>
    </div>
    <a href="{{ route('barang.create') }}" class="btn btn-primary">+ Tambah Barang</a>
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
            <td>{{ optional($barang->tanggal_masuk)->translatedFormat('d F Y') ?? '-' }}</td>
            <td>
              @if ($barang->stok < 5)
                <span class="badge badge-low">Menipis</span>
              @else
                <span class="badge badge-safe">Aman</span>
              @endif
            </td>
            <td>
              <div class="action-group">
                <a href="{{ route('barang.show', $barang) }}" class="action-btn detail">Detail</a>
                <a href="{{ route('barang.edit', $barang) }}" class="action-btn edit">Edit</a>
                <form action="{{ route('barang.destroy', $barang) }}" method="POST" class="delete-form" data-name="{{ $barang->nama }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="action-btn delete">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="9" class="empty-text">Belum ada data barang.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="pagination-wrapper">
    {{ $barangs->links() }}
  </div>
</section>

@endsection

@push('scripts')
<script>
  document.querySelectorAll('.delete-form').forEach(function (form) {
    form.addEventListener('submit', function (event) {
      const namaBarang = form.dataset.name || 'barang ini';
      if (!confirm('Yakin ingin menghapus ' + namaBarang + '?')) {
        event.preventDefault();
      }
    });
  });
</script>
@endpush
