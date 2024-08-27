@extends('layouts.app-admin')
@section('title', 'halaman create Kegiatan PUI GEMAR')
@section('content-admin')

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Form Tambah Kegiatan PUI GEMAR
            </h2>

            <form action="{{ route('admin.store-kegiatan') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <!-- Nama_Kegiatan -->
                <div>
                    <label for="nama_kegiatan" class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                    <input type="text" id="nama_kegiatan" name="nama_kegiatan"
                        placeholder="Masukkan nama kegiatan lengkap" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <!-- foto_kegiatan (Gambar) Kegiatan -->
                <div>
                    <label for="foto_kegiatan" class="block text-sm font-medium text-gray-700">foto Kegiatan</label>
                    <input type="file" id="foto_kegiatan" name="foto_kegiatan" {{-- accept="image/*" --}}
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                    <p class="text-xs text-gray-500 mt-1">
                        Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                    </p>
                </div>

                <div>
                    <label for="deskripsi_kegiatan" class="block text-sm font-medium text-gray-700">Deskripsi
                        Kegiatan</label>
                    <p class="text-xs text-gray-500 mt-1">
                        Usahakan deskripsi kegiatan tidak mengandung gambar.
                    </p>
                    <textarea name="deskripsi_kegiatan" id="summernote"></textarea>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </main>


    {{-- <!-- Floating Action Button -->
    <a href="{{ route('admin.kegiatan') }}">
        <button
            class="fixed bottom-4 left-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
            aria-label="Kembali">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
    </a> --}}

@endsection
