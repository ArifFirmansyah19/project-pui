@extends('layouts.app-admin')
@section('title', 'Halaman Edit Museum admin')
@section('content-admin')


    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="container mx-auto">
                <!-- Dropdown Pilihan Jenis Data -->
                <h2 class="text-3xl font-bold mb-6 text-indigo-900">
                    Edit Data Sejarah Geopark Merangin
                </h2>

                <!-- Formulir Edit -->
                <form id="updateForm" action="{{ route('admin.updateMG', $dataGeopark->id) }}" method="POST"
                    enctype="multipart/form-data" class="max-w-4xl mx-auto">
                    @csrf
                    <!-- Field Judul -->
                    <div>
                        <label for="judul" class="block text-gray-700 font-bold mb-2">Judul</label>
                        <input type="text" id="judul" name="judul" value="{{ old('judul', $dataGeopark->judul) }}"
                            class="border rounded p-2 w-full mb-4" />
                    </div>

                    <!-- Field Gambar Utama -->
                    <div class="mb-4">
                        <label for="foto" class="block text-lg font-bold text-gray-700 mb-2">Foto
                            Keragaman</label>
                        <input type="hidden" name="foto_lama" value="{{ $dataGeopark->foto }}">
                        <div class="foto_lama">
                            @if ($dataGeopark->foto)
                                <!-- Jika ada gambar, tampilkan gambar -->
                                <img src="{{ asset('storage/' . $dataGeopark->foto) }}"
                                    alt="Foto Keragaman {{ $dataGeopark->nama }}" height="150px" width="150px" />
                            @else
                                <!-- Jika tidak ada gambar, isi foto Default -->
                                <img src="{{ asset('img/gambarKosong.png') }}" alt="Foto Keragaman {{ $dataGeopark->nama }}"
                                    height="150px" width="150px" />
                            @endif
                        </div>

                        <label for="foto" class="block text-lg font-bold text-gray-700 mb-2">Unggah Foto
                            <input type="file" id="foto" name="foto"
                                class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                accept="image/*" />
                            <small class="text-gray-500">Biarkan kosong jika tidak ingin mengubah foto.</small>
                    </div>
                    <!-- Field Deskripsi/Konten -->
                    <div>
                        <label for="thumbnail" class="block text-gray-700 font-bold mb-2">Ringkasan Sejarah (Thumbnail di
                            Halaman Museum Pengunjung)
                            Merangin</label>
                        <textarea name="thumbnail" id="thumbnail" class="summernote">{!! $dataGeopark->thumbnail !!}</textarea>
                    </div>


                    <!-- Field Deskripsi/Konten -->
                    <div>
                        <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Konten Sejarah Geopark
                            Merangin</label>
                        <textarea name="deskripsi" id="deskripsi" class="summernote">{!! $dataGeopark->deskripsi !!}</textarea>
                    </div>

                    <!-- Tombol Update dan Kembali -->
                    <div class="flex justify-between">
                        <button type="submit" id="updateButton"
                            class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Simpan
                        </button>
                        <a href="{{ route('admin.museum') }}"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('updateButton').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form submission

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Pastikan data yang diinput sudah benar!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yakin!',
                cancelButtonText: 'Batalkan',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('updateForm').submit(); // Submit the form
                }
            });
        });
    </script>

@endsection
