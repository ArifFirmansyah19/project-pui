@extends('layouts.app-user')
@section('title', 'Visi Misi PUI GEMAR')

@section('content')
    <div class="flex flex-col md:flex-row w-full">
        <!-- Konten -->
        <div class="bg-white shadow-md rounded-lg p-4 md:w-2/3">
            @if (!$visiMisiExists)
                <div class="p-4">
                    <div class="max-w-full px-12">
                        <h1 class="text-4xl font-bold text-indigo-900 mb-15">Visi</h1>
                    </div>
                    <div class="max-w-full p-12">
                        <h1 class="text-4xl font-bold text-indigo-900 mb-15">Misi</h1>
                    </div>
                </div>
            @else
                <div class="p-6">
                    <div class="max-w-full bg-white shadow-md rounded-lg mb-5 p-4">
                        <h1 class="text-4xl font-bold text-indigo-900 p-2">Visi</h1>
                        <!-- Konten Visi -->
                        <p class="text-gray-800 mt-6 leading-relaxed px-4 py-2">
                            {!! $visionMission->vision !!}
                        </p>
                    </div>
                    <div class="max-w-full bg-white shadow-md rounded-lg p-4">
                        <h1 class="text-4xl font-bold text-indigo-900 mt-5 ">Misi</h1>
                        <!-- Konten Misi -->
                        <p class="text-gray-800 mt-6 leading-relaxed">
                            Adapun Misi dari PUI GEMAR UNJA adalah sebagai berikut:
                        </p>
                        <p class="text-gray-800 leading-relaxed px-4 py-2">
                            {!! $visionMission->missions !!}
                        </p>
                    </div>
                </div>
            @endif
        </div>
        @include('layouts.session-article')
    </div>
@endsection


{{-- 

<div class="flex pt-20">
    <!-- Konten  -->
    <div class="max-w-full p-12 bg-white shadow-md rounded-lg w-2/3">
        <div class="max-w-full bg-white shadow-md rounded-lg">
            <h1 class="text-4xl font-bold text-indigo-900 mb-15 mt-6 p-2">
                Visi
            </h1>
            <!--konten visi -->

            <p class="text-gray-800 mt-6 leading-relaxed px-4 py-2 text-justify">
                Pusat Unggulan Ipteks dalam bidang Penelitian dan Pembelajaran
                Geodiversity, Biodiversity, dan Cultural secara terintegrasi untuk
                menumbuhkan ekonomi kreatif yang berwawasan lingkungan pada kawasan
                Geowisata Geoheritage Merangin
            </p>
        </div>

        <div class="max-w-full bg-white shadow-md rounded-lg">
            <h1 class="text-4xl font-bold text-indigo-900 mb-15 mt-8 p-4">
                Misi
            </h1>
            <!--konten misi-->

            <p class="text-gray-800 mt-6 leading-relaxed">
                <li class="p-2 px-4 text-justify">
                    Penguatan tata kelola kelembagaanPUI GEMAR UNJA sebagai wadah
                    tumbuh kembang penelitian dan pembelajaran Geowisata yang berdaya
                    saing dengan fokus pada eksplorasi dan pemanfaatan potensi sumber
                    daya alam di kawasan Geoheritage Merangin
                </li>
                <li class="p-2 px-4 text-justify">
                    Memfasilitasi dan memotivasi tumbuh kembang produk-produk hasil
                    riset dan pepengembangan yang mampu meningkatkan reputasi peneliti
                    dan Universitas Jambi sebagai lembaga pendidikan tinggi
                </li>
                <li class="p-2 px-4 text-justify">
                    Mengembangkan dan merealisasikan pembelajaran Kampus Merdeka dan
                    Merdeka Belajar untuk menghasilkan lulusan Universitas Jambi yang
                    berjiwa excellent technosociopreneur
                </li>
                <li class="p-2 px-4 text-justify">
                    Memperkuat koordinasi dan konsolidasi antara program studi atau
                    bidang ilmu untuk pengembangan Geowisata Geoheritage Merangin yang
                    terintegrasi dan berkelanjutan dalam satu kawasan
                </li>
                <li class="p-2 px-4 text-justify">
                    Memperkuat jaringan kerjasama kelembagaan dan kemitraan dengan
                    lembaga penelitian dan pengembangan lainnya dari tingkat regional,
                    nasional dan internasional
                </li>
                <li class="p-2 px-4 text-justify">
                    Mengembangkan dan mendorong peningkatan taraf sosial dan
                    perekonomian daerah yang terkoneksi dan terintegrasi melalui Tri
                    Darma Perguruan Tinggi Universitas Jambi
                </li>
            </p>
        </div>
    </div>
</div> --}}
