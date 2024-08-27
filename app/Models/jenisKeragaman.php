<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\dataKeragaman;

class jenisKeragaman extends Model
{
    use HasFactory;
    protected $table = 'jenis_keragamans';

    protected $fillable = [
        'jenis_keragaman',
        'deskripsi_keragaman',
    ];

    public function dataKeragaman()
    {
        return $this->hasMany(dataKeragaman::class);
    }
}