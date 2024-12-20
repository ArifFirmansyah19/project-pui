@extends('layouts.app-admin')
@section('title', 'halaman Tambah Data Keragaman admin')
@section('content-admin')
    {{-- <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Tambah Data Keragaman Museum PUI GEMAR
            </h2>

            <form action="{{ route('admin.storeDK') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- jenis keragaman Id -->
                <div>
                    <label for="jenis_keragaman_id" class="block text-sm font-medium text-gray-700">
                        Jenis Data Museum
                    </label>
                    <select id="jenis_keragaman_id" name="jenis_keragaman_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled selected>Pilih opsi...</option>
                        @foreach ($jenisKeragamans as $jenisKeragaman)
                            <option value="{{ $jenisKeragaman->id }}">
                                {{ $jenisKeragaman->jenis_keragaman }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">
                        Nama keragaman
                    </label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama keragaman" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <!-- Foto (Gambar) -->
                <div>
                    <label for="foto_keragaman" class="block text-sm font-medium text-gray-700">
                        Foto Keragaman
                    </label>
                    <input type="file" id="foto_keragaman" name="foto_keragaman"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                    <p class="text-xs text-gray-500 mt-1">
                        Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                    </p>
                </div>

                <!-- Deskripsi Keragaman -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">
                        Deskripsi Keragaman
                    </label>
                    <textarea name="deskripsi" id="summernote"></textarea>
                </div>

                <!-- lokasi -->
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-700">
                        Lokasi Keragaman
                    </label>
                    <input type="text" id="lokasi" name="lokasi" placeholder="Masukkan lokasi keragaman" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <!-- umur -->
                <div>
                    <label for="umur" class="block text-sm font-medium text-gray-700">
                        Umur Keragaman
                    </label>
                    <input type="text" id="umur" name="umur" placeholder="Masukkan lokasi keragaman" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                        Tambah
                    </button>
                </div>
            </form>

            <!-- Floating Action Button -->
            <a href="{{ route('admin.museum') }}">
                <button
                    class="fixed bottom-4 left-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
                    aria-label="Kembali">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
            </a>
    </main> --}}

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="container mx-auto">
                <!-- Dropdown Pilihan Jenis Data -->
                <h2 class="text-3xl font-bold mb-6 text-indigo-900">
                    Tambah Data Keragaman Baru
                </h2>

                <form action="{{ route('admin.storeDK') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <!-- Pilihan Jenis Keragaman -->
                    <div class="mb-4">
                        <label for="jenis_keragaman_id" class="block text-lg font-bold text-gray-700 mb-2">Pilih Jenis Data
                            Keragaman:</label>
                        <select id="jenis_keragaman_id" name="jenis_keragaman_id"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required>
                            <option value="" disabled selected>Pilih opsi...</option>
                            @foreach ($jenisKeragamans as $jenisKeragaman)
                                <option value="{{ $jenisKeragaman->id }}">
                                    {{ $jenisKeragaman->jenis_keragaman }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nama Keragaman -->
                    <div class="mb-4">
                        <label for="nama" class="block text-lg font-bold text-gray-700 mb-2">Nama Keragaman:</label>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama keragaman"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required />
                    </div>

                    <!-- Foto -->
                    <div class="mb-4">
                        <label for="foto_keragaman" class="block text-lg font-bold text-gray-700 mb-2">Unggah Foto:</label>
                        <input type="file" id="foto_keragaman" name="foto_keragaman"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            accept="image/*" required />
                        <p class="text-xs text-gray-500 mt-1">
                            Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                        </p>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-lg font-bold text-gray-700 mb-2">Deskripsi:</label>
                        <textarea name="deskripsi" id="deskripsi" class="summernote"></textarea>
                    </div>

                    <!-- Lokasi -->
                    <div class="mb-4">
                        <label for="lokasi" class="block text-lg font-bold text-gray-700 mb-2">Lokasi:</label>
                        <input type="text" id="lokasi" name="lokasi" placeholder="Masukkan lokasi"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required />
                    </div>

                    <!-- Umur -->
                    <div class="mb-4">
                        <label for="umur" class="block text-lg font-bold text-gray-700 mb-2">Umur (Tahun):</label>
                        <input type="text" id="umur" name="umur" placeholder="Masukkan umur dalam tahun"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required />
                    </div>

                    <!-- Tombol Tambah -->
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            Tambah Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>


@endsection
