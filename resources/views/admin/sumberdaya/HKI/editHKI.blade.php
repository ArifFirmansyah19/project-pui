@extends('layouts.app-admin')
@section('title', 'halaman Edit HKI admin')
@section('content-admin')
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto mx-3">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16 pl-12">
                <form id="updateForm" action="{{ route('admin.update-HKI', $HKI->id) }}" method="POST"
                    enctype="multipart/form-data" class="max-w-4xl mx-auto">
                    @csrf
                    <h1 class="text-2xl sm:text-3xl font-bold mb-4 mt-3 text-indigo-800">
                        Edit HKI
                    </h1>
                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 text-md font-bold mb-2">Judul
                        </label>
                        <input type="text" id="judul" name="judul" value="{{ old('judul', $HKI->judul) }}"
                            placeholder="Nama HKI sebelumnya" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                    </div>
                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 text-md font-bold mb-2">Nama Pencipta
                        </label>
                        <input id="nama" name="nama"
                            value="{{ old('nama', $HKI->nama) }}"placeholder="Nama HKI sebelumnya" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                    </div>
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-gray-700 text-md font-bold mb-2">Deskripsi Singkat
                            HKI</label>
                        <!-- Summernote Editor -->
                        <textarea name="deskripsi" placeholder="Masukkan deskripsi dari HKI" required class="summernote">{!! $HKI->deskripsi !!}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="document" class="block text-gray-700 text-md font-bold mb-2">Dokumen (PDF)</label>

                        <!-- Existing Document Link -->
                        @if (isset($HKI->file_path))
                            <div class="mb-2">
                                <p class="text-gray-600">Dokumen saat ini:</p>
                                <a href="{{ asset('storage/hkiFiles/' . basename($HKI->file_path)) }}" target="_blank"
                                    class="text-blue-500 underline" target="_blank">Lihat
                                    Dokumen</a>

                                <!-- Field input tipe hidden untuk menyimpan path file lama -->
                                <input type="hidden" name="old_file_path" value="{{ $HKI->file_path }}">
                            </div>
                        @endif


                        <input type="file" id="file_path" name="file_path"
                            class="w-full border-gray-300 p-2 bg-gray-50 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
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

@endsection
