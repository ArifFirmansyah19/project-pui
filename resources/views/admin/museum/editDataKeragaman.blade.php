@extends('layouts.app-admin')
@section('title', 'Halaman Edit Data Keragaman admin')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="container mx-auto">
                <!-- Dropdown Pilihan Jenis Data -->
                <h2 class="text-3xl font-bold mb-6 text-indigo-900">
                    Edit Data Museum
                </h2>

                <form action="{{ route('admin.updateDK', $dataKeragaman->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="jenis_keragaman_id" class="block text-lg font-bold text-gray-700 mb-2">Pilih Jenis Data
                            Keragaman:</label>
                        <select id="jenis_keragaman_id" name="jenis_keragaman_id"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @foreach ($jenisKeragamans as $jenisKeragaman)
                                <option value="{{ $jenisKeragaman->id }}"
                                    {{ $jenisKeragaman->id == $dataKeragaman->jenis_keragaman_id ? 'selected' : '' }}>
                                    {{ $jenisKeragaman->jenis_keragaman }}
                                </option>
                            @endforeach
                        </select>
                    </div>



                    <!-- Nama Keragaman -->
                    <div class="mb-4">
                        <label for="nama" class="block text-lg font-bold text-gray-700 mb-2">Nama Keragaman:</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $dataKeragaman->nama) }}"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>



                    <!-- Foto -->
                    <div class="mb-4">
                        <label for="foto_keragaman" class="block text-lg font-bold text-gray-700 mb-2">Foto
                            Keragaman</label>
                        <input type="hidden" name="foto_lama" value="{{ $dataKeragaman->foto_keragaman }}">
                        <div class="foto_lama">
                            @if ($dataKeragaman->foto_keragaman)
                                <!-- Jika ada gambar, tampilkan gambar -->
                                <img src="{{ asset('storage/' . $dataKeragaman->foto_keragaman) }}"
                                    alt="Foto Keragaman {{ $dataKeragaman->nama }}" height="150px" width="150px" />
                            @else
                                <!-- Jika tidak ada gambar, isi foto Default -->
                                <img src="{{ asset('img/gambarKosong.png') }}"
                                    alt="Foto Keragaman {{ $dataKeragaman->nama }}" height="150px" width="150px" />
                            @endif
                        </div>

                        <label for="foto_keragaman" class="block text-lg font-bold text-gray-700 mb-2">Unggah Foto
                            <input type="file" id="foto_keragaman" name="foto_keragaman"
                                class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                accept="image/*" />
                            <small class="text-gray-500">Biarkan kosong jika tidak ingin mengubah foto.</small>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-lg font-bold text-gray-700 mb-2">Deskripsi:</label>
                        <textarea name="deskripsi" id="deskripsi" class="summernote">{!! $dataKeragaman->deskripsi !!}</textarea>
                    </div>

                    <!-- Lokasi -->
                    <div class="mb-4">
                        <label for="lokasi" class="block text-lg font-bold text-gray-700 mb-2">Lokasi:</label>
                        <input type="text" id="lokasi" name="lokasi"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            value="{{ old('lokasi', $dataKeragaman->lokasi) }}" />
                    </div>

                    <!-- Umur -->
                    <div class="mb-4">
                        <label for="umur" class="block text-lg font-bold text-gray-700 mb-2">Umur (Tahun):</label>
                        <input type="text" id="umur" name="umur"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            value="{{ old('umur', $dataKeragaman->umur) }}" />
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
