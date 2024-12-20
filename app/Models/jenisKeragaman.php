<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataKeragaman;

class JenisKeragaman extends Model
{
    use HasFactory;
    protected $table = 'jenis_keragamans';

    protected $fillable = [
        'jenis_keragaman',
        'deskripsi_keragaman',
    ];

    public function dataKeragaman()
    {
        return $this->hasMany(DataKeragaman::class, 'jenis_keragaman_id');
    }
}