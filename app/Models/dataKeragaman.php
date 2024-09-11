<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\jenisKeragaman;
use Illuminate\Support\Facades\File;


class dataKeragaman extends Model
{
    use HasFactory;
    protected $table = 'data_keragamans';

    protected $fillable = [
        'nama',
        'foto_keragaman',
        'deskripsi',
        'lokasi',
        'umur',
        'jenis_keragaman_id',
    ];

    public function jenisKeragaman()
    {
        return $this->belongsTo(jenisKeragaman::class);
    }
}