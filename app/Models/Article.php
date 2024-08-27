<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Article extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'judul',
        'penulis',
        'foto_artikel',
        'deskripsi',
    ];

    // Accessor for formatted created_at
    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d-m-Y');
    }
}
