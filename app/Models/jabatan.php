<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tim;
use App\Models\divisi;

class jabatan extends Model
{
    use HasFactory;

    protected $table = "jabatans";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama_jabatan',
        'deskripsi_jabatan',
        'divisi_id',
    ];

    public function tim()
    {
        return $this->hasMany(tim::class);
    }

    public function divisi()
    {
        return $this->belongsTo(divisi::class);
    }
}