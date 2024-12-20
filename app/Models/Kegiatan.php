<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\CommentKegiatan;

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

    public function comments()
    {
        return $this->hasMany(CommentKegiatan::class, 'kegiatan_id');
    }

    // Accessor for formatted created_at
    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d-m-Y');
    }
}
