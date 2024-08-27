@extends('layouts.app-admin')
@section('title', 'Halaman Edit Tim PUI GEMAR')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Halaman Edit Data TIM PUI GEMAR
            </h2>

            <form id="updateForm" action="{{ route('admin.update-tim', $tim->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-4">
                @csrf
                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required
                        value="{{ old('name', $tim->nama) }}"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <!-- Foto (Gambar) -->
                <div>
                    <label for="foto" class="block text-sm font-medium text-gray-700">Foto lama</label>
                    <input type="hidden" name="foto_lama" value="{{ $tim->foto }}">
                    <div class="foto_lama p-3">


                        @if ($tim->foto)
                            <!-- Jika ada gambar, tampilkan gambar -->
                            <img src="{{ asset('storage/' . $tim->foto) }}" alt="Foto Anggota {{ $tim->nama }}"
                                height="150px" width="150px" />
                        @else
                            <!-- Jika tidak ada gambar, isi foto Default -->
                            <img src="{{ asset('img/fotoKosong.png') }}" alt="Foto Anggota {{ $tim->nama }}"
                                height="150px" width="150px" />
                        @endif

                    </div>

                    <input type="file" id="foto" name="foto"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('foto') }}" />
                    <p class="text-xs text-gray-500 mt-1">
                        Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                    </p>
                </div>

                <!-- Divisi -->
                <div>
                    <label for="divisi_id" class="block text-sm font-medium text-gray-700">Divisi</label>
                    <select id="divisi_id" name="divisi_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                        @foreach ($divisis as $divisi)
                            <option value="{{ $divisi->id }}" {{ $divisi->id == $tim->divisi_id ? 'selected' : '' }}>
                                {{ $divisi->nama_divisi }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Jabatan -->
                <div>
                    <label for="jabatan_id" class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <select id="jabatan_id" name="jabatan_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                        @foreach ($jabatans as $jabatan)
                            <option value="{{ $jabatan->id }}" {{ $jabatan->id == $tim->jabatan_id ? 'selected' : '' }}>
                                {{ $jabatan->nama_jabatan }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Bidang Keahlian -->
                <div class="mt-2">
                    <label for="bidang_keahlian" class="block text-sm font-medium text-gray-700">Bidang Keahlian</label>
                    <input type="text" id="bidang_keahlian" name="bidang_keahlian"
                        placeholder="Masukkan Bidang Keahlian dalam tim/organisasi" required
                        value="{{ old('bidang_keahlian', $tim->bidang_keahlian) }}"
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
