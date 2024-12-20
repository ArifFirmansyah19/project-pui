<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KontakMuseumTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('kontak_museums')->insert([
            [
                'nama_kontak' => 'Lorem Ipsum',
                'telepon' => '6285162554117',
                'whatsapp' => '6285162554117',
                'email' => 'sa354127@gmail.com',
                'instagram' => 'https://www.instagram.com/itschan310/profilecard/?igsh=MXM3bmZ0ejk4c3ZyaQ==',
                'alamat' => 'Jalan Raya Jambi-Ma. Bulian KM.15, Mendalo Indah, Muaro Jambi, Jambi, Indonesia',
            ],
        ]);
    }
}
