@extends('layouts.app-admin')
@section('title', 'halaman Edit konten Museum Geowisata Merangin')
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
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Museum PUI GEMAR UNJA
            </h2>
            <form id="filterForm" action="{{ route('admin.museum') }}" method="GET">
                <div class="flex justify-start">
                    <p>Pilih jenis data museum</p>
                    <select id="mySelectWithOptions" name="jenis_keragaman"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500"
                        onchange="document.getElementById('filterForm').submit()">
                        <option value="" disabled {{ request('jenis_keragaman') == '' ? 'selected' : '' }}>Pilih
                            opsi...</option>
                        @foreach ($jenisKeragamans as $jenisKeragaman)
                            <option value="{{ $jenisKeragaman->id }}"
                                {{ request('jenis_keragaman') == $jenisKeragaman->id ? 'selected' : '' }}>
                                {{ $jenisKeragaman->jenis_keragaman }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
            <br>

            <!-- Judul Tabel -->
            <h2 id="table-title" class="text-2xl font-bold text-gray-800 mb-4">
                Data {{ $selectedJenis ? $jenisKeragamans->find($selectedJenis)->jenis_keragaman : 'Keseluruhan' }}
            </h2>

            <!-- Tabel -->
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead>
                    <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-center">No.</th>
                        <th class="py-3 px-6 text-center">Nama Keragaman</th>
                        <th class="py-3 px-6 text-center">Foto</th>
                        <th class="py-3 px-6 text-center">Deskripsi</th>
                        <th class="py-3 px-6 text-center">Lokasi</th>
                        <th class="py-3 px-6 text-center">Umur</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="data-table-body" class="text-gray-600 text-sm font-light">
                    @php $no = 1; @endphp
                    @forelse ($dataKeragamans as $dataKeragaman)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-center">{{ $no++ }}.</td>
                            <td class="py-3 px-6 text-center">{{ $dataKeragaman->nama }}</td>
                            <td class="py-3 px-6 text-center">
                                <!-- Memeriksa apakah ada foto_keragaman -->
                                @if ($dataKeragaman->foto_keragaman)
                                    <!-- Jika ada gambar, tampilkan gambar -->
                                    <img src="{{ asset('storage/' . $dataKeragaman->foto_keragaman) }}"
                                        alt="Foto Keragaman {{ $dataKeragaman->nama }}"
                                        style="width:200px; height:200px" />
                                @else
                                    <!-- Jika tidak ada gambar, isi foto Default -->
                                    <img src="{{ asset('img/gambarKosong.png') }}"
                                        alt="Foto Keragaman {{ $dataKeragaman->nama }}"
                                        style="width:200px; height:200px" />
                                @endif

                            </td>
                            <td class="py-3 px-6 text-center">{!! $dataKeragaman->deskripsi !!}</td>
                            <td class="py-3 px-6 text-center">{{ $dataKeragaman->lokasi }}</td>
                            <td class="py-3 px-6 text-center">{{ $dataKeragaman->umur }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex justify-center">
                                    <a href="{{ route('admin.editDK', $dataKeragaman->id) }}">
                                        <button class="mx-2 hover:text-gray-900">
                                            <i class="fas fa-edit" style="color: #ea7434;"></i>
                                        </button>
                                    </a>
                                    <form class="delete-form" action="{{ route('admin.destroyDK', $dataKeragaman->id) }}"
                                        method="POST">
                                        @csrf
                                        <button type="button" data-id="" class="delete-button mx-2">
                                            <i class="fa-solid fa-trash text-red-600 hover:text-gray-900"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-3 px-6 text-center text-gray-500">
                                Data tidak tersedia untuk jenis keragaman yang dipilih.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <button id="tambahButton"
            class="add-button fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
            aria-label="Tambah Keragaman">
            <i class="fa-solid fa-plus"></i>
        </button>
    </main>

    <script>
        // pop up untuk memunculkan menu create desa, create UMKM dan create Produk UMKM dari tombol tambahButton
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
                <button onclick="location.href='{{ route('admin.createJK') }}'"
                    class="bg-blue-900 text-white px-4 py-2 mb-3 rounded w-[200px] ">Input Jenis Keragaman</button>
                <br>
                <button onclick="location.href='{{ route('admin.createDK') }}'"
                    class="bg-blue-900 text-white px-4 py-2 mb-3 rounded w-[200px] ">Tambah Data Keragaman</button>
                <br>
            </div>
                   `,
                cancelButtonText: 'Batal'
            });
        });

        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form'); // Temukan formulir terdekat dari tombol
                const articleId = this.getAttribute('data-id');
                event.preventDefault(); // Cegah tindakan default

                Swal.fire({
                    title: 'Apakah Anda yakin ingin menghapus?',
                    text: "Anda tidak akan dapat mengembalikan data ini!",
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
    </script>
@endsection
