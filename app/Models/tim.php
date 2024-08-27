<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
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

    //menghapus foto dari direktori public->fotoTim
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($data) {
            //menghapus file gambar dari direktori public->fotoTim

            $imagePath = public_path('fotoTim/' . $data->foto);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        });
        static::updating(function ($data) {
            //cek apakah atribut foto diubah
            if ($data->isDirty('foto')) {
                //hapus file foto lama dari direktori
                $imagePath = public_path('fotoTim/' . $data->getOriginal('foto'));
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        });
    }
}