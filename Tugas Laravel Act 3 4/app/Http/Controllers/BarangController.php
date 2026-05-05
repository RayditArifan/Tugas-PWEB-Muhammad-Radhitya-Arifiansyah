<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BarangController extends Controller
{
    public function index()
    {
        $username = session('username', 'radit');

        $barangs = Barang::aktif()->latest()->paginate(10);
        $totalBarang = Barang::aktif()->count();
        $totalStok = Barang::aktif()->sum('stok');
        $totalNilai = Barang::aktif()->selectRaw('COALESCE(SUM(stok * harga), 0) as total')->value('total');
        $stokMenipis = Barang::aktif()->stokMenipis()->count();

        return view('pengelolaan', compact('username', 'barangs', 'totalBarang', 'totalStok', 'totalNilai', 'stokMenipis'));
    }

    public function create()
    {
        $username = session('username', 'radit');
        return view('barang.create', compact('username'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => ['required', 'max:20', 'unique:barangs,kode'],
            'nama' => ['required', 'min:3', 'max:100'],
            'kategori' => ['required', Rule::in(['Gamepass', 'Voucher', 'Private Server'])],
            'stok' => ['required', 'integer', 'min:0'],
            'harga' => ['required', 'numeric', 'min:1000'],
            'tanggal_masuk' => ['required', 'date'],
        ]);

        $validated['aktif'] = true;
        Barang::create($validated);

        return redirect()->route('pengelolaan')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        $username = session('username', 'radit');
        return view('barang.edit', compact('username', 'barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'kode' => ['required', 'max:20', Rule::unique('barangs', 'kode')->ignore($barang->id)],
            'nama' => ['required', 'min:3', 'max:100'],
            'kategori' => ['required', Rule::in(['Gamepass', 'Voucher', 'Private Server'])],
            'stok' => ['required', 'integer', 'min:0'],
            'harga' => ['required', 'numeric', 'min:1000'],
            'tanggal_masuk' => ['required', 'date'],
        ]);

        $barang->update($validated);

        return redirect()->route('pengelolaan')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('pengelolaan')->with('success', 'Barang berhasil dihapus.');
    }
}
