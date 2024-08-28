@extends('layouts.app-admin')
@section('title', 'halaman tim admin')
@section('content-admin')

    {{-- allert berhasil simpan data tim, update --}}
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success'
                });
            });
        </script>
    @endif

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="flex justify-start mb-14">
                <p>Pilih Data Untuk Ditampilkan: </p>
                <select id="dataOption"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="divisi">Divisi</option>
                    <option value="jabatan">Jabatan</option>
                    <option value="tim">Tim</option>
                </select>
            </div>

            <h1 id="pageTitle" class="text-4xl font-bold text-indigo-900 mb-5">Data Divisi PUI GEMAR</h1>

            <!-- Konten 1 -->
            <div class="team-section">
                <!-- Kontainer Divisi -->
                <div id="divisiSection" class="data-section">
                    <h2 class="text-xl font-bold mb-2">Daftar Divisi</h2>

                    @if ($divisis->isEmpty())
                        <p class="text-gray-600">No divisi data available.</p>
                    @else
                        <!-- Tabel -->
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                            <thead>
                                <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-center">No.</th>
                                    <th class="py-3 px-6 text-center">Nama Divisi</th>
                                    <th class="py-3 px-6 text-center">Deskripsi</th>
                                    <th class="py-3 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="data-table-body" class="text-gray-600 text-sm font-light">
                                @php $no = 1; @endphp
                                @foreach ($divisis as $divisi)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-center">{{ $no++ }}.</td>
                                        <td class="py-3 px-6 text-center">{{ $divisi->nama_divisi }}</td>
                                        <td class="py-3 px-6 text-center">{{ $divisi->deskripsi_divisi }}
                                        </td>

                                        <td class="py-3 px-6 text-center">
                                            <div class="flex justify-center">
                                                <form class="delete-form"
                                                    action="{{ route('admin.destroy-divisi', $divisi->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="delete-button mx-2">
                                                        <i class="fa-solid fa-trash text-red-600 hover:text-gray-900"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                    @endif
                    </tbody>
                    </table>
                </div>

                <!-- Data Jabatan -->
                <div id="jabatanSection" class="data-section" style="display:none;">
                    <div class="mb-2">
                        <h2 class="text-xl font-bold mb-2">Jabatan</h2>
                        @if ($jabatans->isEmpty())
                            <p class="text-gray-600">No Jabatan data available.</p>
                        @else
                            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                                <thead>
                                    <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-center">No.</th>
                                        <th class="py-3 px-6 text-center">Nama Jabatan</th>
                                        <th class="py-3 px-6 text-center">Divisi</th>
                                        <th class="py-3 px-6 text-center">Deskripsi</th>
                                        <th class="py-3 px-6 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="data-table-body" class="text-gray-600 text-sm font-light">
                                    @php $no = 1; @endphp
                                    @foreach ($jabatans->groupBy('divisi_id') as $divisiId => $jabatansInDivisi)
                                        @foreach ($jabatansInDivisi as $jabatan)
                                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                                <td class="py-3 px-6 text-center">{{ $no++ }}.</td>
                                                <td class="py-3 px-6 text-center">{{ $jabatan->nama_jabatan }}</td>
                                                <td class="py-3 px-6 text-center">{{ $jabatan->divisi->nama_divisi }}</td>
                                                <td class="py-3 px-6 text-center">{{ $jabatan->deskripsi_jabatan }}</td>
                                                <td class="py-3 px-6 text-center">
                                                    <div class="flex justify-center">
                                                        <form class="delete-form"
                                                            action="{{ route('admin.destroy-jabatan', $jabatan->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="delete-button mx-2">
                                                                <i
                                                                    class="fa-solid fa-trash text-red-600 hover:text-gray-900"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>


                <div id="timSection" class="data-section" style="display:none;">
                    @if ($dataTimPui->isEmpty())
                        <p class="text-gray-600">No Employee data available.</p>
                    @else
                        @foreach ($groupedTims as $divisiName => $dataTimPui)
                            <h2 class="text-xl font-bold mb-2">{{ $divisiName }}</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-10 ml-4">

                                @foreach ($dataTimPui as $tim)
                                    <!-- Team member 1 -->
                                    <div
                                        class="team-member bg-white shadow-md transform transition duration-300 hover:scale-105">
                                        <!-- Gambar -->
                                        <!-- Memeriksa apakah ada gambar tim -->
                                        @if ($tim->foto)
                                            <!-- Jika ada gambar, tampilkan gambar -->
                                            <img src="{{ asset('storage/' . $tim->foto) }}"
                                                alt="Foto Anggota {{ $tim->nama }}"
                                                style="width:auto; height:100px; padding:10px" />
                                        @else
                                            <!-- Jika tidak ada gambar, isi foto Default -->
                                            <img src="{{ asset('img/fotoKosong.png') }}"
                                                alt="Foto Anggota {{ $tim->nama }}"
                                                style="width:auto; height:100px; padding:10px" />
                                        @endif

                                        <!-- Konten -->
                                        <div class="p-4">
                                            <h3 class="text-xl text-center font-semibold text-gray-800 mb-2">
                                                {{ $tim->nama }}
                                            </h3>
                                            <p class="text-gray-600 text-center">{{ $tim->jabatan->nama_jabatan }}</p>

                                            <div class="flex justify-center mt-4">
                                                <a href="{{ route('admin.edit-tim', $tim->id) }}">
                                                    <button class="mx-2 text-gray-600 hover:text-gray-900">
                                                        <i class="fas fa-edit" style="color: #ea7434;"></i>
                                                    </button>
                                                </a>

                                                <form class="delete-form"
                                                    action="{{ route('admin.destroy-tim', $tim->id) }}" method="POST">
                                                    @csrf
                                                    <button type="button" id="delete" data-id="{{ $tim->id }}"
                                                        class="delete-button mx-2 text-gray-600 hover:text-gray-900">
                                                        <i class="fa-solid fa-trash text-red-600 hover:text-gray-900"></i>
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>


            <!-- Floating Action Button -->
            <button id="tambahButton"
                class="add-button fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
                aria-label="Tambah Tim">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
    </main>
    </div>

    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form'); // Temukan formulir terdekat dari tombol
                const timId = this.getAttribute('data-id');
                event.preventDefault(); // Cegah tindakan default

                Swal.fire({
                    title: 'Apakah Anda yakin ingin menghapus?',
                    text: "Anda tidak akan dapat mengembalikan artikel ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Hapus!',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Kirim formulir penghapusan
                    }
                });
            });
        });

        document.getElementById('tambahButton').addEventListener('click', function() {
            Swal.fire({
                title: 'Pilih yang Ingin Ditambahkan',
                showCancelButton: true,
                showDenyButton: false,
                showConfirmButton: false,
                showCloseButton: true,
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'bg-blue-500 text-white px-4 py-2 rounded',
                    cancelButton: 'bg-red-500 text-white px-4 py-2 rounded',
                    denyButton: 'bg-yellow-500 text-white px-4 py-2 rounded'
                },
                html: `
            <div class="container-button-option mt-2">
                <button onclick="location.href='{{ route('admin.create-tim') }}'"
                    class="bg-blue-900 text-white px-4 py-2 mb-3 rounded w-[200px] ">Tambah Tim</button>
                <br>
                <button onclick="location.href='{{ route('admin.create-divisi') }}'"
                    class="bg-blue-900 text-white px-4 py-2 mb-3 rounded w-[200px] ">Tambah Divisi</button>
                <br>
                <button onclick="location.href='{{ route('admin.create-jabatan') }}'"
                    class="bg-blue-900 text-white px-4 py-2 rounded w-[200px] ">Tambah Jabatan</button>
            </div>
                   `,
                cancelButtonText: 'Batal'
            });
        });

        document.getElementById('dataOption').addEventListener('change', function() {
            const selectedOption = this.value;
            const selectedOptionText = this.options[this.selectedIndex].text;

            // Sembunyikan semua section
            document.getElementById('divisiSection').style.display = 'none';
            document.getElementById('jabatanSection').style.display = 'none';
            document.getElementById('timSection').style.display = 'none';

            // Tampilkan section yang dipilih
            if (selectedOption === 'divisi') {
                document.getElementById('divisiSection').style.display = 'block';
            } else if (selectedOption === 'jabatan') {
                document.getElementById('jabatanSection').style.display = 'block';
            } else if (selectedOption === 'tim') {
                document.getElementById('timSection').style.display = 'block';
            }

            // Update teks pada elemen <h1> sesuai dengan value yang dipilih
            document.getElementById('pageTitle').textContent = `Data ${selectedOptionText} PUI GEMAR`;
        });
    </script>

@endsection
