@extends('layouts.app-admin')
@section('title', 'halaman Tambah Konten Sejarah PUI GEMAR')
@section('content-admin')

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Form Tambah Sejarah
            </h2>

            <form action="{{ route('admin.store-sejarah') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="isi_sejarah" class="block text-sm font-medium text-gray-700">Konten Sejarah</label>
                    <p class="text-xs text-gray-500 mt-1">
                        Usahakan deskripsi sejarah tidak mengandung gambar.
                    </p>
                    <textarea name="isi_sejarah" id="summernote"></textarea>
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
