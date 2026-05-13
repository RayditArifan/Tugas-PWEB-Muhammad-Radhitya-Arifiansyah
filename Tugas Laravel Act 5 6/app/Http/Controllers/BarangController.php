<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BarangController extends Controller
{
    public function index()
    {
        $username = auth()->user()->name;

        $query = Barang::where('user_id', auth()->id());

        $barangs = (clone $query)->latest()->paginate(10);
        $totalBarang = (clone $query)->count();
        $totalStok = (clone $query)->sum('stok');
        $totalNilai = (clone $query)->selectRaw('COALESCE(SUM(stok * harga), 0) as total')->value('total');
        $stokMenipis = (clone $query)->where('stok', '<', 5)->count();

        return view('pengelolaan', compact(
            'username',
            'barangs',
            'totalBarang',
            'totalStok',
            'totalNilai',
            'stokMenipis'
        ));
    }

    public function create()
    {
        $username = auth()->user()->name;

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
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $validated['user_id'] = auth()->id();
        $validated['aktif'] = true;

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('barang', 'public');
        }

        Barang::create($validated);

        return redirect()
            ->route('pengelolaan')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Barang $barang)
    {
        $this->pastikanPemilik($barang);

        $username = auth()->user()->name;

        return view('barang.show', compact('username', 'barang'));
    }

    public function edit(Barang $barang)
    {
        $this->pastikanPemilik($barang);

        $username = auth()->user()->name;

        return view('barang.edit', compact('username', 'barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $this->pastikanPemilik($barang);

        $validated = $request->validate([
            'kode' => ['required', 'max:20', Rule::unique('barangs', 'kode')->ignore($barang->id)],
            'nama' => ['required', 'min:3', 'max:100'],
            'kategori' => ['required', Rule::in(['Gamepass', 'Voucher', 'Private Server'])],
            'stok' => ['required', 'integer', 'min:0'],
            'harga' => ['required', 'numeric', 'min:1000'],
            'tanggal_masuk' => ['required', 'date'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            if ($barang->foto) {
                Storage::disk('public')->delete($barang->foto);
            }

            $validated['foto'] = $request->file('foto')->store('barang', 'public');
        }

        $barang->update($validated);

        return redirect()
            ->route('pengelolaan')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        $this->pastikanPemilik($barang);

        if ($barang->foto) {
            Storage::disk('public')->delete($barang->foto);
        }

        $barang->delete();

        return redirect()
            ->route('pengelolaan')
            ->with('success', 'Barang berhasil dihapus.');
    }

    private function pastikanPemilik(Barang $barang): void
    {
        $isAdmin = auth()->user()->role === 'admin';

        if (!$isAdmin && $barang->user_id !== auth()->id()) {
            abort(403, 'Kamu tidak punya akses ke data barang ini.');
        }
    }
}
