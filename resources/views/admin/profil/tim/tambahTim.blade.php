@extends('layouts.app-admin')
@section('title', 'halaman tambah Tim admin')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16 pl-12">
                <form action="{{ route('admin.store-tim') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4 max-w-4xl mx-auto">
                    @csrf
                    <h1 class="text-3xl font-bold mb-6 mt-3 text-indigo-800">
                        Tambah Tim
                    </h1>

                    <!-- Dropdown Divisi -->
                    <div>
                        <label for="divisi_id" class="block text-md font-bold text-gray-700">Divisi</label>
                        <select id="divisi_id" name="divisi_id" required onchange="handleAddDivisiOption(this)"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Pilih Divisi </option>
                            @foreach ($divisis as $divisi)
                                <option value="{{ $divisi->id }}">{{ $divisi->nama_divisi }}</option>
                            @endforeach
                            <option value="tambahDivisi" class="text-green-500 font-semibold">
                                + Tambah Divisi
                            </option>
                        </select>
                    </div>

                    <!-- Popup Modal untuk Tambah Divisi -->
                    <div id="popupModal"
                        class="hidden fixed inset-0 items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                        <div class="bg-white p-6 rounded-md shadow-lg">
                            <h2 class="text-lg font-semibold mb-4">
                                Tambah Divisi Baru
                            </h2>
                            <input type="text" id="newDivisi" placeholder="Masukkan nama divisi"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                            <div class="flex justify-center mt-4">
                                <button onclick="closePopup()" class="px-4 py-2 mr-2 text-gray-700">
                                    Batal
                                </button>
                                <button onclick="addDivisi()"
                                    class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-blue-600">
                                    Tambah
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block text-md font-bold text-gray-700">Nama</label>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required
                            class="w-full px-3 py-2 placeholder-gray-400 bg-gray-50 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                    </div>

                    <!-- Foto Anggota Tim -->
                    <div>
                        <label for="foto" class="block text-md font-bold text-gray-700">Foto (unggah gambar)</label>
                        <input type="file" id="foto" name="foto" accept="image/*"
                            class="w-full px-3 py-2 bg-gray-50 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                        <p class="text-xs text-gray-500 mt-1">
                            Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                        </p>
                    </div>

                    <!-- Keanggotaan / Jabatan-->
                    <div>
                        <label for="jabatan" class="block text-md font-bold text-gray-700">Keanggotaan</label>
                        <input type="text" id="jabatan" name="jabatan"
                            placeholder="Masukkan jabatan dalam tim/organisasi"
                            class="w-full px-3 py-2 bg-gray-50 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                    </div>

                    <!-- Bidang Keahlian-->
                    <div>
                        <label for="bidang_keahlian" class="block text-md font-bold text-gray-700">Bidang Keahlian</label>
                        <input type="text" id="bidang_keahlian" name="bidang_keahlian"
                            placeholder="Masukkan bidang keahlian"
                            class="w-full px-3 py-2 bg-gray-50 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                    </div>

                    <!-- Tombol Submit -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:bg-green-700 font-bold">
                            Tambah
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
