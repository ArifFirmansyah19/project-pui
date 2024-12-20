<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KegiatanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kegiatans')->insert([
            [
                'nama_kegiatan' => 'Pelatihan Membatik Desa Air Batu',
                'foto_kegiatan' => 'fotoKegiatan/yL5sTbDSoAM0DWJuFedOFTbZGrNT0s8OowJoZ8r9.png',
                'deskripsi_kegiatan' => 'Pusat Unggulan Iptek (PUI) GEMAR Universitas Jambi baru-baru ini mengikuti kegiatan belajar membatik di Desa Air Batu, salah satu desa yang terletak di wilayah Geopark Merangin. Kegiatan ini merupakan bagian dari program pemberdayaan masyarakat dan pelestarian budaya lokal yang diinisiasi oleh PUI GEMAR UNJA dalam upaya meningkatkan kolaborasi antara dunia akademik dan masyarakat setempat. <br>
                Dalam kegiatan ini, anggota PUI GEMAR UNJA belajar langsung dari para pengrajin batik di Desa Air Batu, yang terkenal dengan motif-motif batiknya yang sarat akan nilai budaya dan filosofi lokal. Para peserta mendapatkan kesempatan untuk memahami proses pembuatan batik mulai dari tahap awal hingga finishing, seperti pembuatan pola, pencelupan warna, hingga teknik pewarnaan alami yang digunakan oleh pengrajin desa. <br>
                Melalui kegiatan ini, PUI GEMAR UNJA tidak hanya berupaya untuk melestarikan warisan budaya lokal, tetapi juga ingin membangun koneksi yang lebih kuat dengan masyarakat sekitar, khususnya dalam aspek peningkatan ekonomi kreatif berbasis budaya. Diharapkan, hasil dari program ini dapat membantu Desa Air Batu semakin dikenal sebagai pusat batik tradisional, sekaligus mendukung keberlanjutan budaya membatik bagi generasi mendatang.<br>
                Kegiatan ini juga menjadi momentum bagi PUI GEMAR UNJA untuk memperkenalkan inovasi akademik dalam sektor ekonomi kreatif, dengan harapan dapat memberikan dampak positif bagi masyarakat dan mengangkat potensi lokal yang ada di sekitar Geopark Merangin.'
            ],
            [
                'nama_kegiatan' => 'Video Kegiatan Presentasi Project',
                'foto_kegiatan' => 'fotoKegiatan/W6GB2lnz84KyI1lH1P8HSFzjQTWCkmXPaE3c0ItZ.mp4',
                'deskripsi_kegiatan' => '
                Program Pembentukan Daerah Geowisata Merangin bertujuan untuk mengembangkan potensi geowisata yang unik dan bernilai tinggi di Kabupaten Merangin, Provinsi Jambi. Dengan keunggulan geologis seperti fosil flora tertua di dunia dan bentang alam yang memukau, program ini dirancang untuk memadukan pelestarian lingkungan dengan pengembangan ekonomi lokal. Melalui kolaborasi pemerintah daerah, akademisi, dan masyarakat setempat, program ini berfokus pada pengembangan infrastruktur wisata, pelatihan pemandu lokal, dan promosi kawasan sebagai destinasi geowisata berkelas internasional. Upaya ini diharapkan dapat meningkatkan kunjungan wisatawan serta membuka lapangan kerja baru di sektor pariwisata dan konservasi.
                <br>
                Selain itu, program ini juga menitikberatkan pada pendidikan dan kesadaran lingkungan. Dengan pendekatan berbasis komunitas, masyarakat lokal diajak untuk berperan aktif dalam menjaga warisan geologi Merangin sekaligus memanfaatkan peluang ekonomi dari geowisata. Aktivitas seperti trekking, eksplorasi gua, dan wisata edukasi difasilitasi dengan tetap mengedepankan prinsip keberlanjutan. Keberhasilan program ini diharapkan tidak hanya memberikan dampak positif bagi perekonomian lokal, tetapi juga memperkuat identitas Kabupaten Merangin sebagai pusat geowisata yang membanggakan di tingkat nasional maupun global.'
            ],
            [
                'nama_kegiatan' => 'Arung Jeram',
                'foto_kegiatan' => 'fotoKegiatan/fLdBqKazguWw861rh56HjaMyIspG20TLzDkeZLrM.jpg',
                'deskripsi_kegiatan' => '
                Tim PUI (Pusat Unggulan Iptek) melaksanakan kegiatan arung jeram di kawasan Geowisata Merangin sebagai bagian dari eksplorasi dan rekreasi alam. Dengan mengarungi Sungai Batang Merangin yang dikelilingi oleh keindahan alam tropis dan formasi geologi purba, kegiatan ini tidak hanya memberikan pengalaman seru dan menantang, tetapi juga meningkatkan kesadaran akan pentingnya pelestarian lingkungan. Dalam suasana penuh semangat kebersamaan, anggota tim menikmati aliran jeram yang deras sambil menikmati pemandangan spektakuler, seperti dinding batu fosil berusia jutaan tahun. Kegiatan ini menjadi momen berharga untuk memperkuat kolaborasi antaranggota tim serta mengenal lebih dekat kekayaan alam Kabupaten Merangin.
                '
            ],
            [
                'nama_kegiatan' => 'Diskusi Pengembangan Objek Wisata',
                'foto_kegiatan' => 'fotoKegiatan/iDaJ4xZEoZ7qEAgJAXvMrErHCurYc96SG3hyEdWk.png',
                'deskripsi_kegiatan' => '
                    Diskusi bersama pemuka adat dan kelompok masyarakat lokal di kawasan Geoheritage Merangin guna menentukan objek pengembangan geowisata di Pemda Kabupaten Merangin.
                '
            ],
            [
                'nama_kegiatan' => 'Pendampingan Guide Lokal',
                'foto_kegiatan' => 'fotoKegiatan/psvDsdUxQvvpIAU9GNSSDpdkoDTNDFsH24toZyth.png',
                'deskripsi_kegiatan' => 'Pendampingan dan pelatihan masyarakat lokal guna menjadi guider (pemandu wisata) di Desa Bedeng Rejo untuk meningkatkan skill dan pengetahuan terhadap objek geowisata di daerah mereka. 
                '
            ],
            [
                'nama_kegiatan' => 'Pembuatan Peta Geowisata Merangin',
                'foto_kegiatan' => 'fotoKegiatan/EVY6eCiACBXQmkwcTZPWjTyMG4om3oDCLogcfnub.png',
                'deskripsi_kegiatan' => 'Pembuatan Peta objek potensi Geowisata yang ada di Geoheritage Merangin guna pengembangan dan pemberdayaan masyarakat lokal. '
            ],
            [
                'nama_kegiatan' => 'Pembersihan Lingkungan Sungai',
                'foto_kegiatan' => 'fotoKegiatan/sJVmzy6Pz7mrhKnZabPFLGhllJ0kUdgofykYcDa4.jpg',
                'deskripsi_kegiatan' => '
                Kegiatan pembersihan lingkungan sungai di Geowisata Merangin dilakukan sebagai upaya nyata untuk menjaga kelestarian ekosistem dan meningkatkan daya tarik wisata alam di kawasan tersebut. Tim yang terdiri dari masyarakat setempat, pelaku wisata, dan relawan dengan antusias mengumpulkan sampah di sepanjang aliran sungai, memastikan sungai tetap bersih dan bebas dari limbah. Selain membersihkan area sungai, kegiatan ini juga menjadi momen edukasi bagi masyarakat tentang pentingnya menjaga kebersihan lingkungan untuk mendukung keberlanjutan Geowisata Merangin sebagai destinasi wisata unggulan. Dengan suasana kerja sama yang harmonis, kegiatan ini tidak hanya memperbaiki kualitas lingkungan, tetapi juga memperkuat kesadaran kolektif akan tanggung jawab bersama terhadap kelestarian alam.
                '
            ],
            [
                'nama_kegiatan' => 'Pembuatan Buku GeoTracking',
                'foto_kegiatan' => 'fotoKegiatan/ybEh0Qw4roi3uSKPbVPfqRzGAXu2YiNWi7TMXiG6.png',
                'deskripsi_kegiatan' => 'Buku panduan Geotracking yang merupakan hasil pengabdian Prodi Teknik Geologi, Universitas Jambi untuk Museum Geoheritage Merangin guna membuka jalur potensi pariwisata. '
            ],

            [
                'nama_kegiatan' => 'Kunjungan Sekolah di Geowisata Merangin',
                'foto_kegiatan' => 'fotoKegiatan/AUTTWxVO1C18Vfkji16pZuDa909AtxJM5keisUmh.png',
                'deskripsi_kegiatan' => 'Kunjungan ke Sekolah Dasar yang berada di kawasan Geoheritage Merangin mengenalkan potensi wisata bebasis edukasi yang dapat diterapkan dalam pelajaran di Pendidikan dasar '
            ],
            [
                'nama_kegiatan' => 'Pembuatan Peta Tracking Darat Geowisata Merangin',
                'foto_kegiatan' => 'fotoKegiatan/UbaUIk6YXsmrtZsuWkhikAQZdsuDzW7vzZ9HJtyp.png',
                'deskripsi_kegiatan' => 'Pembuatan Peta Tracking jalur darat Geosite Geopark Mengkarang Purba yang merupakan bagian dari kawasan Geoheritage Merangin sebagai panduan wisatawan yang berkunjung.'
            ],
        ]);
    }
}
