@extends('layouts.app-admin')
@section('title', 'halaman Create HKI admin')
@section('content-admin')
    <!-- Content -->
    <main class="flex-1 bg-gray-50 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16 pl-12">
                <form action="{{ route('admin.store-HKI') }}" method="POST" enctype="multipart/form-data"
                    class="max-w-4xl mx-auto">
                    @csrf
                    <h1 class="text-2xl sm:text-3xl font-bold mb-4 mt-3 text-indigo-800">
                        Tambah HKI
                    </h1>
                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 text-md font-bold mb-2">
                            Judul
                        </label>
                        <input type="text" id="judul" name="judul" placeholder="Masukkan Judul HKI" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                    </div>
                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 text-md font-bold mb-2">
                            Nama Pencipta
                        </label>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Pencipta" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-gray-700 text-md font-bold mb-2">
                            Deskripsi Singkat HKI
                        </label>
                        <!-- Summernote Editor -->
                        <textarea name="deskripsi" placeholder="Masukkan deskripsi dari HKI" required class="summernote"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="file_path" class="block text-gray-700 text-md font-bold mb-2">
                            Dokumen (PDF)
                        </label>
                        <input type="file" id="file_path" name="file_path" accept=".pdf"
                            class="w-full border border-gray-300 bg-gray-50 p-2 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
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

@endsection
