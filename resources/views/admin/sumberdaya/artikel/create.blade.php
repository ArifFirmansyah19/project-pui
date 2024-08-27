@extends('layouts.app-admin')
@section('title', 'halaman tambah Artikel admin')
@section('content-admin')
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Tambah Artikel
            </h2>
            <form action="{{ route('admin.store-artikel') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <!-- Nama -->
                <div>
                    <label for="judul_artikel" class="block text-sm font-medium text-gray-700">
                        Masukkan Judul Artikel
                    </label>
                    <input type="text" id="judul" name="judul" placeholder="Masukkan judul artikel" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500"
                        @error('judul')
                    is-invalid
                @enderror
                        value="{{ old('judul') }}" />
                    @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Penulis -->
                <div>
                    <label for="penulis" class="block text-sm font-medium text-gray-700">
                        Nama Penulis Artikel
                    </label>
                    <input type="text" id="penulis" name="penulis" placeholder="Masukkan nama penulis artikel" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <!-- Foto (Gambar) -->
                <div>
                    <label for="gambar_artikel" class="block text-sm font-medium text-gray-700">
                        Foto (unggah gambar) : Opsional
                    </label>
                    <input type="file" id="foto_artikel" name="foto_artikel" {{-- accept="foto_artikel/*" --}}
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500"
                        @error('foto_artikel')
                is-invalid
                @enderror
                        value="{{ old('foto_artikel') }}" />
                    <p class="text-xs text-gray-500 mt-1">
                        Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                    </p>
                    @error('foto_artikel')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <!-- Isi Artikel -->
                <div>
                    <label for="isi_artikel" class="block text-sm font-medium text-gray-700">
                        Isi Artikel
                    </label>
                    <textarea name="deskripsi" id="summernote"></textarea>

                    @error('deskripsi')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
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
            <a href="{{ route('admin.artikel') }}">
                <button
                    class="fixed bottom-4 left-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
                    aria-label="Kembali">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
            </a>
    </main>

@endsection
