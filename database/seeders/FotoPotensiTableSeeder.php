<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FotoPotensiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('foto_potensis')->insert([
            [
                'foto_potensi' => 'fotoPotensi/tLizJKsO7ugBLMm5ivMzsufPMxmXDpK3kDPyZGnk.jpg',
                'deskripsi_foto' => ' gambarnya bagus',
                'potensi_desas_id' => '1',
            ],
            [
                'foto_potensi' => 'fotoPotensi/Jw2FhLczwoi7VmPCH9ey99wYhtH0ZKsygVHZb0wH.jpg',
                'deskripsi_foto' => ' gambarnyabedaaa',
                'potensi_desas_id' => '1',
            ],
            [
                'foto_potensi' => 'fotoPotensi/0ZrMQW4Ckess8ZzU99kzI5Rw2L2duVvKLsaYPXx3.jpg',
                'deskripsi_foto' => ' gambarnyabedaaa',
                'potensi_desas_id' => '1',
            ],
            [
                'foto_potensi' => 'fotoPotensi/i6PvtrRQCMlPQmOaXI7psWVYLslMtcJ5uK200uJ5.jpg',
                'deskripsi_foto' => ' gambarnyabedaaa',
                'potensi_desas_id' => '1',
            ],
            [
                'foto_potensi' => 'fotoPotensi/xGO7MCJjaDvLAa2bKNw80JaqYJWwC42ZLnxaGtnu.jpg',
                'deskripsi_foto' => ' gambarnyabedaaa',
                'potensi_desas_id' => '1',
            ],
            [
                'foto_potensi' => 'fotoPotensi/68msmj6k1aUVAsShKCIFCHmg8wHuVt4RsaBoatPW.jpg',
                'deskripsi_foto' => ' gambarnyabedaaa',
                'potensi_desas_id' => '2',
            ],
            [
                'foto_potensi' => 'fotoPotensi/Hp39LapaaQj5iF81daAAMl1gZn1uOEDPX9wABxhQ.jpg',
                'deskripsi_foto' => ' gambarnyabedaaa',
                'potensi_desas_id' => '2',
            ],

        ]);
    }
}
