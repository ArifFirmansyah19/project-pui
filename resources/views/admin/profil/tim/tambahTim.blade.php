@extends('layouts.app-admin')
@section('title', 'halaman tambah Tim admin')
@section('content-admin')

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Formulir Pendaftaran Anggota Tim PUI GEMAR
            </h2>

            {{-- form untuk mengisi data tambah tim PUI GEMAR --}}
            <form action="{{ route('admin.store-tim') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <!-- Foto (Gambar) -->
                <div>
                    <label for="foto" class="block text-sm font-medium text-gray-700">Foto (unggah gambar)</label>
                    <input type="file" id="foto" name="foto" {{-- accept="image/*" --}}
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                    <p class="text-xs text-gray-500 mt-1">
                        Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                    </p>
                </div>

                {{-- {{-- Divisi_id --}}
                <div>
                    <label for="divisi_id" class="block text-sm font-medium text-gray-700">Divisi PUI GEMAR</label>
                    <select id="divisi_id" name="divisi_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Pilih Divisi: </option>
                        @foreach ($divisis as $divisi)
                            <option value="{{ $divisi->id }}">{{ $divisi->nama_divisi }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- jabatan_id --}}
                <div>
                    <label for="jabatan_id" class="block text-sm font-medium text-gray-700">Jabatan di Dalam Divisi</label>
                    <select id="jabatan_id" name="jabatan_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Pilih Jabatan Divisi: </option>
                        @foreach ($jabatans as $jabatan)
                            <option value="{{ $jabatan->id }}" data-divisi="{{ $jabatan->divisi_id }}">
                                {{ $jabatan->nama_jabatan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Bidang Keahlian -->
                <div>
                    <label for="bidang_keahlian" class="block text-sm font-medium text-gray-700">Bidang Keahlian</label>
                    <input type="text" id="bidang_keahlian" name="bidang_keahlian"
                        placeholder="Masukkan Bidang Keahlian dalam tim/organisasi" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const divisiSelect = document.getElementById('divisi_id');
            const jabatanSelect = document.getElementById('jabatan_id');

            divisiSelect.addEventListener('change', function() {
                const selectedDivisiId = this.value;

                // Looping melalui opsi jabatan dan menampilkan/menyembunyikannya berdasarkan divisi_id
                Array.from(jabatanSelect.options).forEach(option => {
                    option.style.display = (option.getAttribute('data-divisi') ===
                        selectedDivisiId || !selectedDivisiId) ? 'block' : 'none';
                });

                // Reset jabatan yang terseleksi jika divisi diubah
                jabatanSelect.value = '';
            });
        });
    </script>

@endsection
