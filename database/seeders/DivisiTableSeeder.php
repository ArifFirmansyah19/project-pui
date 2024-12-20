<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DivisiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('divisis')->insert([
            [
                'nama_divisi' => 'Divisi Kepemimpinan Organisasi (Inti)',
                // 'deskripsi_divisi' => 'Divisi Kepemimpinan adalah bagian dari struktur organisasi  PUI GEMAR UNJA yang bertanggung jawab untuk mengatur, mengelola, dan memimpin seluruh kegiatan di dalam organisasi PUI tersebut. Divisi ini biasanya terdiri dari individu-individu yang memiliki posisi strategis, seperti ketua, penanggung jawab, sekretaris, bendahara, dan pengarah.'
            ],
            [
                'nama_divisi' => 'Divisi Penguatan Kapasitas Kelembagaan ',
                // 'deskripsi_divisi' => 'Divisi Penguatan Kapasitas Kelembagaan adalah bagian dari struktur organisasi  PUI GEMAR UNJA yang bertugas untuk meningkatkan kemampuan dan efektivitas lembaga dalam menjalankan fungsinya. Divisi ini berfokus pada pengembangan sumber daya manusia, manajemen, dan struktur organisasi, serta penguatan sistem dan proses yang ada.'
            ],
            [
                'nama_divisi' => 'Divisi Bidang Penguatan Edukasi dan Konservasi ',
                // 'deskripsi_divisi' => 'Divisi Bidang Penguatan Edukasi dan Konservasi adalah bagian dari struktur organisasi PUI GEMAR UNJA yang berfokus pada peningkatan pendidikan serta konservasi sumber daya alam dan lingkungan. Divisi ini bertugas untuk mengembangkan dan melaksanakan program-program edukasi yang bertujuan untuk meningkatkan kesadaran, pemahaman, dan keterlibatan masyarakat dalam isu-isu lingkungan dan konservasi.'
            ],
            [
                'nama_divisi' => 'Divisi Bidang Pengembangan dan Komersialisasi ',
                // 'deskripsi_divisi' => 'Divisi Bidang Pengembangan dan Komersialisasi adalah bagian dari struktur organisasi PUI GEMAR UNJA yang bertugas untuk mengembangkan produk, layanan, atau inovasi dan memasarkan serta menjadikannya komersial yang terdiri dari pengembangan penelitian dan penyebaran informasi tentang keanekaragaman UMKM di wilayah Geopark Merangin Jambi.'
            ]

        ]);
    }
}