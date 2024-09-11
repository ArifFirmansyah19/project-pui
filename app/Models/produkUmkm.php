<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use App\Models\umkm;

class produkUmkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'foto_produk',
        'deskripsi_produk',
        'harga_terendah',
        'harga_tertinggi',
        'umkm_id'
    ];

    public function umkm()
    {
        return $this->belongsTo(umkm::class);
    }
}
