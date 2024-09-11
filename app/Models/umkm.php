<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\desaPotensi;
use App\Models\produkUmkm;
use Illuminate\Support\Facades\File;


class umkm extends Model
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
        'foto_umkm',
        'deskripsi_umkm',
        'kontak',
        'whatsapp',
        'email',
        'instagram',
        'desa_potensi_id',
    ];

    public function desaPotensi()
    {
        return $this->belongsTo(desaPotensi::class);
    }

    public function produkUmkm()
    {
        return $this->hasMany(produkUmkm::class);
    }
}
