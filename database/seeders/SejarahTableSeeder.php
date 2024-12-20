<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SejarahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sejarahs')->insert([
            [
                'judul' => 'SEJARAH PUI GEMAR',
                'foto_konten_sejarah' => null,
                'isi_sejarah' => '
Indonesia merupakan negara kepulauan yang diberkahi kekayaan alam yang sangat melimpah. Dengan 17.000 pulau yang berjajar di lintasan garis khatulistiwa, negeri ini menyimpan keragaman kekayaan yang tidak terhingga salah satunya adalah keragaman geologi. Proses tektonik masa lampau pada Indonesia menghasilkan fenomena fenomena geologi yang unik pada saat ini di berbagai daerah di Indonesia. Keragaman geologi yang dikandungnya membuat Indonesia dijuluki sebagai laboratorium geologi. Kendati demikian kekayaan alam tersebut masih belum dimanfaatkan secara optimal. Salah satunya terdapat di Kabupaten Merangin Provinsi Jambi yaitu Geoheritage Merangin. 
Geoheritage Merangin berdasarkan tiga komponen utama yaitu Geodiversity, Biodiversity, dan Cultural-nya membuat daerah ini layak menjadi pusat pengembangan riset secara akademik maupun pengembangan pariwisata minat khusus dengan memanfaatkan potensi yang telah ada menjadi Geowisata. Maka menarik untuk mengintegrasikan tiga komponen tesebut dalam satu kawasan menjadi pusat edukasi dan wisata. Karena prinsip dasar dari geowisata adalah 5 menyelaraskan pertumbuhan ekonomi berbasis konservasi dan proteksi lingkungan dengan kearifan budaya lokal. 
Fenomena keragaman Geologi yang ada di Batang Merangin mencakup fenomena geologi yang berumur sekitar 250 – 290 juta tahun (termasuk Zaman Perem Atas – Jura Awal). Fenomena geologi ini berupa fosil Flora–Fauna Jambi yang terekam pada batuan gunungapi bersisipan sedimen laut (batu gamping – serpih gampingan). 
Hasil penelitian paleomagnet menunjukkan Pulau Sumatera pada zaman Perem Atas – Jura awal (250 – 290 juta tahun lalu) berada pada 40⁰ di sebelah utara yang kemudian dari rekontruksi tektonik lempeng Sumatera pecah akibat benturan Benua India dengan Eurasia sehingga terseret dan berpindah dari Cathaysia melalui system patahan – patahan besar di Asia Timur dan Asia Tenggara. Lempengan inilah yang saling megunci pulau Sumatera dan menghasilkan keragaman geologi (Geodiversity) yang bernilai warisan geologi (Geoheritage). Sebagai mata rantai yang sangat penting antara provinsi paleoflora Cathaysian dan Euramerican yang ditunjukkan oleh elemen paleoflora yang dikandungnya. “Flora Jambi” merupakan salah satu inti penyebaran migrasi paleoflora ke seluruh dunia (Paleoflora Cina Utara lebih muda). Mintakat Sumatera bagian Barat dihuni oleh fauna air hangat dan “Flora Jambi” berhubungan dengan paleoflora Cathaysian, sedangkan Mintakat Sumatera bagian Timur dihuni oleh fauna air dingin dan batuannya sama dengan Australia Barat Laut. 
“Flora Jambi” mengandung komponen flora Cathaysian dan flora Euramerican (Chaloner dan Creber, 1988) dan akhir–akhir ini ada kemungkinan mengandung elemen–elemen Gondwana juga. Hasil penemuan–penemuan ini sangat penting untuk mengetahui evolusi benua–benua renik yang berasal dari Gondwana pada Zaman Paleozoikum Akhir dan Mesozoikum (IGCP 516 Project). Penelitian lebih terperinci tentang paleontology dan umur “Flora Jambi” ini dilakukan oleh Pusat Survei Geologi dan Geological Research Institute – Naturalis Leiden, The Netherlands. Hasil penelitian menunjukkan bahwa ada 3 kumpulan flora yaitu : 
    1. Flora lokal yang terdiri atas cordaites, pecopteris dan Calamites 
    2. Flora lokal dengan tambahan Macralethopteris 
    3. Kemungkinan mengandung Macralethopteris Sp II dengan campuran flora bersifat Cathaysian. 
Flora ini membedakan antara sekumpulan flora overbank dengan flora system sungai teranyam (dengan pecopterids) dan flora kumpulan gosong pasir dengan system sungai teranyam (dengan Cordaites dan Calamites besar). Hal tersebut sudah jelas dari segi lingkungan pengendapan terutama pada endapan yang mengandung fosil. Fosil – fosil yang telah dikumpulkan yang mengandung karbon organic yang asli diharapkan dapat dilakukan penelitian dengan teknik yang baru terhadap cuticle dan stomata di masa mendatang. 
Dengan demikian Fosil Flora Jambi tersebut memiliki nilai Geoheritage International dan perlu dilakukan konservasi untuk memberikan manfaat bagi banyak kalangan baik dari sisi akademisi maupun kepada masyarakat di sekitarnya. Universitas Jambi sebagai Pendidikan tinggi dengan sumberdaya yang mumpuni dapat berperan untuk mengembangkan potensi kawasan Geoheritage Merangin melalui pendirian Pusat Unggulan Iptek Geowisata Merangin. Sejauh ini belum ada lembaga pada perguruan tinggi yang fokus menangani bidang Geowisata. Hal ini terlihat sedikitnya riset – riset yang dihasilkan terkait bidang ini. PUI ini diharapkan sebagai pusat inovsi dan rujukan tata kelola serta model pengembangan ilmu pengetahuan lintas bidang ilmu yang berfungsi sebagai model implementasi program kampus merdeka dan merdeka belajar. PUI ini akan berdampak bagi ekonomi masyarakat dan menumbuhkan industri pedesaan berbasis agroindustri dan lingkungan. 
Sebagai wujud komitmen akademisi dan untuk memfasilitasi wadah koordinasi dan kolaborasi bagi para peneliti, maka Universitas Jambi bermaksud mendirikan dan mengembangkan Pusat Unggulan Iptek (PUI) GEOWISATA MERANGIN (GEMAR). Pendirian PUI ini untuk mewujudkan visi Universitas Jambi yaitu menjadi a word class entrepreneurship university berbasis agroindustri dan lingkungan.
                '
            ]
        ]);
    }
}
