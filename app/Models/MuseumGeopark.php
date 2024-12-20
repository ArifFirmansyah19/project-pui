<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MuseumGeopark extends Model
{
    use HasFactory;

    protected $table = "museum_geoparks";
    protected $primaryKey = "id";
    protected $fillable =

    [
        'judul',
        'foto',
        'thumbnail',
        'deskripsi',
    ];
}
