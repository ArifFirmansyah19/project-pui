@extends('layouts.app-admin')
@section('title', 'Halaman Edit Data Keragaman admin')
@section('content-admin')
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Edit Data Keragaman Museum PUI GEMAR
            </h2>

            <form action="{{ route('admin.updateDK', $dataKeragaman->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf

                <!-- Jenis Keragaman -->
                <div>
                    <label for="jenis_keragaman_id" class="block text-sm font-medium text-gray-700">Jenis Data Museum</label>
                    <select id="jenis_keragaman_id" name="jenis_keragaman_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500"
                        disabled>
                        <option value="{{ $dataKeragaman->jenis_keragaman_id }}" selected>
                            {{ $dataKeragaman->jenisKeragaman->jenis_keragaman }}</option>
                    </select>
                    <input type="hidden" name="jenis_keragaman_id" value="{{ $dataKeragaman->jenis_keragaman_id }}">
                </div>

                <!-- Nama Keragaman -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Keragaman</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama keragaman" required
                        value="{{ old('name', $dataKeragaman->nama) }}"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <!-- Foto Keragaman -->
                <div>
                    <label for="foto_keragaman" class="block text-sm font-medium text-gray-700">Foto Keragaman</label>

                    <input type="hidden" name="foto_lama" value="{{ $dataKeragaman->foto_keragaman }}">
                    <div class="foto_lama">
                        @if ($dataKeragaman->foto_keragaman)
                            <!-- Jika ada gambar, tampilkan gambar -->
                            <img src="{{ asset('storage/' . $dataKeragaman->foto_keragaman) }}"
                                alt="Foto Keragaman {{ $dataKeragaman->nama }}" height="150px" width="150px" />
                        @else
                            <!-- Jika tidak ada gambar, isi foto Default -->
                            <img src="{{ asset('img/gambarKosong.png') }}" alt="Foto Keragaman {{ $dataKeragaman->nama }}"
                                height="150px" width="150px" />
                        @endif
                    </div>
                    <label for="foto" class="block text-sm font-medium text-gray-700">Input Foto Keragaman Baru</label>
                    <input type="file" id="foto_keragaman" name="foto_keragaman"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                    <p class="text-xs text-gray-500 mt-1">Format yang didukung: JPG, PNG. Ukuran file maksimal: 2MB.</p>
                </div>

                <!-- Deskripsi Keragaman -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Keragaman</label>
                    <textarea name="deskripsi" id="summernote">{!! $dataKeragaman->deskripsi !!}</textarea>
                </div>

                <!-- Lokasi -->
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi Keragaman</label>
                    <input type="text" id="lokasi" name="lokasi" placeholder="Masukkan lokasi keragaman" required
                        value="{{ old('name', $dataKeragaman->lokasi) }}"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <!-- Umur -->
                <div>
                    <label for="umur" class="block text-sm font-medium text-gray-700">Umur Keragaman</label>
                    <input type="text" id="umur" name="umur" placeholder="Masukkan umur keragaman" required
                        value="{{ old('name', $dataKeragaman->umur) }}"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                        UPDATE
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
