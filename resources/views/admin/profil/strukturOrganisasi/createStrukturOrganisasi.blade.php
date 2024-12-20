@extends('layouts.app-admin')
@section('title', 'halaman Tambah Gambar Struktur Organisasi PUI GEMAR')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16 pl-12">
                <!-- Form Edit Konten Sejarah -->
                <form action="{{ route('admin.store-SO') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <h1 class="text-xl sm:text-3xl font-bold mb-4 mt-3 text-indigo-800">
                        Tambah Struktur Organisasi PUI GEMAR
                    </h1>

                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 text-md font-bold mb-2">Judul</label>
                        <input type="text" id="judul" name="judul" placeholder="Masukkan judul konten" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-50 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                    </div>
                    <div class="mb-4">
                        <label for="foto_struktur_organisasi" class="block text-gray-700 text-md font-bold mb-2">Gambar
                            Struktur
                            Organisasi</label>
                        <input type="file" id="foto_struktur_organisasi" name="foto_struktur_organisasi" accept="image/*"
                            class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-50 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            onchange="validateFileSize(this)" />
                        <p class="text-gray-600 text-sm mt-1">
                            Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                        </p>
                    </div>
                    <div class="mb-4">
                        <label for="isi_konten" class="block text-gray-700 text-md font-bold mb-2">Konten Struktur
                            Organisasi</label>
                        <textarea name="isi_konten" id="isi_konten" class="summernote" class="bg-white border border-gray-300 rounded-lg p-4"></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        function validateFileSize(input) {
            const file = input.files[0];
            if (file && file.size > 2 * 1024 * 1024) { // 2MB dalam byte
                alert("Ukuran file tidak boleh lebih dari 2MB.");
                input.value = ""; // Reset input file
            }
        }
    </script>
@endsection
