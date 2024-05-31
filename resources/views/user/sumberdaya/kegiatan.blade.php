@extends('layouts.app-user');
@section('title', 'Kegiatan PUI GEMAR')

@section('content')
    <div class="flex">
      <div class="max-w-full p-12 bg-white shadow-md rounded-lg w-2/3">
        <h1 class="text-4xl font-bold text-indigo-900 mt-24 mb-15">Kegiatan</h1>

        <!-- Kegiatan 1 -->
        <a href="detail_kegiatan_1.html">
          <div
            class="mb-8 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105"
          >
            <h2 class="text-lg font-semibold text-indigo-900 mb-2 mt-20">
              Nama Kegiatan 1
            </h2>
            <p class="text-sm text-gray-500 mb-2">01 Januari 2024</p>
            <img
              src="../img/dok1.jpg"
              alt="Gambar Kegiatan 1"
              class="mb-2 rounded-lg h-96 w-full object-cover"
            />
            <p class="text-gray-800 leading-relaxed">
              Deskripsi singkat tentang kegiatan ini.
            </p>
          </div>
        </a>

        <!-- Kegiatan 2 -->
        <a href="detail_kegiatan_2.html">
          <div
            class="mb-8 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105"
          >
            <h2 class="text-lg font-semibold text-indigo-900 mb-2">
              Nama Kegiatan 2
            </h2>
            <p class="text-sm text-gray-500 mb-2">02 Februari 2024</p>
            <img
              src="../img/dok2.jpg"
              alt="Gambar Kegiatan 2"
              class="mb-2 rounded-lg h-96 w-full object-cover"
            />
            <p class="text-gray-800 leading-relaxed">
              Deskripsi singkat tentang kegiatan ini.
            </p>
          </div>
        </a>

        <!-- Kegiatan 3 -->
        <a href="detail_kegiatan_3.html">
          <div
            class="mb-8 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105"
          >
            <h2 class="text-lg font-semibold text-indigo-900 mb-2">
              Nama Kegiatan 3
            </h2>
            <p class="text-sm text-gray-500 mb-2">03 Maret 2024</p>
            <img
              src="../img/dok3.jpg"
              alt="Gambar Kegiatan 3"
              class="mb-2 rounded-lg h-96 w-full object-cover"
            />
            <p class="text-gray-800 leading-relaxed">
              Deskripsi singkat tentang kegiatan ini.
            </p>
          </div>
        </a>
      </div>

      @include('layouts.session-article')
    </div>

@endsection