<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HalController::class, 'showLogin'])->name('login');
Route::post('/login', [HalController::class, 'processLogin'])->name('login.process');
Route::get('/logout', [HalController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/profile', [HalController::class, 'showProfile'])->name('profile');

Route::get('/pengelolaan', [BarangController::class, 'index'])->name('pengelolaan');
Route::get('/pengelolaan/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/pengelolaan', [BarangController::class, 'store'])->name('barang.store');
Route::get('/pengelolaan/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/pengelolaan/{barang}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/pengelolaan/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');

Route::view('/tentang', 'tentang')->name('tentang');
Route::get('/hitung/{a}/{b}', fn ($a, $b) => (int) $a + (int) $b)
    ->whereNumber(['a', 'b'])
    ->name('hitung');
