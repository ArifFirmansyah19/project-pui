@extends('layouts.app-admin')
@section('title', 'halaman struktur organisasi admin')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="max-w-full p-2 bg-gray-100 shadow-md rounded-lg">
                <h1 class="text-4xl font-bold text-indigo-900 mb-16 mt-4">
                    {{ $strukturOrganisasi->judul }}
                </h1>
                <!--konten strurktur organisasi-->

                <div id="image-container" class="flex justify-center mt-6 mb-2">
                    <img src="{{ asset('storage/' . $strukturOrganisasi->foto_struktur_organisasi) }}"
                        alt="Foto Struktur Organisasi" />
                </div>

                <div class="max-w-full p-12 bg-white shadow-md rounded-lg">
                    <h1 class="text-4xl font-bold text-indigo-900 mb-15">Divisi</h1>
                    {{-- @php $no = 1; @endphp
                    @foreach ($divisis as $divisi)
                        <ol id="division-list"
                            class="text-gray-800 mt-6 leading-relaxed list-decimal list-inside text-justify">
                            {{ $no++ }}. {{ $divisi->nama_divisi }}
                        </ol>
                    @endforeach --}}
                    <p class="text-gray-800 leading-relaxed">
                        {!! $strukturOrganisasi->isi_konten !!}
                    </p>
                </div>
            </div>
            <!-- Floating Action Button -->
            @if (!$gambarStrukturOrganisasiExists)
            @else
                <a href="{{ route('admin.edit-SO', $strukturOrganisasi->id) }}">
                    <button
                        class="fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-300 focus:ring-opacity-50 mr-4"
                        aria-label="Edit Struktur Organisasi">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                </a>
            @endif
        </div>
    </main>

@endsection
