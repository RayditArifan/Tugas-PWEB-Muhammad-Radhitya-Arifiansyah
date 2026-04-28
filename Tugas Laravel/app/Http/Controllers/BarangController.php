<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    private function getUsername(Request $request): ?string
    {
        $username = trim($request->query('username', ''));
        return $username !== '' ? $username : null;
    }

    private function requireUsername(Request $request)
    {
        $username = $this->getUsername($request);

        if (!$username) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $username;
    }

    private function rules(?Barang $barang = null): array
    {
        $ignoreId = $barang ? ',' . $barang->id : '';

        return [
            'kode' => 'required|string|max:20|unique:barangs,kode' . $ignoreId,
            'nama' => 'required|string|min:3|max:100',
            'kategori' => 'required|in:Gamepass,Voucher,Private Server',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|integer|min:1000',
            'tanggal_masuk' => 'required|date',
        ];
    }

    public function index(Request $request)
    {
        $username = $this->requireUsername($request);
        if (!is_string($username)) {
            return $username;
        }

        $barangs = Barang::latest()->paginate(10)->withQueryString();
        $totalBarang = Barang::count();
        $totalStok = Barang::sum('stok');
        $totalNilai = Barang::select(DB::raw('COALESCE(SUM(stok * harga), 0) as total'))->value('total');
        $stokMenipis = Barang::menipis()->count();

        return view('pengelolaan', compact(
            'username',
            'barangs',
            'totalBarang',
            'totalStok',
            'totalNilai',
            'stokMenipis'
        ));
    }

    public function create(Request $request)
    {
        $username = $this->requireUsername($request);
        if (!is_string($username)) {
            return $username;
        }

        return view('barang.create', compact('username'));
    }

    public function store(Request $request)
    {
        $username = $this->requireUsername($request);
        if (!is_string($username)) {
            return $username;
        }

        $validated = $request->validate($this->rules(), [
            'kode.unique' => 'Kode barang sudah digunakan.',
            'nama.min' => 'Nama barang minimal 3 karakter.',
            'stok.min' => 'Stok tidak boleh kurang dari 0.',
            'harga.min' => 'Harga minimal Rp 1.000.',
        ]);

        Barang::create($validated);

        return redirect()
            ->route('pengelolaan', ['username' => $username])
            ->with('success', 'Barang baru berhasil ditambahkan.');
    }

    public function edit(Request $request, Barang $barang)
    {
        $username = $this->requireUsername($request);
        if (!is_string($username)) {
            return $username;
        }

        return view('barang.edit', compact('username', 'barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $username = $this->requireUsername($request);
        if (!is_string($username)) {
            return $username;
        }

        $validated = $request->validate($this->rules($barang), [
            'kode.unique' => 'Kode barang sudah digunakan.',
            'nama.min' => 'Nama barang minimal 3 karakter.',
            'stok.min' => 'Stok tidak boleh kurang dari 0.',
            'harga.min' => 'Harga minimal Rp 1.000.',
        ]);

        $barang->update($validated);

        return redirect()
            ->route('pengelolaan', ['username' => $username])
            ->with('success', 'Data barang berhasil diperbarui.');
    }

    public function destroy(Request $request, Barang $barang)
    {
        $username = $this->getUsername($request) ?? 'radit';
        $barang->delete();

        return redirect()
            ->route('pengelolaan', ['username' => $username])
            ->with('success', 'Data barang berhasil dihapus.');
    }
}
