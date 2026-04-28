<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $barangs = [
            ['kode' => 'BRG-001', 'nama' => 'Gamepass Dandys', 'kategori' => 'Gamepass', 'stok' => 12, 'harga' => 35000, 'tanggal_masuk' => '2026-04-10'],
            ['kode' => 'BRG-002', 'nama' => 'Voucher Robux 400', 'kategori' => 'Voucher', 'stok' => 4, 'harga' => 79000, 'tanggal_masuk' => '2026-04-11'],
            ['kode' => 'BRG-003', 'nama' => 'Private Server Sailor Piece', 'kategori' => 'Private Server', 'stok' => 7, 'harga' => 129000, 'tanggal_masuk' => '2026-04-12'],
            ['kode' => 'BRG-004', 'nama' => 'Gamepass VIP Blox Fruits', 'kategori' => 'Gamepass', 'stok' => 3, 'harga' => 89000, 'tanggal_masuk' => '2026-04-13'],
            ['kode' => 'BRG-005', 'nama' => 'Voucher Robux 800', 'kategori' => 'Voucher', 'stok' => 9, 'harga' => 149000, 'tanggal_masuk' => '2026-04-14'],
            ['kode' => 'BRG-006', 'nama' => 'Private Server King Legacy', 'kategori' => 'Private Server', 'stok' => 2, 'harga' => 99000, 'tanggal_masuk' => '2026-04-15'],
        ];

        foreach ($barangs as $barang) {
            Barang::updateOrCreate(['kode' => $barang['kode']], $barang);
        }
    }
}
