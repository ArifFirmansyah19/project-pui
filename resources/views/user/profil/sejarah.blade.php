@extends('layouts.app-user')
@section('title', 'Sejarah PUI GEMAR')

@section('content')
    <div class="flex flex-col md:flex-row w-full">
        <div class="bg-white shadow-md mt-5 rounded-lg p-4 md:w-2/3 ">

            <div class="max-w-full p-12  mt-10">
                <h1 class="text-4xl font-bold text-indigo-900 mt-3 mb-15">Sejarah PUI GEMAR UNJA</h1>
                <!--konten sejarah-->
                <p class="text-gray-800 mt-6 leading-relaxed text-justify">
                    {{-- {{ implode("\n", array_slice(explode("\n", wordwrap(strip_tags($sejarah->isi_sejarah), 150, "\n")), 0, 5)) }} --}}
                    {!! $sejarah->isi_sejarah !!}
                </p>


                {{-- 
                <p class="text-gray-800 mt-6 leading-relaxed text-justify">
                    Penggunaan teknologi informasi menjadi salah satu aspek yang sangat penting dalam kehidupan manusia.
                    Terlebih saat ini, hampir semua aktivitas manusia tak luput dari peranan teknologi informasi. Dalam
                    dunia pendidikan, teknologi informasi berperan penting dalam mempermudah proses pembelajaran,
                    meningkatkan keterampilan digital, dan memenuhi kebutuhan pendidikan. Perkembangan
                    teknologi informasi juga telah mendorong penguatan lembaga riset dan penelitian untuk menghasilkan
                    inovasi baru dalam bentuk teknologi dan ilmu pengetahuan yang berguna bagi kehidupan manusia. Sebagai
                    perwujudannya di berbagai tempat dan negara, suatu lembaga penelitian dan pengembangan (litbang) ataupun
                    perguruan tinggi telah merintis pusat unggulan ilmu pengetahuan dan teknologi (iptek) yang dinamai
                    dengan Pusat Unggulan Iptek (PUI)
                </p>

                <p class="text-gray-800 mt-4 leading-relaxed text-justify">
                    Pusat Ungggulan Ilmu Pengetahuan dan Teknologi (PUI), merupakan suatu kelompok kerja dari peneliti dalam
                    satu bidang yang sama dan saling mendukung percepatan pengembangan dalam bidang tersebut. Tujuan dari
                    PUI adalah untuk meningkatkan kapasitas, kemampuan dan kesinambungan lembaga dalam penelitian,
                    pengembangan dan penerapan sumber daya iptek, meningkatkan relevansi dan produktivitas serta pemanfaatan
                    iptek di sektor tertentu sehingga menumbuhkan ekonomi nasional yang berdampak pada peningkatan
                    kesejahteraan masyarakat. Hasil akhir yang hendak dicapai berupa ilmu
                    pengetahuan, karya inovasi dan publikasi ilmiah. Adapun lembaga PUI dalam ruang lingkup perguruan
                    tinggi, disebut sebagai PUI-PT (Pusat Unggulan Iptek Perguruan Tinggi). Dikutip dari (Dr. Drs. Jodion
                    Siburian, 2021), saat ini Universitas Jambi telah memiliki 12 PUI UNJA yang bergerak di berbagai bidang
                    penelitian. PUI tersebut diantaranya adalah PUI-PT SEHAD (Scientific Environment Health and Diseases),
                    PUI BLaSTS (Biodiversitas Land use Transformation Systems), PUI eMedical UNJA (Etno Medisin dan
                    Neutrasetikal UNJA), PUI GEMAR (Geowisata Merangin), dan lain sebagainya.
                </p>
                <p class="text-gray-800 mt-4 leading-relaxed text-justify">
                    PUI GEMAR (PUI Geowisata Merangin) merupakan PUI UNJA yang didirikan pada 13 Mei 2020 berdasarkan SK
                    Rektor Universitas Jambi yang memiliki lingkup di bidang penelitian dan pembelajaran pada kawasan
                    Geowisata Merangin Jambi. Geowisata Merangin merupakan situs Geopark Merangin yang resmi didirikan pada
                    tahun 2012 dengan konsep manajemen pengelolaan kawasan yang menyerasikan keragaman geologi, hayati dan
                    budaya, melalui prinsip konservasi, edukasi dan pembangunan berkelanjutan di kawasan terintegrasi
                    Kabupaten Merangin. Geopark Merangin telah ditetapkan oleh pemerintah menjadi Geopark Nasional pada 1
                    Maret 2013 dan dikukuhkan melalui sidang UNESCO pada Rabu, 24 Mei 2023 di Paris dengan status Geopark
                    Global UNESCO
                </p>
                <p class="text-gray-800 mt-4 leading-relaxed text-justify">
                    PUI-GEMAR UNJA merupakan salah satu PUI yang ada di Universitas
                    Jambi. PUI GEMAR didirikan pada tanggal 13 Mei 2020 berdasarkan SK Rektor
                    Universitas Jambi yang memiliki lingkup di bidang penelitian dan
                    pembelajaran pada kawasan Geowisata Merangin Jambi.
                    Geowisata Merangin merupakan situs Geopark Merangin yang resmi didirikan pada
                    tahun 2012 dengan konsep manajemen pengelolaan kawasan yang menyerasikan keragaman geologi, hayati dan
                    budaya, melalui prinsip konservasi, edukasi dan pembangunan berkelanjutan di kawasan terintegrasi
                    Kabupaten Merangin. Geopark Merangin telah ditetapkan oleh pemerintah menjadi Geopark Nasional pada 1
                    Maret 2013 dan dikukuhkan melalui sidang UNESCO pada Rabu, 24 Mei 2023 di Paris dengan status Geopark
                    Global UNESCO (UGGp) sekaligus menjadi Geopark Global
                    UNESCO yang pertama di provinsi Jambi. Geopark Merangin memiliki potensi alam berupa keragaman
                    geologi yang tersebar di sepanjang Sungai Merangin. Fosil flora dan fauna di
                    kawasan ini diperkirakan berumur sekitar 250-290 juta tahun lalu yang
                    terdapat pada batuan gunung api bersisipan sedimen laut berupa batu
                    gamping dan serpih gamping. Kawasan Geopark Merangin tersebar di sepanjang aliran Sungai Batang
                    Merangin dan Sungai
                    Mengkarang. Secara geologi, Sungai Mengkarang tersusun dari batuan dari
                    Formasi Mengkarang (Pm), ranit Tantan (TJRgr), dan Formasi Kasai (QTK). Geopark memiliki peranan
                    penting untuk membuka peluang
                    penelitian, pendidikan serta pengembangan ekonomi masyarakat setempat.
                    Geopark dapat dikembangkan menjadi objek daya tarik wisata (geotourism),
                    kegiatan perdagangan barang kerajinan (geoproducts) dan makanan khas
                    daerah atau UMKM.
                </p> --}}
            </div>
        </div>
        @include('layouts.session-article')
    </div>
@endsection
