@extends('layouts.app-admin')
@section('title', 'halaman Edit HKI admin')
@section('content-admin')

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Form Edit Data HKI PUI GEMAR
            </h2>

            <form id="updateForm" action="{{ route('admin.update-HKI', $HKI->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-4">
                @csrf
                <!-- Judul HKI -->
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700">Judul HKI</label>
                    <input type="text" id="judul" name="judul" placeholder="Masukkan judul HKI" required
                        value="{{ old('judul', $HKI->judul) }}"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <!-- Nama Pemilik HKI -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Pemilik HKI</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama pemilik HKI" required
                        value="{{ old('nama', $HKI->nama) }}"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>


                <!-- deskripsi HKI -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi HKI</label>
                    <textarea id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi dari HKI" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">{!! $HKI->deskripsi !!}</textarea>
                </div>


                <!-- File_path HKI -->
                <div>
                    <label for="file_path" class="block text-sm font-medium text-gray-700">File HKI (PDF)</label>
                    <!-- Menampilkan link ke file PDF lama -->
                    @if (isset($HKI->file_path))
                        <a href="{{ asset('storage/hkiFiles/' . basename($HKI->file_path)) }}" target="_blank"
                            class="block text-blue-600 hover:underline">
                            Lihat File PDF Lama
                        </a>

                        <!-- Field input tipe hidden untuk menyimpan path file lama -->
                        <input type="hidden" name="old_file_path" value="{{ $HKI->file_path }}">
                    @endif

                    <!-- Input untuk mengunggah file PDF baru -->
                    <input type="file" id="file_path" name="file_path" accept="application/pdf"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
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

@endsection
