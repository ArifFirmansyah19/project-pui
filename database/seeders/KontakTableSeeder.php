<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KontakTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('kontaks')->insert([
            [
                'alamat' => 'Jalan Raya Jambi-Ma. Bulian KM.15, Mendalo Indah, Muaro Jambi, Jambi, Indonesia',
                'email' => 'sa354127@gmail.com',
                'telepon' => '6285162554117',
                'facebook' => 'facebook PUI',
                'twitter' => 'Twitter PUI',
                'instagram' => 'https://www.instagram.com/itschan310/profilecard/?igsh=MXM3bmZ0ejk4c3ZyaQ==',
                'youtube' => 'https://youtu.be/T26iuRFbAl4?feature=shared',
                'tiktok' => 'https://www.tiktok.com/@_thisme_arif?_t=8qL5YVHDfuB&_r=1',
            ],
        ]);
    }
}
