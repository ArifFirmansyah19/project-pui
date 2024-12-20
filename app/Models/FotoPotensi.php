<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PotensiDesa;

class FotoPotensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto_potensi',
        'deskripsi_foto',
        'potensi_desas_id'
    ];

    public function potensiDesa()
    {
        return $this->belongsTo(PotensiDesa::class, 'potensi_desas_id');
    }
}
