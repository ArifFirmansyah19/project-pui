<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HKI extends Model
{
    use HasFactory;
    protected $table = "hkis";
    protected $primaryKey = "id";
    protected $fillable = [
        'judul',
        'nama',
        'deskripsi',
        'file_path',
    ];
}