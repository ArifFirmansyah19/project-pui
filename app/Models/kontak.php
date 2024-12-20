<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    protected $table = "kontaks";
    protected $primaryKey = "id";
    protected $fillable =
    [
        'alamat',
        'email',
        'telepon',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'tiktok',
    ];
}
