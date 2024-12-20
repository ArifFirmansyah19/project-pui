<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\desaPotensi;
use App\Models\Kecamatan;


class PotensiDesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_potensi',
        'longitude',
        'latitude',
        // 'foto_potensi',
        'deskripsi_potensi',
        'alamat',
        'kecamatan_id'
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function fotoPotensi()
    {
        return $this->hasMany(FotoPotensi::class, 'potensi_desas_id');
    }
}
