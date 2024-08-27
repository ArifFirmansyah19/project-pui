@extends('layouts.app-admin')
@section('title', 'halaman tim admin')
@section('content-admin')

    {{-- allert berhasil simpan data artikel, update --}}
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
            <h1 class="text-4xl font-bold text-indigo-900 mb-14">Data Tim PUI GEMAR</h1>
            <!-- Konten 1 -->
            <div class="team-section">
                <br><br>
                <h2 class="text-2xl font-bold text-indigo-900 mb-5 ml-4">
                    Daftar Divisi yang tersedia

                    @if ($divisis->isEmpty())
                        <ul class="list-disc list-inside">
                            <p class="text-gray-600">Tidak ada divisi yang tersedia</p>
                        @else
                            @foreach ($divisis as $divisi)
                                <li>{{ $divisi->nama_divisi }}</li>
                            @endforeach
                        </ul>
                    @endif
            </div>

            <!-- Data Jabatan -->
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-2">Jabatan</h2>
                @if ($jabatans->isEmpty())
                    <p class="text-gray-600">No Jabatan data available.</p>
                @else
                    <ul class="list-disc list-inside">
                        @foreach ($jabatans as $jabatan)
                            <li>{{ $jabatan->nama_jabatan }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>


            @if ($dataTimPui->isEmpty())
                <h1 class="text-4xl font-bold text-indigo-900 mt-20 mb-4">Team PUI GEMAR</h1>
                <p class="text-gray-600">No Employee data available.</p>
            @else
                <div class="team-section">
                    <h1 class="text-4xl font-bold text-indigo-900 mt-20 mb-4">Team PUI GEMAR</h1>
                    @foreach ($groupedTims as $divisiName => $dataTimPui)
                        <h2 class="text-2xl font-bold text-indigo-900 mt-10 mb-5 ml-4">{{ $divisiName }}</h2>
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
                                        <img src="{{ asset('img/fotoKosong.png') }}" alt="Foto Anggota {{ $tim->nama }}"
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

                                            <form class="delete-form" action="{{ route('admin.destroy-tim', $tim->id) }}"
                                                method="POST">
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
                </div>
            @endif


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
    </script>

@endsection
