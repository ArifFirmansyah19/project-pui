<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\jenisKeragaman;
use Illuminate\Support\Facades\File;


class dataKeragaman extends Model
{
    use HasFactory;
    protected $table = 'data_keragamans';

    protected $fillable = [
        'nama',
        'foto_keragaman',
        'deskripsi',
        'lokasi',
        'umur',
        'jenis_keragaman_id',
    ];

    public function jenisKeragaman()
    {
        return $this->belongsTo(jenisKeragaman::class);
    }

    //menghapus foto dari direktori public->fotoKeragaman
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($dataKeragaman) {
            //menghapus file gambar dari direktori public->fotoKeragaman

            $imagePath = public_path('fotoKeragaman/' . $dataKeragaman->foto_keragaman);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        });

        static::updating(function ($dataKeragaman) {
            //cek apakah atribut foto diubah
            if ($dataKeragaman->isDirty('foto_keragaman')) {
                //hapus file foto lama dari direktori
                $imagePath = public_path('fotoKeragaman/' . $dataKeragaman->getOriginal('foto_keragaman'));
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        });
    }
}
