@extends('layouts.app-user')
@section('title', 'Kegiatan PUI GEMAR')

@section('content')
    <div class="flex flex-col mt-5 md:flex-row w-full">
        <div class="bg-white shadow-md mt-5 rounded-lg p-4 md:w-2/3">
            <h1 class="text-4xl font-bold text-indigo-900 mt-24">Kegiatan</h1>
            @foreach ($kegiatansWithComments as $kegiatan)
                <a href="{{ route('detail-kegiatan', $kegiatan->id) }}">
                    <div
                        class="pl-3 pr-3 mb-8 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                        <h2 class="text-lg font-semibold text-indigo-900 mb-2 mt-10">
                            {{ $kegiatan->nama_kegiatan }}
                        </h2>
                        <p class="text-sm text-gray-500 mb-2">{{ $kegiatan->formatted_created_at }}</p>
                        <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}"
                            alt="gambar kegiatan {{ $kegiatan->nama_kegiatan }}"
                            class="mb-2 rounded-lg h-96 w-full object-cover" />
                        <p class="text-gray-800 leading-relaxed">
                            {{ implode("\n", array_slice(explode("\n", wordwrap(strip_tags($kegiatan->deskripsi_kegiatan), 150, "\n")), 0, 7)) }}
                            ...........
                        </p>
                </a>

                <div class="flex items-center mt-4 space-x-4">
                    <button
                        class="flex items-center text-gray-400 hover:text-blue-400 transition duration-300 commentKegiatanBtn"
                        data-kegiatan-id="{{ $kegiatan->id }}">
                        <i class="far fa-comment mr-1"></i>
                        <span class="commentCount">{{ $kegiatan->totalComments }}</span>
                    </button>
                </div>
        </div>
        @endforeach
    </div>
    <!-- Modal -->
    <div id="commentKegiatanModal"
        class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Tulis Komentar</h2>
                <button id="closeKegiatanModal" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
            </div>
            <div id="modalCommentKegiatanContent">
                <!-- Comments will be dynamically added here -->
            </div>
        </div>
    </div>

    @include('layouts.session-article')
    </div>

@endsection
