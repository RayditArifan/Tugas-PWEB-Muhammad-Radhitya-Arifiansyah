<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $username = trim($request->query('username', ''));

        if ($username === '') {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $totalBarang = Barang::count();
        $totalStok = Barang::sum('stok');
        $totalNilai = Barang::select(DB::raw('COALESCE(SUM(stok * harga), 0) as total'))->value('total');
        $stokMenipis = Barang::menipis()->count();

        return view('dashboard', compact(
            'username',
            'totalBarang',
            'totalStok',
            'totalNilai',
            'stokMenipis'
        ));
    }
}
