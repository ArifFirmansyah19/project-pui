<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakMuseum extends Model
{
    use HasFactory;

    protected $table = "kontak_museums";
    protected $primaryKey = "id";
    protected $fillable =
    [
        'nama_kontak',
        'telepon',
        'whatsapp',
        'email',
        'instagram',
        'alamat',
    ];
}
