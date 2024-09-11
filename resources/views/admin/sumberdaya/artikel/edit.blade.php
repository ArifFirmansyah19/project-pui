@extends('layouts.app-admin')
@section('title', 'Halaman Edit Artikel Admin')
@section('content-admin')
    <main class="flex-1 bg-gray-100 p-4 sm:p-6">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h1 class="text-4xl font-bold text-indigo-900 mb-8 mt-20">
                Halaman Edit Artikel
            </h1>

            <form id="updateForm" action="{{ route('admin.update-artikel', $article->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Judul Artikel -->
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700">Masukkan Judul Artikel</label>
                    <input type="text" id="judul" name="judul" placeholder="Masukkan judul artikel" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('judul', $article->judul) }}" />
                    @error('judul')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Penulis -->
                <div>
                    <label for="penulis" class="block text-sm font-medium text-gray-700">Nama Penulis Artikel</label>
                    <input type="text" id="penulis" name="penulis" placeholder="Masukkan nama penulis artikel" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('penulis', $article->penulis) }}" />
                    @error('penulis')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Foto Artikel -->
                <div>
                    <label for="foto_artikel" class="block text-sm font-medium text-gray-700">Foto (unggah gambar) :
                        Opsional</label>
                    @if ($article->foto_artikel)
                        <input type="hidden" name="old_foto_artikel" value="{{ $article->foto_artikel }}">
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $article->foto_artikel) }}" height="150" width="150"
                                class="object-cover">
                        </div>
                    @endif
                    <input type="file" id="foto_artikel" name="foto_artikel"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                    <p class="text-xs text-gray-500 mt-1">Format yang didukung: JPG, PNG, WebP. Ukuran file maksimal: 2MB.
                    </p>
                    @error('foto_artikel')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- File Path -->
                <div>
                    <label for="file_path" class="block text-sm font-medium text-gray-700">Link Artikel</label>
                    <input type="url" id="file_path" name="file_path" placeholder="Masukkan nama file_path artikel"
                        required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('file_path', $article->file_path) }}" />
                    @error('file_path')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Abstract Artikel -->
                <div>
                    <label for="abstract" class="block text-sm font-medium text-gray-700">Isi Artikel</label>
                    <textarea name="abstract" id="summernote"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                        {!! old('abstract', $article->abstract) !!}
                    </textarea>
                    @error('abstract')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                        Simpan
                    </button>
                </div>
            </form>


            <!-- Floating Action Button -->
            <a href="{{ route('admin.artikel') }}">
                <button
                    class="fixed bottom-4 left-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
                    aria-label="Kembali">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
            </a>
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
