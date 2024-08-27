<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\jabatan;
use App\Models\tim;

class divisi extends Model
{
    use HasFactory;

    protected $table = "divisis";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama_divisi',
        'deskripsi_divisi',
    ];

    public function jabatan()
    {
        return $this->hasMany(jabatan::class);
    }

    public function tim()
    {
        return $this->hasMany(tim::class);
    }
}