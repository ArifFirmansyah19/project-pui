@extends('layouts.app-admin')
@section('title', 'halaman tambah Jenis Keragaman admin')
@section('content-admin')
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Tambah Jenis Keragaman Museum PUI GEMAR
            </h2>
            <form action="{{ route('admin.storeJK') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <!-- jenis keragaman PUI GEMAR -->
                <div>
                    <label for="jenis_keragaman" class="block text-sm font-medium text-gray-700">
                        Jenis Keragaman PUI GEMAR
                    </label>
                    <input type="text" id="jenis_keragaman" name="jenis_keragaman"
                        placeholder="Masukkan Jenis Keragaman yang hendak diinputkan" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <!-- deskripsi keragaman -->
                <div>
                    <label for="deskripsi_keragaman" class="block text-sm font-medium text-gray-700">
                        Deskripsi Keragaman PUI GEMAR
                    </label>
                    <input type="text" id="deskripsi_keragaman" name="deskripsi_keragaman"
                        placeholder="Masukkan deskripsi Keragaman yang hendak diinputkan" required
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
    </main>

@endsection
