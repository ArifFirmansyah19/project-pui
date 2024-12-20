<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HkisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hkis')->insert([
            [
                'judul' => 'Buku Panduan/Petunjuk  POTENSI PANAS BUMI DAN GEOSITE KERINCI BERBASIS EDU-WISATA SEBAGAI LABORATORIUM ALAM',
                'nama' => ' HARI WIKI UTAMA, S.T.,M.Eng dan ANGGI DELIANA SIREGAR, S.T.,M.T',
                'deskripsi' => 'Buku Panduan/Petunjuk  POTENSI PANAS BUMI DAN GEOSITE KERINCI BERBASIS EDU-WISATA SEBAGAI LABORATORIUM ALAM',
                'file_path' => 'hkiFiles/A3zuURcXCkvoyKNJI5SK3saTeRaYDrXJwD3yVRyw.pdf',
            ],
            [
                'judul' => 'Peta GEOMORPHOLOGICAL MAP OF MASURAI CALDERA IN MERANGIN JAMBI GEOPARK (MJGp)',
                'nama' => 'HARI WIKI UTAMA, S.T.,M.Eng dan Ir. YULIA MORSA SAID, M.T',
                'deskripsi' => 'Peta GEOMORPHOLOGICAL MAP OF MASURAI CALDERA IN MERANGIN JAMBI GEOPARK (MJGp).',
                'file_path' => 'hkiFiles/1b27Tm9tiVaYpR8CIVFLKdqSqpvjBPJ8g5dT43EJ.pdf',
            ],
            [
                'judul' => 'Teluk Gedang Wood Fossil on the Airbatu Geoheritage of the Merangin Jambi Geopark Aspiring UNESCO Global Geopark; Geohistory and Storytelling Concept.',
                'nama' => 'HARI WIKI UTAMA, S.T.,M.Eng',
                'deskripsi' => 'Teluk Gedang Wood Fossil on the Airbatu Geoheritage of the Merangin Jambi Geopark Aspiring UNESCO Global Geopark; Geohistory and Storytelling Concept.',
                'file_path' => 'hkiFiles/9CmWEk0UlCuKKZpu8Adh9mrH5G5PGxCdp3FgnXYn.pdf',
            ],
            [
                'judul' => 'Geological Disaster Potential due to Active Sumatran Fault System on the Keliling Danau Subdistrict, Kerinci Regency, Jambi',
                'nama' => 'HARI WIKI UTAMA, S.T.,M.Eng',
                'deskripsi' => 'Teluk Gedang Wood Fossil on the Airbatu Geoheritage of the Merangin Jambi Geopark Aspiring UNESCO Global Geopark; Geohistory and Storytelling Concept.',
                'file_path' => 'hkiFiles/LL7cPrZAJ95YzB49empnLcB3CUvQ7FBMvc5H9Gvx.pdf',
            ],
        ]);
    }
}
