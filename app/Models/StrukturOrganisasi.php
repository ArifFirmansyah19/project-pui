<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class StrukturOrganisasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'foto_struktur_organisasi',
    ];

    // Accessor for formatted created_at
    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d-m-Y');
    }
    //menghapus foto dari direktori public->fotoKegiatan
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($strukturOrganisasi) {
            //cek apakah atribut foto diubah
            if ($strukturOrganisasi->isDirty('foto_struktur_organisasi')) {
                //hapus file foto lama dari direktori
                $imagePath = public_path('fotoStrukturOrganisasi/' . $strukturOrganisasi->getOriginal('foto_struktur_organisasi'));
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        });
    }
}
