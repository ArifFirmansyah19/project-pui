<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SejarahTableSeeder::class);
        $this->call(VisiMisiTableSeeder::class);
        $this->call(StrukturOrganisasiTableSeeder::class);
        $this->call(DivisiTableSeeder::class);
        // $this->call(JabatanTableSeeder::class);
        $this->call(TimTableSeeder::class);
        $this->call(ArtikelTableSeeder::class);
        $this->call(HkisTableSeeder::class);
        $this->call(KegiatanTableSeeder::class);
        $this->call(KecamatanTableSeeder::class);
        $this->call(PotensiDesaTableSeeder::class);
        $this->call(FotoPotensiTableSeeder::class);
        $this->call(UmkmTableSeeder::class);
        $this->call(ProdukUmkmTableSeeder::class);
        $this->call(JenisKeragamanSeeder::class);
        $this->call(MuseumGeoparkTableSeeder::class);
        $this->call(DataKeragamanSeeder::class);
        $this->call(KontakMuseumTableSeeder::class);
        $this->call(KontakTableSeeder::class);
    }
}
