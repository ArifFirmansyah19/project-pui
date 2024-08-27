<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = "kegiatans";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama_kegiatan',
        'foto_kegiatan',
        'deskripsi_kegiatan',
    ];

    // Accessor for formatted created_at
    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d-m-Y');
    }
}
