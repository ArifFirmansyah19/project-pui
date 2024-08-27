<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\desaPotensi;
use App\Models\produkUmkm;
use Illuminate\Support\Facades\File;


class umkm extends Model
{
    use HasFactory;

    protected $table = "umkm";
    protected $primaryKey = "id";
    protected $fillable =
    [
        'nama_umkm',
        'nama_pemilik',
        'alamat_umkm',
        'latitude',
        'longitude',
        'foto_umkm',
        'deskripsi_umkm',
        'kontak',
        'whatsapp',
        'email',
        'instagram',
        'desa_potensi_id',
    ];

    public function desaPotensi()
    {
        return $this->belongsTo(desaPotensi::class);
    }

    public function produkUmkm()
    {
        return $this->hasMany(produkUmkm::class);
    }


    //menghapus foto dari direktori public->fotoUmkm
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($umkmLocations) {
            //menghapus file gambar dari direktori public->fotoUmkm

            $imagePath = public_path('fotoUmkm/' . $umkmLocations->foto_umkm);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        });
        static::updating(function ($umkmLocations) {
            //cek apakah atribut foto diubah
            if ($umkmLocations->isDirty('foto_umkm')) {
                //hapus file foto lama dari direktori
                $imagePath = public_path('fotoUmkm/' . $umkmLocations->getOriginal('foto_umkm'));
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        });
    }
}
