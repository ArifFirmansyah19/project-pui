<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\desaPotensi;


class PotensiDesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_potensi',
        'foto_potensi',
        'deskripsi_potensi',
        'desa_potensi_id'
    ];

    public function desaPotensi()
    {
        return $this->belongsTo(desaPotensi::class);
    }
}
