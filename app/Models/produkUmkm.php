<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use App\Models\umkm;

class produkUmkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'foto_produk',
        'deskripsi_produk',
        'harga_terendah',
        'harga_tertinggi',
        'umkm_id'
    ];

    public function umkm()
    {
        return $this->belongsTo(umkm::class);
    }

    //menghapus foto dari direktori public->fotoProdukUmkm
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($produks) {
            //menghapus file gambar dari direktori public->fotoProdukUmkm

            $imagePath = public_path('fotoProdukUmkm/' . $produks->foto_produk);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        });
        static::updating(function ($produks) {
            //cek apakah atribut foto diubah
            if ($produks->isDirty('foto_produk')) {
                //hapus file foto lama dari direktori
                $imagePath = public_path('fotoProdukUmkm/' . $produks->getOriginal('foto_produk'));
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        });
    }
}