@extends('layouts.app-user')
@section('title', 'Museum Geowisata PUI GEMAR')
@section('content')

    <br><br><br><br>
    <!-- Content -->
    <div class="flex flex-col mt-5 md:flex-row w-full">
        <div class="p-4 md:w-2/3">
            <div id="content" class="transition-transform duration-500 ease-in-out">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">
                    Museum PUI GEMAR UNJA
                </h2>
                <div class="grid grid-cols-1 gap-6 px-8 md:grid-cols-2">
                    @foreach ($jenisKeragamans as $jenisKeragaman)
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <a href="{{ route('all-jenis-keragaman', $jenisKeragaman->id) }}">
                                <h3 class="text-xl font-semibold mb-2">{{ $jenisKeragaman->jenis_keragaman }}</h3>
                                <p class="text-gray-600">{{ $jenisKeragaman->deskripsi_keragaman }}</p>
                                <a href="{{ route('all-jenis-keragaman', $jenisKeragaman->id) }}"
                                    class="block text-blue-500 font-semibold mt-2 hover:text-blue-300 transition duration-300">
                                    Jelajahi Semua {{ $jenisKeragaman->jenis_keragaman }}
                                </a>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    @endsection
