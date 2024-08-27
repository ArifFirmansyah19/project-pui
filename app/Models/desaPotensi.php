<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use App\Models\umkm;
use App\Models\PotensiDesa;

class desaPotensi extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'nama_desa',
        'deskripsi_desa',
        'latitude',
        'longitude',
    ];

    public function umkm()
    {
        return $this->hasMany(umkm::class);
    }

    public function potensiDesa()
    {
        return $this->hasMany(PotensiDesa::class, 'desa_potensi_id');
    }
}