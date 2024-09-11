@extends('layouts.app-admin')
@section('title', 'halaman Visi Misi admin')
@section('content-admin')

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6">
        @if (!$visiMisiExists)
            <div class="flex justify-start">
                <button
                    class="fixed bottom-1 right-3 border-4 border-green-500 rounded-full w-14 h-14 bg-white items-center justify-center shadow-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
                    aria-label="Tambah Visi Misi">
                    <a href="{{ route('admin.create-visimisi') }}">
                        <i class="fa-solid fa-plus" style="color: #19be71;"></i>
                    </a>
                </button>
            </div>
        @endif

        <div id="content" class="transition-transform duration-500 ease-in-out">
            @if (!$visiMisiExists)
                <div class="flex justify-center items-center ">
                    <a href="#"
                        class=" text-center block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Mohon Maaf Admin
                        </h5>
                        <br>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Saat ini kamu tidak memiliki data Visi Misi.
                            Mulailah untuk menambahkan visi misi baru untuk memuat data. Tombol buat visi misi tersedia di
                            pojok
                            kanan bawah
                        </p>
                        <br>
                    </a>
                </div>
        </div>
    @else
        <h1 class="text-3xl sm:text-4xl font-bold text-indigo-900 mb-6 mt-4 sm:mt-8">
            Visi
        </h1>

        <!--konten visi -->
        <p class="text-gray-800 mt-6 leading-relaxed">
            {!! $visionMission->vision !!}
        </p>

        <h1 class="mt-12 sm:mt-24 text-3xl sm:text-4xl font-bold text-indigo-900 mb-6">
            Misi
        </h1>
        <!--konten misi-->
        <ul class="text-gray-800 mt-4 sm:mt-6 leading-relaxed list-disc list-inside text-sm sm:text-base text-justify">
            Adapun Misi dari PUI GEMAR UNJA adalah sebagai berikut:
            @php
                $no = 1;
            @endphp
            @foreach ($visionMission->missions as $mission)
                <p>
                    {{ $no++ }}. {{ $mission }}
                </p>
            @endforeach
        </ul>

        {{-- 1. Penguatan tata kelola kelembagaan PUI GEMAR UNJA sebagai wadah tumbuh kembang penelitian dan pembelajaran Geowisata yang berdaya saing dengan fokus pada eksplorasi dan pemanfaatan potensi sumber daya alam di kawasan Geoheritage Merangin
2. Memfasilitasi dan memotivasi tumbuh kembang produk-produk hasil riset dan pengembangan yang mampu meningkatkan reputasi peneliti dan Universitas Jambi sebagai lembaga pendidikan tinggi
3. Mengembangkan dan merealisasikan pembelajaran Kampus Merdeka dan Merdeka Belajar untuk menghasilkan lulusan Universitas Jambi yang berjiwa excellent technosociopreneur
4. Memperkuat koordinasi dan konsolidasi antara program studi atau bidang ilmu untuk pengembangan Geowisata Geoheritage Merangin yang terintegrasi dan berkelanjutan dalam satu kawasan
5. Memperkuat jaringan kerjasama kelembagaan dan kemitraan dengan lembaga penelitian dan pengembangan lainnya dari tingkat regional, nasional dan internasional                
6. Mengembangkan dan mendorong peningkatan taraf sosial dan perekonomian daerah yang terkoneksi dan terintegrasi melalui Tri Darma Perguruan Tinggi Universitas Jambi --}}

        <button
            class="fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
            aria-label="Edit Visi Misi">
            <a href="{{ route('admin.edit-visimisi', $visionMission->id) }}">
                <i class="fas fa-edit" style="color: #ffffff;"></i>
            </a>
            </i>
        </button>
        </div>
        @endif
    </main>
    </div>
    </div>

@endsection
