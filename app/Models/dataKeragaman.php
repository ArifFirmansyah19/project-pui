<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisKeragaman;
use Illuminate\Support\Facades\File;


class DataKeragaman extends Model
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
        return $this->belongsTo(JenisKeragaman::class, 'jenis_keragaman_id');
    }
}