@extends('layouts.app-admin')
@section('title', 'halaman Tambah Data Keragaman admin')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="container mx-auto">
                <!-- Dropdown Pilihan Jenis Data -->
                <h2 class="text-3xl font-bold mb-6 text-indigo-900">
                    Edit Kontak Pihak Kedua
                </h2>

                <!-- Formulir Edit -->
                <!-- Formulir Edit -->
                <form id="updateForm" action="{{ route('admin.updateKM', $kontakMuseum->id) }}" method="POST"
                    enctype="multipart/form-data" class="bg-gray-100 p-6 rounded-lg shadow-lg">
                    @csrf
                    <h2 class="text-2xl font-semibold text-indigo-900 mb-6 mt-2">
                        Tambah Kontak Museum
                    </h2>
                    <div class="mb-4">
                        <label for="nama_kontak" class="block text-sm font-medium text-gray-700">Nama Kontak</label>
                        <input type="text" id="nama_kontak" name="nama_kontak"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            value="{{ old('nama_kontak', $kontakMuseum->nama_kontak) }}" placeholder="Masukkan nama kontak"
                            required />
                    </div>
                    <div class="mb-4">
                        <label for="telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
                        <input type="text" id="telepon" name="telepon"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            value="{{ old('telepon', $kontakMuseum->telepon) }}" placeholder="Masukkan nomor telepon"
                            required />
                        <p class="text-gray-600 text-sm mt-1">
                            *Format nomor dimulai dari 62 xxx xxx
                        </p>
                    </div>
                    <div class="mb-4">
                        <label for="whatsapp" class="block text-sm font-medium text-gray-700">Whatsapp</label>
                        <input type="text" id="whatsapp" name="whatsapp"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            value="{{ old('whatsapp', $kontakMuseum->whatsapp) }}" placeholder="Masukkan nomor Whatsapp"
                            required />
                        <p class="text-gray-600 text-sm mt-1">
                            *Format nomor dimulai dari 62 xxx xxx
                        </p>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            value="{{ old('email', $kontakMuseum->email) }}" placeholder="Masukkan email" required />
                    </div>
                    <div class="mb-4">
                        <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram</label>
                        <input type="text" id="instagram" name="instagram"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            value="{{ old('instagram', $kontakMuseum->instagram) }}"
                            placeholder="Masukkan akun Instagram" />
                        <p class="text-gray-600 text-sm mt-1">
                            *Masukkan link profil instagram yang valid
                        </p>
                    </div>
                    <div class="mb-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" id="alamat" name="alamat"
                            value="{{ old('alamat', $kontakMuseum->alamat) }}"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Masukkan alamat"
                            required />
                    </div>
                    <!-- Tombol Update dan Kembali -->
                    <div class="flex justify-between mt-4">
                        <button type="submit" id="updateButton"
                            class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700">
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
