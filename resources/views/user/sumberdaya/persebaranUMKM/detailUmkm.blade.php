@extends('layouts.app-user')
@section('title', 'Detail Persebaran PUI GEMAR')

@section('content')
    <div class="container mx-auto px-8  mb-10">
        <!-- Nama UMKM dan Penjelasan Singkat -->
        <h1 class="text-3xl font-bold text-indigo-900 mb-4 mt-10 pt-5">{{ $umkm->nama_umkm }}</h1>
        <!-- Produk Produk -->
        <div class="mb-8">
            <h3 class="text-2xl font-semibold text-indigo-900 mb-4">Produk</h3>
            <div class="grid grid-cols-1 gap-6 px-8 md:grid-cols-2">
                @foreach ($umkm->produkUmkm as $produk)
                    <div class="bg-white rounded-md shadow-md overflow-hidden">
                        <img src="{{ asset('storage/' . $produk->foto_produk) }}" alt="{{ $produk->nama_produk }}"
                            class="w-full h-60 object-cover" />
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-indigo-900 mb-2">
                                {{ $produk->nama_produk }}
                            </h3>
                            {{-- <p class="text-gray-600 mb-1">{{ $produk->deskripsi_produk }}</p> --}}
                            <div class="flex items-center justify-between">
                                @if ($produk->harga_terendah == $produk->harga_tertinggi)
                                    <span class="text-indigo-700 font-semibold text-sm">
                                        Rp {{ number_format($produk->harga_terendah, 2, ',', '.') }}
                                    </span>
                                @else
                                    <span class="text-indigo-700 font-semibold text-sm">
                                        Rp {{ number_format($produk->harga_terendah, 2, ',', '.') }} - Rp
                                        {{ number_format($produk->harga_tertinggi, 2, ',', '.') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <!-- Kontak UMKM -->
        <div class="mb-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-indigo-900 mb-4 border-b-2">
                    Kontak Pihak UMKM
                </h3>
                <p class="text-gray-700 mb-3">
                    Untuk informasi lebih lanjut, Anda dapat menghubungi:
                </p>
                <div class="flex items-center mb-1">
                    <i class="fas fa-user-circle text-indigo-700 text-xl mr-4"></i>
                    <p class="text-gray-800 text-lg">Nama Kontak: {{ $umkm->nama_pemilik }}</p>
                </div>
                <div class="flex items-center mb-1">
                    <i class="fas fa-phone-alt text-indigo-700 text-xl mr-4"></i>
                    <p class="text-gray-800 text-lg cursor-pointer">
                        Telepon: {{ $umkm->kontak }}
                    </p>
                </div>
                <div class="flex items-center mb-1">
                    <i class="fas fa-envelope text-indigo-700 text-xl mr-4"></i>
                    <p class="text-gray-800 text-lg">
                        Whatsapp:
                        <a href="https://wa.me/{{ $umkm->whatsapp }}?text=Halo%2C%20saya%20tertarik%20dengan%20produk%20Anda!"
                            class="text-indigo-600 hover:underline">{{ $umkm->whatsapp }}</a>
                    </p>
                </div>
                <div class="flex items-center mb-1">
                    <i class="fas fa-envelope text-indigo-700 text-xl mr-4"></i>
                    <p class="text-gray-800 text-lg">
                        Email:
                        <a href="mailto:{{ $umkm->email }}"
                            class="text-indigo-600 hover:underline">{{ $umkm->email }}</a>
                    </p>
                </div>
                <div class="flex items-center mb-1">
                    <i class="fab fa-instagram text-indigo-700 text-xl mr-4"></i>
                    <p class="text-gray-800 text-lg">
                        Instagram:
                        <a href="{{ $umkm->instagram }}" class="text-indigo-600 hover:underline">{{ $username }}</a>
                    </p>
                </div>
                <div class="flex items-center mb-2">
                    <i class="fas fa-map-marker-alt text-indigo-700 text-xl mr-4"></i>
                    <p class="text-gray-800 text-lg">
                        Alamat: {{ $umkm->alamat_umkm }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
