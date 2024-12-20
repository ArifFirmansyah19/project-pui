@extends('layouts.app-admin')
@section('title', 'Halaman Edit Tim PUI GEMAR')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16 pl-12">
                <form id="updateForm" action="{{ route('admin.update-tim', $tim->id) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-4 max-w-4xl mx-auto">
                    @csrf
                    <h1 class="text-3xl font-bold mb-6 mt-3 text-indigo-800">
                        Edit Profil Tim
                    </h1>
                    <!-- Divisi -->
                    <div>
                        <label for="divisi_id" class="block text-md font-bold text-gray-700">Divisi</label>
                        <select id="divisi_id" name="divisi_id" onchange="handleAddDivisiOption(this)"
                            class="w-full px-3 py-2 border border-gray-300 bg-gray-50 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                            @foreach ($divisis as $divisi)
                                <option value="{{ $divisi->id }}" {{ $divisi->id == $tim->divisi_id ? 'selected' : '' }}>
                                    {{ $divisi->nama_divisi }}
                                </option>
                            @endforeach
                            <option value="tambahDivisi" class="text-green-500 font-semibold">
                                + Tambah Divisi
                            </option>
                        </select>
                    </div>

                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block text-md font-bold text-gray-700">Nama</label>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required
                            value="{{ old('name', $tim->nama) }}"
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 bg-gray-50 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                    </div>

                    <!-- Foto (Gambar) -->
                    <div>
                        <label for="foto" class="block text-md font-bold text-gray-700">Foto Saat Ini</label>
                        <input type="hidden" name="foto_lama" value="{{ $tim->foto }}">
                        @if ($tim->foto)
                            <!-- Jika ada gambar, tampilkan gambar -->
                            <img src="{{ asset('storage/' . $tim->foto) }}" alt="Foto Anggota {{ $tim->nama }}"
                                class="w-32 h-32 border-2 border-gray-300 mb-4" />
                        @else
                            <!-- Jika tidak ada gambar, isi foto Default -->
                            <img src="{{ asset('img/fotoKosong.png') }}" alt="Foto Anggota {{ $tim->nama }}"
                                class="w-32 h-32 border-2 border-gray-300 mb-4" />
                        @endif
                    </div>

                    <!-- Foto (Gambar Baru) -->
                    <div>
                        <label for="foto" class="block text-md font-bold text-gray-700">Ganti Foto (unggah gambar
                            baru)</label>
                        <input type="file" id="foto" name="foto" accept="image/*"
                            class="w-full px-3 py-2 placeholder-gray-400 bg-gray-50 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500"
                            value="{{ old('foto') }}" />
                        <p class="text-xs text-gray-500 mt-1">
                            Format yang didukung: JPG, PNG, GIF. Ukuran file maksimal:
                            5MB.
                        </p>
                    </div>

                    <!-- Keanggotaan -->
                    <div>
                        <label for="jabatan" class="block text-md font-bold text-gray-700">Keanggotaan</label>
                        <input type="text" id="jabatan" name="jabatan" placeholder="Masukkan nama lengkap" required
                            value="{{ old('jabatan', $tim->jabatan) }}"
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 bg-gray-50 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                    </div>

                    <!-- Bidang Keahlian-->
                    <div>
                        <label for="bidang_keahlian" class="block text-md font-bold text-gray-700">Bidang Keahlian</label>
                        <input type="text" id="bidang_keahlian" name="bidang_keahlian"
                            placeholder="Masukkan bidang keahlian"
                            value="{{ old('bidang_keahlian', $tim->bidang_keahlian) }}"
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 bg-gray-50 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                    </div>
                    <!-- Tombol Submit -->
                    <div class="flex justify-end">
                        <button type="submit" id="updateButton"
                            class="bg-yellow-500 text-white font-bold px-4 py-2 rounded-md hover:bg-yellow-600 focus:outline-none focus:bg-yellow-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Popup Modal untuk Tambah Divisi -->
        <div id="addDivisiModal"
            class="hidden fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-md shadow-lg max-w-md mx-auto">
                <h2 class="text-lg font-semibold mb-4">Tambah Divisi Baru</h2>
                <form action="{{ route('admin.store-divisi') }}" method="POST">
                    @csrf
                    <input type="text" id="nama_divisi" name="nama_divisi" placeholder="Masukkan nama divisi"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                    <div class="flex justify-center mt-4">
                        <button type="button" onclick="closeAddDivisiModal()" class="px-4 py-2 mr-2 text-gray-700">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-blue-600">
                            Tambah
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
        function handleAddDivisiOption(select) {
            if (select.value === 'tambahDivisi') {
                openAddDivisiModal(); // Buka modal
                select.value = ''; // Kosongkan pilihan untuk menghindari modal terus terbuka
            }
        }

        function openAddDivisiModal() {
            document.getElementById('addDivisiModal').classList.remove('hidden');
        }

        function closeAddDivisiModal() {
            document.getElementById('addDivisiModal').classList.add('hidden');
        }
    </script>

@endsection
