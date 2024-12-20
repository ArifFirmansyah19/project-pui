<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukUmkmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produk_umkms')->insert([
            [
                'nama_produk' => 'Kerajinan 1',
                'foto_produk' => 'fotoProdukUmkm/jjGJZV3jZpvfwc7ADmklRssYrZxobSNfMAhdgwWl.jpg',
                'deskripsi_produk' => ' gambarnya bagus',
                'harga_terendah' => '20000',
                'harga_tertinggi' => '40000',
                'umkm_id' => '1',
            ],
            [
                'nama_produk' => 'Kerajinan 2',
                'foto_produk' => 'fotoProdukUmkm/bhZQ4huu8riZCQqR7qCOrUh3g150AZMGcBUpPtce.jpg',
                'deskripsi_produk' => 'gambarnya bagus',
                'harga_terendah' => '20000',
                'harga_tertinggi' => '20000',
                'umkm_id' => '1',
            ],
            [
                'nama_produk' => 'Kerajinan 3',
                'foto_produk' => 'fotoProdukUmkm/Bjqh7YpgMrKgZC8zVs1OH5usosQHooBmaTEmY9M8.jpg',
                'deskripsi_produk' => 'gambarnya bagus',
                'harga_terendah' => '35000',
                'harga_tertinggi' => '35000',
                'umkm_id' => '1',
            ],
            [
                'nama_produk' => 'Kerajinan 4',
                'foto_produk' => 'fotoProdukUmkm/5cG4LGCedOxiLT0w9worCfzsHGB5riWspDCDdGfZ.jpg',
                'deskripsi_produk' => 'gambarnya bagus',
                'harga_terendah' => '75000',
                'harga_tertinggi' => '100000',
                'umkm_id' => '1',
            ],


        ]);
    }
}
