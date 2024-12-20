@extends('layouts.app-admin')
@section('title', 'halaman tambah Artikel admin')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16 pl-12">
                <!-- Tambahkan tombol edit disini -->
                <form action="{{ route('admin.store-artikel') }}" method="POST" enctype="multipart/form-data"
                    class="max-w-4xl mx-auto">
                    @csrf
                    <h1 class="text-3xl font-bold mb-4 mt-3 text-indigo-800">
                        Tambah Artikel
                    </h1>

                    <!-- Judul -->
                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 text-md font-bold mb-2">Judul</label>
                        <input type="text" id="judul" name="judul" placeholder="Masukkan judul konten" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-50 leading-tight focus:outline-none focus:shadow-outline" />
                    </div>

                    <!-- Penulis -->
                    <div class="mb-4">
                        <label for="penulis" class="block text-gray-700 text-md font-bold mb-2">Penulis</label>
                        <input type="text" id="penulis" name="penulis" placeholder="Masukkan nama penulis artikel"
                            required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-50 leading-tight focus:outline-none focus:shadow-outline" />
                    </div>

                    <!-- Foto (Gambar) -->
                    <div class="mb-4">
                        <label for="foto_artikel" class="block text-gray-700 text-md font-bold mb-2">Gambar utama
                            artikel</label>
                        <input type="file" id="foto_artikel" name="foto_artikel" accept="image/*"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-50 leading-tight focus:outline-none focus:shadow-outline" />
                        <p class="text-gray-600 text-sm mt-1">
                            *Gambar tidak wajib diunggah.
                        </p>
                    </div>

                    <!-- Abstract -->
                    <div class="mb-4">
                        <label for="abstract" class="block text-gray-700 text-md font-bold mb-2">Abstrak</label>
                        <textarea name="abstract" id="abstract" class="summernote" class="bg-white border border-gray-300 rounded-lg p-4"></textarea>
                    </div>

                    <!-- Input untuk Link Jurnal -->
                    <div class="mb-4">
                        <label for="file_path" class="block text-gray-700 text-md font-bold mb-2">Link Jurnal
                        </label>
                        <input type="url" id="file_path" name="file_path" placeholder="Masukkan link jurnal "
                            class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-50 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                        <p class="text-gray-600 text-sm mt-1">
                            *Tambahkan link ke jurnal
                        </p>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

@endsection
