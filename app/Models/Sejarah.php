<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    use HasFactory;
    protected $table = "sejarahs";
    protected $primaryKey = "id";
    protected $fillable = [
        'isi_sejarah',
    ];
}