<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PotensiDesaTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('potensi_desas')->insert([
            [
                'nama_potensi' => 'Sungai Batang Merangin',
                'longitude' => '103.23904037475587',
                'latitude' => '-1.756936279036692',
                'deskripsi_potensi' => ' Sungai ini merupakan jalur utama untuk menikmati keindahan alam dan fosil-fosil purba yang ada di sekitar Desa Air Batu. Selain nilai sejarahnya, sungai ini juga menawarkan potensi wisata arung jeram yang menarik bagi pengunjung yang menyukai petualangan.',
                'alamat' => 'desa cikarang',
                'kecamatan_id' => '1',
            ],
            [
                'nama_potensi' => 'Keindahan Alam Pegunungan',
                'longitude' => '103.36606979370119',
                'latitude' => '-1.9155556766799688',
                'deskripsi_potensi' => 'Desa ini dikelilingi oleh pemandangan pegunungan yang indah, dengan berbagai formasi batuan dan panorama alam yang menawan. Potensi ini sangat mendukung kegiatan wisata alam, seperti trekking, hiking, dan camping.',
                'alamat' => 'desa cikarang',
                'kecamatan_id' => '2',
            ],
        ]);
    }
}
