@extends('layouts.app-user');
@section('title', 'Detail TIM PUI GEMAR')

@section('content')

    <div class="flex">
      <!--konten profil-->
      <div class="max-w-full p-12 bg-white shadow-md rounded-lg w-2/3">
        <h1 class="text-4xl font-bold text-indigo-900 mb-10 mt-24">Profil</h1>
        <!-- Judul "Profil" di atas -->

        <!-- Container gambar  dan penjelasan -->
        <div class="flex items-center">
          <!-- Gambar  -->
          <img
            src="../img/pas1.jpg"
            alt="Foto Dosen"
            class="w-64 h-64 rounded-full mr-8 border-4 border-indigo-600 shadow-lg"
          />

          <!-- Teks penjelasan -->
          <div class="text-gray-800 leading-relaxed mx-8 mt-6">
            <p class="mb-1">
              <span class="font-bold">Nama:</span> [Nama Dosen]
            </p>
            <p class="mb-1"><span class="font-bold">NIP:</span> [NIP]</p>
            <p class="mb-1">
              <span class="font-bold">Keanggotaan:</span> [Keanggotaan]
            </p>
            <p class="mb-1">
              <span class="font-bold">Riwayat Pendidikan:</span> [Riwayat
              Pendidikan Dosen]
            </p>
            <p class="mb-1">
              <span class="font-bold">Pengalaman Kerja:</span> [Pengalaman Kerja
              Dosen]
            </p>
            <p class="mb-1">
              <span class="font-bold">Bidang Keahlian:</span> [Bidang Keahlian]
            </p>
          </div>
        </div>
      </div>

      <!--artikel-->
      <div class="max-w-full p-8 bg-gray-600 w-1/3">
        <h2 class="text-3xl font-semibold text-white mb-5 mt-24">Article</h2>

        <!-- Artikel 1 -->
        <div class="mb-4">
          <h3 class="text-lg font-semibold text-white mb-0">Judul Artikel 1</h3>
          <p class="text-sm text-gray-300 mb-2">01 April 2024</p>
          <p class="text-sm text-white">
            Penjelasan singkat tentang artikel ini.
          </p>
          <a
            href="#"
            class="block text-blue-500 font-semibold mt-2 hover:text-blue-300 transition duration-300"
            >Baca Selengkapnya</a
          >
        </div>
        <hr class="border-gray-800 my-1" />

        <!-- Artikel 2 -->
        <div class="mb-4">
          <h3 class="text-lg font-semibold text-white mb-0">Judul Artikel 2</h3>
          <p class="text-sm text-gray-300 mb-2">01 April 2024</p>
          <p class="text-sm text-white">
            Penjelasan singkat tentang artikel ini.
          </p>
          <a
            href="#"
            class="block text-blue-500 font-semibold mt-2 hover:text-blue-300 transition duration-300"
            >Baca Selengkapnya</a
          >
        </div>
        <hr class="border-gray-800 my-1" />

        <!-- Artikel 3 -->
        <div class="mb-4">
          <h3 class="text-lg font-semibold text-white mb-0">Judul Artikel 3</h3>
          <p class="text-sm text-gray-300 mb-2">01 April 2024</p>
          <p class="text-sm text-white">
            Penjelasan singkat tentang artikel ini.
          </p>
          <a
            href="#"
            class="block text-blue-500 font-semibold mt-2 hover:text-blue-300 transition duration-300"
            >Baca Selengkapnya</a
          >
        </div>
        <hr class="border-gray-800 my-1" />
      </div>
    </div>

@endsection
