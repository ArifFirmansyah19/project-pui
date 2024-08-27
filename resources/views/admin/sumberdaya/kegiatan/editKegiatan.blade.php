@extends('layouts.app-admin')
@section('title', 'halaman Edit Kegiatan PUI GEMAR')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Halaman Edit Kegiatan TIM PUI GEMAR
            </h2>

            <form id="updateForm" action="{{ route('admin.update-kegiatan', $kegiatan->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Nama_Kegiatan -->
                <div>
                    <label for="nama_kegiatan" class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                    <input type="text" id="nama_kegiatan" name="nama_kegiatan"
                        placeholder="Masukkan nama kegiatan lengkap" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}" />
                    @error('nama_kegiatan')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Foto Kegiatan -->
                <div>
                    <label for="foto_kegiatan" class="block text-sm font-medium text-gray-700">Foto Kegiatan
                        (Opsional)</label>
                    @if ($kegiatan->foto_kegiatan)
                        <input type="hidden" name="old_foto_kegiatan" value="{{ $kegiatan->foto_kegiatan }}">
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}" height="150px" width="150px"
                                alt="foto {{ $kegiatan->nama_kegiatan }}" class="object-cover">
                        </div>
                    @endif
                    <input type="file" id="foto_kegiatan" name="foto_kegiatan"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                    <p class="text-xs text-gray-500 mt-1">
                        Format yang didukung: JPG, PNG, WebP. Ukuran file maksimal: 2MB.
                    </p>
                    @error('foto_kegiatan')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Deskripsi Kegiatan -->
                <div>
                    <label for="deskripsi_kegiatan" class="block text-sm font-medium text-gray-700">Deskripsi
                        Kegiatan</label>
                    <p class="text-xs text-gray-500 mt-1">
                        Usahakan deskripsi kegiatan tidak mengandung gambar.
                    </p>
                    <textarea name="deskripsi_kegiatan" id="summernote"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                        {!! old('deskripsi_kegiatan', $kegiatan->deskripsi_kegiatan) !!}
                    </textarea>
                    @error('deskripsi_kegiatan')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end">
                    <button type="submit" id="updateButton"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                        Update
                    </button>
                </div>
            </form>


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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var oldImages = @json($oldImages);
            var summernote = document.getElementById('summernote');

            // Tambahkan input hidden untuk setiap gambar lama
            oldImages.forEach(function(image) {
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'old_images[]';
                input.value = image;
                summernote.parentElement.appendChild(input);
            });
        });
    </script>

@endsection
