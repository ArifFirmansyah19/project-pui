@extends('layouts.app-admin')
@section('title', 'detail Umkm admin')
@section('content-admin')

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h1 class="text-3xl font-bold text-gray-800 mb-4 mt-3">
                {{ $umkm->nama_umkm }}
            </h1>
            <h2 class="text-lg text-gray-700 mb-8">
                Alamat: {{ $umkm->alanat_umkm }} - {{ $umkm->alamat_umkm }}
            </h2>
            <p class="text-lg text-gray-700 mb-8">
                {!! $umkm->deskripsi_umkm !!}
            </p>

            <div class="mb-8">
                <h3 class="text-2xl font-semibold text-indigo-900 mb-4">Produk</h3>
                <div class="grid grid-cols-2 gap-6 px-8 md:grid-cols-2">
                    @foreach ($umkm->produkUmkm as $produk)
                        <div class="bg-white rounded-md shadow-md overflow-hidden">
                            <img src="{{ asset('storage/' . $produk->foto_produk) }}" alt="{{ $produk->nama_produk }}"
                                class="w-full h-60 object-cover" />
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-indigo-900 mb-2">
                                    {{ $produk->nama_produk }}
                                </h3>
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
                <h2 class="text-2xl font-semibold text-indigo-900 mb-6">Kontak UMKM</h2>
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
                        <p class="text-gray-800 text-lg cursor-pointer" onclick="copyPhoneNumber()">
                            Telepon: {{ $umkm->kontak }}
                        </p>
                    </div>
                    <div class="flex items-center mb-1">
                        <i class="fas fa-envelope text-indigo-700 text-xl mr-4"></i>
                        <p class="text-gray-800 text-lg">
                            Whatsapp:{{ $umkm->whatsapp }}
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
                            <a href="{{ $umkm->instagram }}"
                                class="text-indigo-600 hover:underline">{{ $username }}</a>
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


            <a href="{{ route('admin.edit-umkm', ['kecamatan_id' => $kecamatan->id, 'umkm_id' => $umkm->id]) }}">
                <button
                    class="fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
                    aria-label="Edit UMKM">
                    <i class="fas fa-edit" style="color: #ffffff;">
                    </i>
            </a>
            </button>
        </div>
    </main>
@endsection
