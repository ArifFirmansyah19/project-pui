@extends('layouts.app-user')
@section('title', 'Team PUI GEMAR')

@section('content')
    <div class="flex flex-col md:flex-row w-full">
        <div class="bg-white mt-5 rounded-lg p-4 md:w-2/3">
            <!-- Konten 1 -->
            <div class="team-section">
                <div class="max-w-full p-3">
                    <h1 class="text-4xl font-bold text-indigo-900 mt-20 mb-4">Team PUI GEMAR</h1>
                    @foreach ($groupedTims as $divisiName => $dataTimPui)
                        <h2 class="text-2xl font-bold text-indigo-900 mt-10 mb-5 ml-4">{{ $divisiName }}</h2>

                        <!-- Team member -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10 ml-4">
                            @foreach ($dataTimPui as $tim)
                                <div
                                    class="team-member bg-white rounded-lg overflow-hidden shadow-md transform transition duration-300 hover:scale-105 w-[40%]">
                                    <a href="{{ route('tim-detail', $tim->id) }}">
                                        <!-- Gambar -->
                                        <!-- Memeriksa apakah ada gambar tim -->
                                        @if ($tim->foto)
                                            <!-- Jika ada gambar, tampilkan gambar -->
                                            <img src="{{ asset('storage/' . $tim->foto) }}"
                                                alt="Foto Anggota {{ $tim->nama }}" class="w-full h-64 object-cover" />
                                        @else
                                            <!-- Jika tidak ada gambar, isi foto Default -->
                                            <img src="{{ asset('img/fotoKosong.png') }}"
                                                alt="Foto Anggota {{ $tim->nama }}" class="w-full h-64 object-cover" />
                                        @endif

                                        <!-- Konten -->
                                        <div class="p-6">
                                            <h3 class="text-2xl font-semibold text-gray-800 mb-2">{{ $tim->nama }}
                                            </h3>
                                            <p class="text-gray-600">{{ $tim->jabatan->nama_jabatan }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include('layouts.session-article')
    </div>










    {{-- <div class="flex">
        <div class="max-w-full p-12 bg-white shadow-md rounded-lg w-2/3">
            <div class="max-w-full p-3 bg-white shadow-md rounded-lg">
                <h1 class="text-4xl font-bold text-indigo-900 mb-14">Team</h1>
                <!-- Pengelompokan divisi -->
                @foreach ($groupedTims as $divisiName => $dataTimPui)
                    <div class="team-section mt-12">
                        <h2 class="text-2xl font-bold text-indigo-900 mb-5 ml-4">
                            {{ $divisiName }}
                        </h2>
                        <!-- Team member -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-10 ml-4">
                            @foreach ($dataTimPui as $item)
                                <div
                                    class="team-member bg-white rounded-lg overflow-hidden shadow-md transform transition duration-300 hover:scale-105">
                                    <a href="{{ route('tim-detail', $item->id) }}">
                                        <!-- Gambar -->
                                        <img src="{{ asset('fotoTim/' . $item->foto) }}" alt="foto {{ $item->nama }}"
                                            class="w-full h-56" />
                                        <!-- Konten -->
                                        <div class="p-4">
                                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $item->nama }}
                                            </h3>
                                            <p class="text-gray-600">{{ $item->jabatan->nama_jabatan }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
    </div>
    @include('layouts.session-article') --}}

@endsection
