<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class VisiMisiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vision_missions')->insert([
            [
                'vision' => 'Pusat Unggulan Ipteks dalam bidang Penelitian dan Pembelajaran Geodiversity, Biodiversity, dan Cultural secara terintegrasi untuk menumbuhkan ekonomi kreatif yang berwawasan lingkungan pada kawasan Geowisata Geoheritage Merangin.',
                // 'missions' => json_encode([
                //     'Penguatan tata kelola kelembagaan PUI GEMAR UNJA sebagai wadah tumbuh kembang penelitian dan pembelajaran Geowisata yang berdaya saing dengan fokus pada eksplorasi dan pemanfaatan potensi sumber daya alam di kawasan Geoheritage Merangin.',
                //     'Memfasilitasi dan memotivasi tumbuh kembang produk-produk hasil riset dan pengembangan yang mampu meningkatkan reputasi peneliti dan Universitas Jambi sebagai lembaga pendidikan tinggi.',
                //     'Mengembangkan dan merealisasikan pembelajaran Kampus Merdeka dan Merdeka Belajar untuk menghasil lulusan Universitas Jambi yang berjiwa excellent technosociopreneur.',
                //     'Memperkuat koordinasi dan konsolidasi antara program studi atau bidang ilmu untuk pengembangan Geowisata Geoheritage Merangin yang terintegrasi dan berkelanjutan dalam satu kawasan.',
                //     'Memperkuat jaringan kerjasama kelembagaan dan kemitraan dengan lembaga penelitian dan pengembangan lainnya dari tingkat regional, nasional dan internasional.',
                //     'Mengembangkan dan mendorong peningkatan taraf sosial dan perekonomian daerah yang terkoneksi dan terintegrasi melalui Tri Darma Perguruan Tinggi Universitas Jambi.'
                'missions' => '
                1. Penguatan tata kelola kelembagaan PUI GEMAR UNJA sebagai wadah tumbuh kembang penelitian dan pembelajaran Geowisata yang berdaya saing dengan fokus pada eksplorasi dan pemanfaatan potensi sumber daya alam di kawasan Geoheritage Merangin.
                2. Memfasilitasi dan memotivasi tumbuh kembang produk-produk hasil riset dan pengembangan yang mampu meningkatkan reputasi peneliti dan Universitas Jambi sebagai lembaga pendidikan tinggi.
                3. Mengembangkan dan merealisasikan pembelajaran Kampus Merdeka dan Merdeka Belajar untuk menghasil lulusan Universitas Jambi yang berjiwa excellent technosociopreneur.
                4. Memperkuat koordinasi dan konsolidasi antara program studi atau bidang ilmu untuk pengembangan Geowisata Geoheritage Merangin yang terintegrasi dan berkelanjutan dalam satu kawasan.
                5. Memperkuat jaringan kerjasama kelembagaan dan kemitraan dengan lembaga penelitian dan pengembangan lainnya dari tingkat regional, nasional dan internasional.
                6. Mengembangkan dan mendorong peningkatan taraf sosial dan perekonomian daerah yang terkoneksi dan terintegrasi melalui Tri Darma Perguruan Tinggi Universitas Jambi.
                ',

            ]
        ]);
    }
}
