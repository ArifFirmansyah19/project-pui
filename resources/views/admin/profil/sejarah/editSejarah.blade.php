@extends('layouts.app-admin')
@section('title', 'halaman Edit Konten Sejarah PUI GEMAR')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16 pl-12">
                <!-- Form Edit Konten Sejarah -->
                <form id="updateForm" action="{{ route('admin.update-sejarah', $sejarah->id) }}" method="POST"
                    enctype="multipart/form-data" class="max-w-4xl mx-auto">
                    @csrf
                    <h1 class="text-2xl sm:text-3xl font-bold mb-4 mt-3 text-indigo-800">
                        Edit Sejarah
                    </h1>
                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 text-md font-bold mb-2">Judul</label>
                        <input type="text" id="judul" name="judul" placeholder="Masukkan judul konten" required
                            value="{{ old('judul', $sejarah->judul) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-50 leading-tight focus:outline-none focus:shadow-outline" />
                    </div>
                    <div class="mb-4">
                        <label for="foto_konten_sejarah" class="block text-gray-700 text-md font-bold mb-2">Gambar
                            Sejarah (Opsional)</label>
                        <input type="hidden" name="foto_lama" value="{{ $sejarah->foto_konten_sejarah }}">

                        @if (!empty($sejarah->foto_konten_sejarah))
                            <div class="foto_lama p-3">
                                <img src="{{ asset('storage/' . $sejarah->foto_konten_sejarah) }}"
                                    alt="Foto {{ $sejarah->judul }}" height="300px" width="300px">
                            </div>
                        @endif

                        <input type="file" id="foto_konten_sejarah" name="foto_konten_sejarah" accept="image/*"
                            class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-50 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            value="{{ old('foto_konten_sejarah', $sejarah->foto_konten_sejarah) }}" />
                        <p class="text-gray-600 text-sm mt-1">
                            Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                        </p>
                    </div>
                    <div class="mb-4">
                        <label for="isi_sejarah" class="block text-gray-700 text-md font-bold mb-2">Konten Sejarah PUI
                            GEMAR</label>
                        <p class="text-xs text-gray-500 mt-1">
                            Usahakan deskripsi sejarah tidak mengandung gambar.
                        </p>
                        <textarea name="isi_sejarah" id="isi_sejarah" class="summernote">{!! old('isi_sejarah', $sejarah->isi_sejarah) !!}</textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" id="updateButton"
                            class="bg-yellow-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
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
@endsection
