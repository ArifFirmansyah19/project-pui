@extends('layouts.app-admin')
@section('title', 'halaman create Kegiatan PUI GEMAR')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16 pl-12">
                <!-- Tambahkan tombol edit disini -->
                <form action="{{ route('admin.store-kegiatan') }}" method="POST" enctype="multipart/form-data"
                    class="max-w-4xl mx-auto">
                    @csrf
                    <h1 class="text-3xl font-bold mb-4 mt-3 text-indigo-800">
                        Tambah Kegiatan
                    </h1>
                    <div class="mb-4">
                        <label for="nama_kegiatan" class="block text-gray-700 text-md font-bold mb-2">Judul</label>
                        <input type="text" id="nama_kegiatan" name="nama_kegiatan" placeholder="Masukkan judul kegiatan"
                            required
                            class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-50 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                    </div>

                    <div class="mb-4">
                        <label for="foto_kegiatan" class="block text-gray-700 text-md font-bold mb-2">Gambar/Video utama
                            kegiatan</label>
                        <input type="file" id="foto_kegiatan" name="foto_kegiatan"
                            accept="image/*,video/mp4,video/avi,video/mov" multiple
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-50 leading-tight focus:outline-none focus:shadow-outline" />
                        <p class="text-gray-600 text-sm mt-1">
                            *Gambar/Video tidak wajib diunggah. <br />
                            *Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                        </p>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi_kegiatan" class="block text-gray-700 text-md font-bold mb-2">Kegiatan</label>
                        <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan"
                            class="summernote bg-white border border-gray-300 rounded-lg p-4"></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

@endsection
