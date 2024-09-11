<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\jabatan;
use App\Models\divisi;


class tim extends Model
{
    use HasFactory;

    protected $table = "tims";
    protected $primaryKey = "id";
    protected $fillable =
    [
        'nama',
        'foto',
        'divisi_id',
        'jabatan_id',
        'bidang_keahlian'
    ];

    public function jabatan()
    {
        return $this->belongsTo(jabatan::class);
    }

    public function divisi()
    {
        return $this->belongsTo(divisi::class);
    }
}