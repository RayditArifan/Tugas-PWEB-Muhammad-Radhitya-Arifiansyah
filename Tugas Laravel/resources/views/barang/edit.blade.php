@extends('layouts.app')

@section('title', 'Edit Barang - RobuxRadit')

@section('content')

<section class="hero">
  <div>
    <span class="hero-tag">Update • Edit Stok Barang</span>
    <h2>Edit Barang</h2>
    <p>Ubah data atau stok barang <strong>{{ $barang->nama }}</strong>.</p>
  </div>
</section>

<section class="form-section">
  <div class="section-heading">
    <h2>Form Edit Barang</h2>
    <p>Perubahan akan disimpan ke tabel barang setelah tombol update ditekan.</p>
  </div>

  <form action="{{ route('barang.update', ['barang' => $barang->id, 'username' => $username]) }}" method="POST">
    @method('PUT')
    @include('barang._form', ['submitLabel' => 'Update Barang'])
  </form>
</section>

@endsection
