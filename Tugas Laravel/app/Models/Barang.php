<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'kategori',
        'stok',
        'harga',
        'tanggal_masuk',
    ];

    protected $casts = [
        'stok' => 'integer',
        'harga' => 'integer',
        'tanggal_masuk' => 'date',
    ];

    public function scopeMenipis($query)
    {
        return $query->where('stok', '<', 5);
    }

    public function getStatusAttribute(): string
    {
        return $this->stok < 5 ? 'Menipis' : 'Aman';
    }
}
