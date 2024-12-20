@extends('layouts.app-admin')
@section('title', 'halaman detail tim admin')
@section('content-admin')


    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div class="max-w-full px-4 sm:px-12 py-4 bg-white shadow-md rounded-lg">
            <h1 class="text-3xl sm:text-4xl font-bold text-indigo-900 mb-6 sm:mb-10 mt-2">
                Profil
            </h1>
            <!-- Content Wrapper -->
            <div class="flex flex-col md:flex-row bg-gray-300 p-4 rounded-lg">
                <!-- Container Gambar (Kolom 1) -->
                <div class="w-full md:w-1/3 flex justify-center md:justify-start mb-4 md:mb-0">
                    <img src="{{ asset('storage/' . $tim->foto) }}" alt="Foto Anggota Team"
                        class="w-64 h-64 rounded-full border-4 border-indigo-600 shadow-lg" />
                </div>

                <!-- Konten Teks (Kolom 2) -->
                <div class="w-full md:w-1/3 text-gray-800 leading-relaxed p-4 sm:p-6 bg-gray-100 shadow-lg rounded-lg">
                    <p class="mb-2">
                        <span class="font-bold">Nama:</span> {{ $tim->nama }}
                    </p>
                    <p class="mb-2">
                        <span class="font-bold">Keanggotaan:</span> {{ $tim->jabatan }}
                    </p>
                    <p class="mb-2">
                        <span class="font-bold">Divisi:</span> {{ $tim->divisi->nama_divisi }}
                    </p>
                    <p class="mb-2">
                        <span class="font-bold">Bidang Keahlian:</span> {{ $tim->bidang_keahlian }}
                    </p>
                </div>

                <!-- Kolom 3 Kosong -->
                <div class="w-1/3"></div>
            </div>



        </div>

        <!-- Floating Action Button -->
        <a href="{{ route('admin.edit-tim', $tim->id) }}">
            <button
                class="fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-300 focus:ring-opacity-50 mr-4"
                aria-label="Edit Tim">
                <i class="fa-regular fa-pen-to-square"></i>
            </button>
        </a>
    </main>




    {{-- <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div class="max-w-full px-4 sm:px-12 py-4 bg-white shadow-md rounded-lg">
            <h1 class="text-3xl sm:text-4xl font-bold text-indigo-900 mb-6 sm:mb-10 mt-2">
                Profil
            </h1>

            <!-- Container gambar dan penjelasan -->
            <div class="flex flex-col md:flex-row items-center bg-gray-300 p-4 rounded-lg">
                <!-- Gambar -->
                <img src="{{ asset('storage/' . $tim->foto) }}" alt="Foto Anggota Team"
                    class="w-32 h-32 sm:w-48 sm:h-48 md:w-64 md:h-64 rounded-full mr-4 border-4 border-indigo-600 shadow-lg" />

                <!-- Teks penjelasan -->
                <div
                    class="flex-1 max-w-xl text-gray-800 leading-relaxed p-4 sm:p-6 bg-gray-100 shadow-lg rounded-lg mr-0 md:mr-4 mt-4 md:mt-0">
                    <p class="mb-2">
                        <span class="font-bold">Nama:</span> {{ $tim->nama }}
                    </p>
                    <p class="mb-2">
                        <span class="font-bold">Keanggotaan:</span> {{ $tim->jabatan->nama_jabatan }}
                    </p>
                    <p class="mb-2">
                        <span class="font-bold">Divisi:</span> {{ $tim->divisi->nama_divisi }}
                    </p>
                    <p class="mb-2">
                        <span class="font-bold">Bidang Keahlian:</span> {{ $tim->bidang_keahlian }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Floating Action Button -->
        <a href="{{ route('admin.edit-tim', $tim->id) }}">
            <button
                class="fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-300 focus:ring-opacity-50 mr-4"
                aria-label="Edit Tim">
                <i class="fa-regular fa-pen-to-square"></i>
            </button>
        </a>
    </main> --}}

@endsection
