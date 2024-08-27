@extends('layouts.app-user')
@section('title', 'Struktur Organisasi PUI GEMAR')

@section('content')
    <div class="flex flex-col md:flex-row w-full">
        <!-- konten-->
        <div class="mt-10 p-4 md:w-2/3">
            <div class="max-w-full p-6">
                <h1 class="text-4xl font-bold text-indigo-900 mt-10 mb-16">
                    Struktur Organisasi
                </h1>
                <!--konten strurktur organisasi-->

                <div class="items-center mt-6">
                    @if (!$gambarStrukturOrganisasiExists)
                    @else
                        <img src="{{ asset('storage/' . $strukturOrganisasi->foto_struktur_organisasi) }}"
                            alt="Foto Struktur Organisasi" style="width: 90%; height:650px;" />
                    @endif
                </div>
            </div>
            <div class="max-w-full p-12">
                <h1 class="text-2xl font-bold text-indigo-900 mb-15">Divisi</h1>

                <p class="text-gray-800 mt-6 leading-relaxed">
                    @foreach ($divisis as $divisi)
                        <li class="text-justify">
                            <strong>{{ $divisi->nama_divisi }}</strong> :
                            {{ $divisi->deskripsi_divisi }}
                        </li>
                    @endforeach
                </p>
            </div>
        </div>
        @include('layouts.session-article')
    </div>
@endsection
