@extends('layouts.app-user')
@section('title', 'Struktur Organisasi PUI GEMAR')
@section('content')

    <div class="flex flex-col md:flex-row w-full">
        <!-- konten -->
        <div class="max-w-full p-12 bg-white shadow-md rounded-lg md:w-2/3">
            <h1 class="text-4xl font-bold text-indigo-900 mb-16">
                {{ $strukturOrganisasi->judul }}
            </h1>

            <!-- Menampilkan Gambar Struktur Organisasi jika ada -->
            <div class="items-center mt-6">
                @if ($gambarStrukturOrganisasiExists)
                    <!-- Jika gambar ada, tampilkan gambar -->
                    <img src="{{ asset('storage/' . $strukturOrganisasi->foto_struktur_organisasi) }}"
                        alt="Foto Struktur Organisasi" class="w-full h-auto" />
                @endif
            </div>

            <div class="max-w-full px-6 pb-6">
                @if ($gambarStrukturOrganisasiExists)
                    <h1 class="text-2xl font-bold text-indigo-900 mb-15">Divisi</h1>
                    <p class="text-gray-800 mt-6 leading-relaxed">
                        {!! $strukturOrganisasi->isi_konten !!}
                    </p>
                @else
                    <!-- Jika tidak ada gambar, hanya tampilkan konten -->
                    <p class="text-gray-800 mt-6 leading-relaxed">
                        {!! $strukturOrganisasi->isi_konten !!}
                    </p>
                @endif
            </div>
        </div>

        @include('layouts.session-article')
    </div>
@endsection
