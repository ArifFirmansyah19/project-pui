<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKeragamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_keragamans')->insert([
            [
                'jenis_keragaman' => 'Flora MJGp',
                'deskripsi_keragaman' => 'Flora MJGp (Flora Merangin Jambi Geopark) adalah sebuah program atau inisiatif yang bertujuan untuk mengidentifikasi, mendokumentasikan, dan melestarikan keanekaragaman hayati, terutama flora yang terdapat di kawasan Geopark Merangin di Provinsi Jambi, Indonesia. Flora MJGp tidak hanya berfokus pada pengidentifikasian dan dokumentasi tumbuhan, tetapi juga berupaya melestarikan ekosistem yang ada. Dalam menghadapi ancaman perubahan iklim dan kerusakan habitat, inisiatif ini berperan penting untuk memastikan bahwa generasi mendatang dapat menikmati keindahan dan manfaat yang ditawarkan oleh alam. Dengan melibatkan para ilmuwan dan peneliti, program ini berusaha untuk memahami lebih dalam tentang interaksi antara flora dan fauna, serta dampaknya terhadap lingkungan sekitar.
                Tidak kalah pentingnya, Flora MJGp mengedukasi masyarakat tentang nilai dan pentingnya pelestarian alam. Melalui program-program pelatihan dan kesadaran lingkungan, masyarakat lokal diajak untuk berpartisipasi aktif dalam menjaga dan memanfaatkan sumber daya alam dengan bijak. Dengan pengetahuan dan keterampilan yang diperoleh, mereka dapat berperan sebagai penjaga hutan yang bertanggung jawab.
                Selain itu, Flora MJGp membuka peluang untuk pengembangan wisata berkelanjutan. Dengan keindahan alam yang memukau dan keanekaragaman tumbuhan yang kaya, kawasan ini menjadi magnet bagi para wisatawan yang ingin merasakan ketenangan dan keindahan alam. Melalui pariwisata yang bertanggung jawab, kita dapat menjaga kelestarian alam sekaligus meningkatkan kesejahteraan masyarakat lokal.'
            ],
            [
                'jenis_keragaman' => 'Stratigraphy (Bebatuan)',
                'deskripsi_keragaman' => 'Stratigraphy adalah cabang dari geologi yang mempelajari lapisan-lapisan batuan (strata) dan sejarah pembentukannya. Ilmu ini digunakan untuk memahami urutan, komposisi, umur, dan hubungan antar lapisan batuan yang tersimpan di kerak bumi. Melalui stratigrafi, para ilmuwan dapat mengidentifikasi perubahan geologis, iklim, dan lingkungan masa lalu, serta peristiwa penting seperti aktivitas vulkanik, sedimentasi, dan erosi.Ada beberapa aspek penting dalam stratigrafi:
                    Stratigrafi Litologi – Mempelajari susunan fisik lapisan batuan, termasuk tekstur, warna, dan jenis mineral yang menyusunnya.
                    Stratigrafi Biostratigrafi – Berdasarkan fosil yang ditemukan dalam lapisan batuan, membantu menentukan umur relatif lapisan tersebut.
                    Stratigrafi Kronostratigrafi – Fokus pada penentuan usia lapisan batuan berdasarkan waktu, dengan menggunakan metode penanggalan absolut, seperti radiometrik.
                    Stratigrafi sangat penting dalam bidang geologi, arkeologi, dan eksplorasi minyak bumi, karena membantu dalam penentuan lokasi sumber daya alam dan penelusuran sejarah geologis bumi.'
            ],
            [
                'jenis_keragaman' => 'Fosil MJGp',
                'deskripsi_keragaman' => 'Fosil MJGp atau fosil dari Geopark Merangin, Jambi, adalah fosil flora yang sangat langka dan berumur sekitar 300 juta tahun, berasal dari periode Permian awal (Paleozoikum). Fosil ini ditemukan di Sungai Merangin dan menjadi salah satu fosil flora tertua serta terlengkap di dunia. Area ini dikenal dengan keberadaan fosil pohon dan laut dari zaman prasejarah, yang membuatnya unik karena fosil tersebut hanya ditemukan di sana dan tidak ada di tempat lain di dunia.
                Geopark Merangin juga telah ditetapkan sebagai UNESCO Global Geopark pada tahun 2023, menunjukkan pentingnya kawasan ini dari segi warisan geologi dan sejarah bumi'
            ],
            [
                'jenis_keragaman' => 'Fauna MJGp',
                'deskripsi_keragaman' => 'Fauna MJGp (Fauna Merangin Jambi Geopark) merujuk pada keanekaragaman hayati hewan yang terdapat di kawasan Geopark Merangin, Provinsi Jambi, Indonesia. Fauna MJGp mencakup berbagai spesies hewan, mulai dari mamalia, burung, reptil, hingga serangga. Kawasan ini adalah habitat bagi banyak spesies yang terancam punah dan endemic yang tidak dapat ditemukan di tempat lain. Di Geopark Merangin, terdapat sejumlah spesies hewan yang endemik, artinya mereka hanya dapat ditemukan di daerah tersebut. Ini termasuk berbagai jenis burung, mamalia kecil, dan reptil yang memiliki peran penting dalam ekosistem lokal. Fauna MJGp menjadi fokus penelitian bagi ilmuwan dan konservasionis yang berusaha memahami lebih dalam tentang interaksi antara spesies, serta ancaman yang mereka hadapi, seperti perburuan liar dan kerusakan habitat. Upaya konservasi di kawasan ini bertujuan untuk melindungi spesies yang terancam punah dan habitat alami mereka. Dengan keanekaragaman hayati yang kaya, Fauna MJGp menawarkan potensi wisata alam yang menarik. Pengunjung dapat melakukan aktivitas seperti birdwatching, trekking, dan pengamatan satwa liar, yang tidak hanya memberikan pengalaman mendekatkan diri dengan alam, tetapi juga meningkatkan kesadaran akan pentingnya pelestarian lingkungan'
            ],
            [
                'jenis_keragaman' => 'Situs Geologi',
                'deskripsi_keragaman' => 'MJGp memiliki lanskap geologi yang menarik, termasuk gunung, kawah, air terjun, danau, serta fenomena geotermal seperti sumber air panas. Gunung Masurai di kawasan ini terbentuk akibat aktivitas vulkanik yang menciptakan keanekaragaman bentang alam yang kaya. Kawasan ini juga dihuni oleh flora dan fauna langka yang dilindungi, serta memiliki nilai budaya dan peradaban masa lalu yang penting.
                MJGp dikelola dengan tiga pilar utama: konservasi, edukasi, dan pengembangan ekonomi lokal. Desa-desa wisata di sekitar kawasan ini juga turut berperan dalam menjaga kelestarian dan mempromosikan pariwisata berbasis geopark'
            ],
            [
                'jenis_keragaman' => 'Kultur MJGp',
                'deskripsi_keragaman' => 'Kultur MJGp di Merangin mengacu pada kekayaan geologis dan budaya yang terdapat di wilayah Geopark Merangin Jambi. Geopark ini diakui secara internasional, terutama karena adanya fosil tumbuhan purba dari zaman Permian, sekitar 300 juta tahun yang lalu, yang ditemukan di kawasan ini. Fosil-fosil tersebut merupakan salah satu koleksi flora purba terlengkap di dunia. Selain itu, wilayah ini juga memiliki bentang alam karst yang terbentuk pada era Mesozoikum serta habitat flora dan fauna yang langka. Geopark ini juga mempromosikan ekowisata dan pelestarian budaya lokal dengan melibatkan masyarakat dalam berbagai kegiatan konservasi dan pendidikan, sekaligus menjaga situs geologi penting yang ada​
'
            ],
        ]);
    }
}
