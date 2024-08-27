@extends('layouts.app-admin')
@section('title', 'halaman edit struktur organisasi admin')
@section('content-admin')

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16">
                <h1 class="text-3xl font-bold mb-4">Edit Foto Struktur Organisasi</h1>

                <!-- Form Edit Foto Struktur Organisasi -->
                <form id="updateForm" action="{{ route('admin.update-SO', $strukturOrganisasi->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Foto (Gambar) Struktur Organisasi -->
                    <div>
                        <label for="foto_struktur_organisasi" class="block text-sm font-medium text-gray-700">
                            Foto lama
                        </label>
                        <input type="hidden" name="foto_lama" value="{{ $strukturOrganisasi->foto_struktur_organisasi }}">
                        <div class="foto_lama p-3">
                            <img src="{{ asset('storage/' . $strukturOrganisasi->foto_struktur_organisasi) }}"
                                alt="Foto Struktur Organisasi" height="300px" width="300px">
                        </div>

                        <input type="file" id="foto_struktur_organisasi" name="foto_struktur_organisasi"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500"
                            value="{{ old('foto_struktur_organisasi') }}" onchange="validateFileSize(this)" />
                        <p class="text-xs text-gray-500 mt-1">
                            Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                        </p>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" id="updateButton"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
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
@endsection
