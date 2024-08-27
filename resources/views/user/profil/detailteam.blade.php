@extends('layouts.app-user')
@section('title', 'Detail TIM PUI GEMAR')

@section('content')
    <div class="flex flex-col md:flex-row w-full">
        <div class="bg-white mt-5 rounded-lg p-4 md:w-2/3">
            <!--konten profil-->
            <div class="max-w-full p-12 ">
                <h1 class="text-4xl font-bold text-indigo-900 mb-10 mt-24">Profil</h1>
                <!-- Judul "Profil" di atas -->

                <!-- Container gambar  dan penjelasan -->
                <div class="flex items-center">
                    <!-- Gambar  -->
                    <div class="flex-shrink-0">
                        <!-- Memeriksa apakah ada gambar tim -->
                        @if ($tim->foto)
                            <!-- Jika ada gambar, tampilkan gambar -->
                            <img src="{{ asset('storage/' . $tim->foto) }}" alt="Foto Anggota {{ $tim->nama }}"
                                class="w-64 h-64 rounded-full mr-8 border-4 border-indigo-600 shadow-lg" />
                        @else
                            <!-- Jika tidak ada gambar, isi foto Default -->
                            <img src="{{ asset('img/fotoKosong.png') }}" alt="Foto Anggota {{ $tim->nama }}"
                                class="w-64 h-64 rounded-full mr-8 border-4 border-indigo-600 shadow-lg" />
                        @endif
                    </div>

                    <!-- Teks penjelasan -->
                    <div class="text-gray-800 leading-relaxed mx-8 mt-6">
                        <p class="mb-1">
                            <span class="font-bold">Nama: </span> {{ $tim->nama }}
                        </p>
                        <p class="mb-1">
                            <span class="font-bold">Divisi: </span> {{ $tim->divisi->nama_divisi }}
                        </p>
                        <p class="mb-1">
                            <span class="font-bold">Jabatan: </span> {{ $tim->jabatan->nama_jabatan }}
                        </p>
                        <p class="mb-1">
                            <span class="font-bold">Bidang Keahliam: </span> {{ $tim->bidang_keahlian }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.session-article')
    </div>


@endsection
