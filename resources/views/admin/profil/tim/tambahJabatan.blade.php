@extends('layouts.app-admin')
@section('title', 'halaman tambah jabatan Tim admin')
@section('content-admin')

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Formulir Tambah Jabatan Tim PUI GEMAR
            </h2>

            <form action="{{ route('admin.store-jabatan') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- divisi Id -->
                <div>
                    <label for="divisi_id" class="block text-sm font-medium text-gray-700">Divisi PUI GEMAR</label>
                    <select id="divisi_id" name="divisi_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                        @foreach ($divisis as $divisi)
                            <option value="{{ $divisi->id }}">{{ $divisi->nama_divisi }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Nama Jabatan -->
                <div>
                    <label for="nama_jabatan" class="block text-sm font-medium text-gray-700">Nama Jabatan</label>
                    <input type="text" id="nama_jabatan" name="nama_jabatan"
                        placeholder="Masukkan nama jabatan divisi anggota" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>


                <!-- deskripsi jabatan -->
                <div>
                    <label for="deskripsi_jabatan" class="block text-sm font-medium text-gray-700">Deskripsi Jabatan</label>
                    <input type="text" id="deskripsi_jabatan" name="deskripsi_jabatan"
                        placeholder="Masukkan Deskripsi Jabatan yang Diinputkan" required
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
    </div>
    </div>

    {{-- <!-- Floating Action Button -->
    <a href="{{ route('admin.tim') }}">
        <button
            class="fixed bottom-4 left-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
            aria-label="Kembali">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
    </a> --}}

@endsection
