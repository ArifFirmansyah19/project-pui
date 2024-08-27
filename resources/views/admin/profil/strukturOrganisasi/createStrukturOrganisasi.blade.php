@extends('layouts.app-admin')
@section('title', 'halaman Tambah Gambar Struktur Organisasi PUI GEMAR')
@section('content-admin')

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Form Tambah Gambar Struktur Organisasi PUI GEMAR
            </h2>

            <form action="{{ route('admin.store-SO') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- foto_Struktur Organisasi -->
                <div>
                    <label for="foto_struktur_organisasi" class="block text-sm font-medium text-gray-700">Foto Struktur
                        Organisasi</label>
                    <input type="file" id="foto_struktur_organisasi" name="foto_struktur_organisasi"
                        accept=".jpg,.jpeg,.png,.webp"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500"
                        onchange="validateFileSize(this)" />
                    <p class="text-xs text-gray-500 mt-1">
                        Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                    </p>
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
