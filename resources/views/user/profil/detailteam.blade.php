@extends('layouts.app-user')
@section('title', 'Detail TIM PUI GEMAR')

@section('content')
    <div class="flex flex-col md:flex-row w-full">
        <div class="bg-white rounded-lg p-4 md:w-2/3">

            <h1 class="text-4xl font-bold text-indigo-900 mb-10 mt-6">Profil</h1>
            <div class="flex flex-col sm:flex-row items-center bg-gray-300 p-4 rounded-lg">

                <!-- Gambar -->
                <div class="flex-shrink-0 sm:w-1/3 w-full">
                    @if ($tim->foto)
                        <img src="{{ asset('storage/' . $tim->foto) }}" alt="Foto Anggota {{ $tim->nama }}"
                            class="w-64 h-64 rounded-full border-4 border-indigo-600 shadow-lg mx-auto sm:mx-0 sm:mr-8" />
                    @else
                        <img src="{{ asset('img/fotoKosong.png') }}" alt="Foto Anggota {{ $tim->nama }}"
                            class="w-64 h-64 rounded-full border-4 border-indigo-600 shadow-lg mx-auto sm:mx-0 sm:mr-8" />
                    @endif
                </div>

                <!-- Teks Penjelasan -->
                <div class="flex-1 max-w-xl text-gray-800 leading-relaxed bg-gray-100 shadow-lg rounded-lg p-6">
                    <p class="mb-2"><span class="font-bold">Nama:</span> {{ $tim->nama }}</p>
                    <p class="mb-2">
                        <span class="font-bold">Keanggotaan:</span> {{ $tim->jabatan }}
                    </p>
                    <p class="mb-2">
                        <span class="font-bold">Divisi:</span> {{ $tim->divisi->nama_divisi }}
                    </p>
                    <p class="mb-2">
                        <span class="font-bold">Bidang Keahlian: </span> {{ $tim->bidang_keahlian }}
                    </p>
                </div>
            </div>
        </div>

        @include('layouts.session-article')
    </div>
@endsection
