<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\jabatan;
use App\Models\Divisi;


class Tim extends Model
{
    use HasFactory;

    protected $table = "tims";
    protected $primaryKey = "id";
    protected $fillable =
    [
        'nama',
        'foto',
        'divisi_id',
        'jabatan',
        'bidang_keahlian'
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}