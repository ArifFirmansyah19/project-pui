@extends('layouts.app-admin')
@section('title', 'halaman edit struktur organisasi admin')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16 pl-12">
                <!-- Form Edit Konten Sejarah -->
                <form id="updateForm" action="{{ route('admin.update-SO', $strukturOrganisasi->id) }}" method="POST"
                    enctype="multipart/form-data" class="max-w-4xl mx-auto">
                    @csrf
                    <h1 class="text-xl sm:text-3xl font-bold mb-4 mt-3 text-indigo-800">
                        Edit Struktur Organisasi
                    </h1>

                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 text-md font-bold mb-2">Judul</label>
                        <input type="text" id="judul" name="judul" placeholder="Masukkan judul konten" required
                            value="{{ old('judul', $strukturOrganisasi->judul) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-50 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                    </div>
                    <div class="mb-4">
                        <label for="foto_struktur_organisasi" class="block text-gray-700 text-md font-bold mb-2">Gambar
                            Struktur
                            Organisasi</label>
                        <input type="hidden" name="foto_lama" value="{{ $strukturOrganisasi->foto_struktur_organisasi }}">
                        <div class="foto_lama p-3">
                            <img src="{{ asset('storage/' . $strukturOrganisasi->foto_struktur_organisasi) }}"
                                alt="Foto Struktur Organisasi" height="300px" width="300px">
                        </div>
                        <input type="file" id="foto_struktur_organisasi" name="foto_struktur_organisasi" accept="image/*"
                            class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-50 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            value="{{ old('foto_struktur_organisasi') }}" onchange="validateFileSize(this)" />
                        <p class="text-gray-600 text-sm mt-1">
                            Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                        </p>
                    </div>
                    <!--isi konten -->
                    <div class="mb-4">
                        <label for="isi_konten" class="block text-gray-700 text-md font-bold mb-2">Konten Sejarah PUI
                            GEMAR</label>
                        <p class="text-xs text-gray-500 mt-1">
                            Usahakan deskripsi sejarah tidak mengandung gambar.
                        </p>
                        <textarea name="isi_konten" id="isi_konten" class="summernote">{!! old('isi_konten', $strukturOrganisasi->isi_konten) !!}</textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" id="updateButton"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
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

        function validateFileSize(input) {
            const file = input.files[0];
            if (file && file.size > 2 * 1024 * 1024) { // 2MB dalam byte
                alert("Ukuran file tidak boleh lebih dari 2MB.");
                input.value = ""; // Reset input file
            }
        }
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
