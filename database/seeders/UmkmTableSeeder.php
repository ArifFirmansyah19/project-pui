<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UmkmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('umkm')->insert([
            [
                'nama_umkm' => 'Kerajinan Batu Akik',
                'nama_pemilik' => 'Mukhlis',
                'alamat_umkm' => 'Jalan Lingkar Selatan, Muara Bulian, Batanghari, Jambi, Sumatra, Indonesia',
                'longitude' => '103.25303077697755',
                'latitude' => '-1.7547057289093788',
                'deskripsi_umkm' => ' Sungai ini merupakan jalur utama untuk menikmati keindahan alam dan fosil-fosil purba yang ada di sekitar Desa Air Batu. Selain nilai sejarahnya, sungai ini juga menawarkan potensi wisata arung jeram yang menarik bagi pengunjung yang menyukai petualangan.',
                'kontak' => '6282250649883',
                'whatsapp' => '6282250649883',
                'email' => 'sa354127@gmail.com',
                'instagram' => 'https://www.instagram.com/itschan310/profilecard/?igsh=MXM3bmZ0ejk4c3ZyaQ==',
                'kecamatan_id' => '1',
            ],
        ]);
    }
}
