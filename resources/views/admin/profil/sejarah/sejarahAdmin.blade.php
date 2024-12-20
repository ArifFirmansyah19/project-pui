@extends('layouts.app-admin')
@section('title', 'halaman sejarah admin')
@section('content-admin')

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 overflow-y-auto mx-3">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h1 class="text-3xl sm:text-4xl font-bold text-indigo-900 mt-2 mb-5">
                {{ $sejarah->judul }}
            </h1>
            @if (!$sejarahExists)
                <div class="flex justify-start mb-10">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 mt-10 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        <a href="{{ route('admin.create-sejarah') }}">
                            Tambah Konten sejarah
                        </a>
                    </button>
                </div>
            @else
                <p class="text-gray-800 leading-relaxed text-justify">
                    @if ($sejarah->foto_konten_sejarah)
                        <img src="{{ asset('storage/' . $sejarah->foto_konten_sejarah) }}"
                            alt="Gambar Kegiatan {{ $sejarah->judul }}" class="mb-2 rounded-lg h-96 w-full object-cover" />
                    @else
                    @endif
                    {!! $sejarah->isi_sejarah !!}
                </p>
        </div>
    </main>
    </div>
    <!-- Floating Action Button -->
    <a href="{{ route('admin.edit-sejarah', $sejarah->id) }}">
        <button
            class="fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-300 focus:ring-opacity-50 mr-4"
            aria-label="Edit sejarah">
            <i class="fa-regular fa-pen-to-square"></i>
        </button>
    </a>
    @endif
@endsection
