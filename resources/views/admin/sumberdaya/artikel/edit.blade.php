@extends('layouts.app-admin')
@section('title', 'Halaman Edit Artikel Admin')
@section('content-admin')

    <main class="flex-1 bg-gray-50 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16 pl-12">
                <!-- Tambahkan tombol edit disini -->
                <form id="updateForm" action="{{ route('admin.update-artikel', $article->id) }}" method="POST"
                    enctype="multipart/form-data" class="max-w-4xl mx-auto">
                    @csrf
                    <h1 class="text-2xl sm:text-3xl font-bold mb-4 mt-3 text-indigo-800">
                        Edit Artikel
                    </h1>

                    <!-- Judul -->
                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 text-md font-bold mb-2">
                            Judul
                        </label>
                        <input type="text" id="judul" name="judul" placeholder="Masukkan judul konten" required
                            value="{{ old('judul', $article->judul) }}"
                            class="shadow appearance-none border rounded bg-gray-50 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                    </div>

                    <!-- Penulis -->
                    <div class="mb-4">
                        <label for="penulis" class="block text-gray-700 text-md font-bold mb-2">
                            Penulis
                        </label>
                        <input type="text" id="penulis" name="penulis" placeholder="Masukkan penulis konten" required
                            value="{{ old('penulis', $article->penulis) }}"
                            class="shadow appearance-none border rounded bg-gray-50 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                    </div>

                    <!-- Gambar Utama Artikel -->
                    <div class="mb-4">
                        <label for="foto_artikel" class="block text-gray-700 text-md font-bold mb-2">
                            Gambar utama artikel
                        </label>
                        @if ($article->foto_artikel)
                            <input type="hidden" name="old_foto_artikel" value="{{ $article->foto_artikel }}">
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $article->foto_artikel) }}" height="150" width="150"
                                    class="object-cover">
                            </div>
                        @endif
                        @if (!$article->foto_artikel)
                            <p id="foto_artikel-info" class="text-gray-600 text-sm mt-1">Tidak ada foto artikel sebelumnya
                            </p>
                        @endif
                        <input type="file" id="foto_artikel" name="foto_artikel" accept="foto_artikel/*"
                            class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-50 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                        <p class="text-xs text-gray-500 mt-1">Format yang didukung: JPG, PNG, WebP. Ukuran file maksimal:
                            2MB.
                        </p>
                    </div>

                    <!-- Abstrak -->
                    <div class="mb-4">
                        <label for="abstract" class="block text-gray-700 text-md font-bold mb-2">
                            Abstrak
                        </label>
                        <textarea name="abstract" id="abstract" class="summernote" class="bg-white border border-gray-300 rounded-lg p-4">{!! old('abstract', $article->abstract) !!}</textarea>

                    </div>

                    <!-- Link Jurnal -->
                    <div class="mb-4">
                        <label for="file_path" class="block text-gray-700 text-md font-bold mb-2">
                            Link Jurnal
                        </label>
                        <input type="url" id="file_path" name="file_path" placeholder="Masukkan link jurnal"
                            value="{{ old('file_path', $article->file_path) }}"
                            class="shadow appearance-none bg-gray-50
                            border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none
                            focus:shadow-outline" />
                        <p class="text-gray-600 text-sm mt-1">
                            *Tambahkan link ke jurnal
                        </p>
                    </div>

                    <!-- Tombol Simpan -->
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
        document.getElementById('updateButton').addEventListener('click', function() {
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
                    document.getElementById('updateForm').submit();

                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data artikel Anda berhasil diperbarui.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>
    <!-- Tambahkan input hidden untuk old_images -->
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
