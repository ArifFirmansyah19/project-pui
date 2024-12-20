@extends('layouts.app-admin')
@section('title', 'halaman Edit Kegiatan PUI GEMAR')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16 pl-12">
                <!-- Tambahkan tombol edit disini -->
                <form id="updateForm" action="{{ route('admin.update-kegiatan', $kegiatan->id) }}" method="POST"
                    enctype="multipart/form-data" class="max-w-4xl mx-auto">
                    @csrf
                    <h1 class="text-3xl font-bold mb-4 mt-3 text-indigo-800">
                        Edit kegiatan
                    </h1>

                    <!-- Nama_Kegiatan -->
                    <div class="mb-4">
                        <label for="nama_kegiatan" class="block text-gray-700 text-md font-bold mb-2">Judul</label>
                        <input type="text" id="nama_kegiatan" name="nama_kegiatan" placeholder="Masukkan judul kegiatan"
                            required value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                    </div>

                    <!-- Foto_Kegiatan -->
                    <div class="mb-4">
                        <label for="foto_kegiatan" class="block text-gray-700 text-md font-bold mb-2">Gambar utama
                            kegiatan</label>
                        @if ($kegiatan->foto_kegiatan)
                            <input type="hidden" name="old_foto_kegiatan" value="{{ $kegiatan->foto_kegiatan }}">
                            <div class="mb-4">
                                @if (Str::endsWith($kegiatan->foto_kegiatan, ['jpg', 'jpeg', 'png', 'webp']))
                                    <!-- Menampilkan Gambar -->
                                    <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}"
                                        alt="Gambar Kegiatan {{ $kegiatan->nama_kegiatan }}"
                                        class="mb-2 rounded-lg h-96 w-full object-cover" />
                                @elseif (Str::endsWith($kegiatan->foto_kegiatan, ['mp4', 'avi', 'mov']))
                                    <!-- Menampilkan Video -->
                                    <video controls class="mb-2 rounded-lg h-96 w-full object-cover">
                                        <source src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}"
                                            type="video/{{ pathinfo($kegiatan->foto_kegiatan, PATHINFO_EXTENSION) }}">
                                        Browser Anda tidak mendukung pemutar video.
                                    </video>
                                @endif
                            </div>
                        @endif
                        <input type="file" id="foto_kegiatan" name="foto_kegiatan"
                            accept="image/*,video/mp4,video/avi,video/mov" multiple
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-50 leading-tight focus:outline-none focus:shadow-outline" />
                        <p class="text-gray-600 text-sm mt-1">
                            *Gambar tidak wajib diunggah. <br />
                            *Format yang didukung: JPG, PNG, WebP. Ukuran file maksimal: 2MB.
                        </p>
                    </div>

                    <!-- Deskripsi_Kegiatan -->
                    <div class="mb-4">
                        <label for="deskripsi_kegiatan" class="block text-gray-700 text-md font-bold mb-2">Kegiatan</label>
                        <p class="text-gray-600 text-sm mt-1">
                            *Anda bisa menambahkan banyak gambar dan narasi di sini.

                        </p>
                        <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan"
                            class="summernote bg-white border border-gray-300 rounded-lg p-4">{!! old('deskripsi_kegiatan', $kegiatan->deskripsi_kegiatan) !!}</textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" id="updateButton"
                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan
                        </button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var oldImages = @json($oldImages);
            var summernote = document.getElementsByClassName('summernote');

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
