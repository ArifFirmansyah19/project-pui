<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use App\Models\Umkm;
use App\Models\PotensiDesa;

class Kecamatan extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'nama_kecamatan',
    ];

    public function umkm()
    {
        return $this->hasMany(Umkm::class);
    }

    public function potensiDesa()
    {
        return $this->hasMany(PotensiDesa::class, 'kecamatan_id');
    }

    // Event Deleting untuk menghapus foto terkait di storage
    protected static function booted()
    {
        static::deleting(function ($kecamatan) {
            // Hapus foto potensi terkait kecamatan
            foreach ($kecamatan->potensiDesa as $potensi) {
                foreach ($potensi->fotoPotensi as $fotoPotensi) {
                    if ($fotoPotensi->foto_potensi && Storage::exists('public/' . $fotoPotensi->foto_potensi)) {
                        Storage::delete('public/' . $fotoPotensi->foto_potensi);
                    }
                    $fotoPotensi->delete();  // Hapus data fotoPotensi di database
                }
            }

            // Hapus foto produk UMKM terkait kecamatan
            foreach ($kecamatan->umkm as $umkm) {
                foreach ($umkm->produkUmkm as $produk) {
                    if ($produk->foto_produk && Storage::exists('public/' . $produk->foto_produk)) {
                        Storage::delete('public/' . $produk->foto_produk);
                    }
                    $produk->delete();  // Hapus data produkUmkm di database
                }
            }
        });
    }
}