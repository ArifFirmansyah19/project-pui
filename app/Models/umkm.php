<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\desaPotensi;
use App\Models\ProdukUmkm;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\File;


class Umkm extends Model
{
    use HasFactory;

    protected $table = "umkm";
    protected $primaryKey = "id";
    protected $fillable =
    [
        'nama_umkm',
        'nama_pemilik',
        'alamat_umkm',
        'latitude',
        'longitude',
        // 'foto_umkm',
        'deskripsi_umkm',
        'kontak',
        'whatsapp',
        'email',
        'instagram',
        'kecamatan_id',
    ];

    public function potensiKecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function produkUmkm()
    {
        return $this->hasMany(ProdukUmkm::class);
    }
}