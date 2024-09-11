@extends('layouts.app-admin')
@section('title', 'halaman Create HKI admin')
@section('content-admin')


    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Form Tambah HKI PUI GEMAR
            </h2>

            <form action="{{ route('admin.store-HKI') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <!-- Judul HKI -->
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700">Judul HKI</label>
                    <input type="text" id="judul" name="judul" placeholder="Masukkan judul HKI" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <!-- Nama Pemilik HKI -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Pemilik HKI</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama pemilik HKI" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>


                <!-- deskripsi HKI -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi HKI</label>
                    <textarea id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi dari HKI" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                </div>


                <!-- File_path HKI -->
                <div>
                    <label for="file_path" class="block text-sm font-medium text-gray-700">File HKI (Pdf)</label>
                    <input type="file" id="file_path" name="file_path" accept="application/pdf" required
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
        </div>
    </main>

@endsection
