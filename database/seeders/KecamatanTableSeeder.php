<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KecamatanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kecamatans')->insert([
            [
                'nama_kecamatan' => 'Desa Air Batu',
            ],
            [
                'nama_kecamatan' => 'Desa Biuku Tanjung',
            ],
            [
                'nama_kecamatan' => 'Desa Renah Pembarap',
            ],
            [
                'nama_kecamatan' => 'Desa Rantau Kermas',
            ],
            [
                'nama_kecamatan' => 'Desa Teluk Wang Sakti',
            ],
            [
                'nama_kecamatan' => 'Desa Guguk',
            ],
            [
                'nama_kecamatan' => 'Desa Lubuk Bumbun',
            ],
        ]);
    }
}
