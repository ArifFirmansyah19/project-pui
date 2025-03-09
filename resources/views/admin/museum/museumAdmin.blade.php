@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app-admin')
@section('title', 'Halaman Edit Konten Museum Geowisata Merangin')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out px-4">
            <div class="container mx-auto">
                <h1 class="text-4xl font-semibold text-indigo-900 mb-6">Museum</h1>

                <!-- Tabel Konten -->
                <table class="min-w-full bg-white mt-12">
                    <thead>
                        <tr>
                            <th class="py-2">Judul</th>
                            <th class="py-2">Deskripsi Singkat</th>
                            <th class="py-2">Gambar</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Dummy -->
                        <tr>
                            <td class="py-2 px-4">{{ $dataGeopark->judul }}</td>
                            <td class="py-2 px-4">
                                {!! Str::limit(strip_tags($dataGeopark->deskripsi), 300, '...') !!}
                            </td>
                            <td class="py-2 px-4">
                                <img src="{{ asset('storage/' . $dataGeopark->foto) }}"
                                    alt="Foto Keragaman {{ $dataGeopark->nama }}" class="w-20 h-20 object-cover" />
                            </td>
                            <td class="py-2 px-4 mr-8">
                                <a href="{{ route('admin.editMG', $dataGeopark->id) }}"
                                    class="text-blue-600 hover:underline justify-center ml-2">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="container mx-auto">
                <!-- Dropdown Pilihan Jenis Data -->
                <div class="mb-6">
                    <form id="filterForm" action="{{ route('admin.museum') }}" method="GET">
                        <label for="dataType" class="block text-lg font-bold text-gray-700 mb-2 mt-12">Pilih Jenis
                            Data:</label>
                        <select id="mySelectWithOptions" name="jenis_keragaman"
                            class="max-w-xs p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            onchange="document.getElementById('filterForm').submit()">
                            <option value="" disabled {{ request('jenis_keragaman') == '' ? 'selected' : '' }}>Pilih
                                opsi...</option>
                            <option value="all" {{ request('jenis_keragaman') == 'all' ? 'selected' : '' }}>Semua Jenis
                                Keragaman</option>
                            @foreach ($jenisKeragamans as $jenisKeragaman)
                                <option value="{{ $jenisKeragaman->id }}"
                                    {{ request('jenis_keragaman') == $jenisKeragaman->id ? 'selected' : '' }}>
                                    {{ $jenisKeragaman->jenis_keragaman }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <!-- Judul Tabel -->
                <h2 id="table-title" class="text-2xl font-bold text-gray-800 mb-4">
                    Data
                    {{ $selectedJenis && $jenisKeragamans->contains($selectedJenis) ? $jenisKeragamans->find($selectedJenis)->jenis_keragaman : 'Jenis Keragaman yang Tersedia' }}
                </h2>

                <!-- Tabel Jenis Keragaman -->
                @if ($selectedJenis == 'all' || !$selectedJenis)
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                        <thead>
                            <tr class="bg-indigo-900 text-white text-center">
                                <th class="py-2 px-8 border border-gray-300 text-md">No.</th>
                                <th class="py-2 px-8 border border-gray-300 text-md">Jenis Keragaman</th>
                                <th class="py-2 px-8 border border-gray-300 text-md">Deskripsi Jenis Keragaman</th>
                                <th class="py-2 px-8 border border-gray-300 text-md">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="data-table-body" class="text-gray-600 text-sm font-light">
                            @php $no = 1; @endphp
                            @foreach ($jenisKeragamans as $jenisKeragaman)
                                <tr class="border border-gray-300">
                                    <td class="py-2 px-8 border border-indigo-900 text-sm">{{ $no++ }}.</td>
                                    <td class="py-2 px-8 border border-indigo-900 text-sm">
                                        {{ $jenisKeragaman->jenis_keragaman }}</td>
                                    <td class="py-2 px-8 border border-indigo-900 text-sm">
                                        {{ $jenisKeragaman->deskripsi_keragaman }}</td>
                                    <td class="py-2 px-8 border border-indigo-900 text-sm">
                                        <div class="flex justify-center">
                                            <form class="delete-form"
                                                action="{{ route('admin.destroyJK', $jenisKeragaman->id) }}"
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

                    </table>
                @endif

                <!-- Tabel Responsif -->
                @if ($selectedJenis != 'all' && $selectedJenis)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-gray-200 border border-gray-300 rounded-lg table-auto">
                            <thead>
                                <tr class="bg-indigo-900 text-white text-center">
                                    <th class="py-2 px-8 border border-gray-300 text-md">Nama Keragaman</th>
                                    <th class="py-2 px-8 border border-gray-300 text-md">Foto</th>
                                    <th class="py-2 px-8 border border-gray-300 text-md">Deskripsi</th>
                                    <th class="py-2 px-8 border border-gray-300 text-md">Lokasi</th>
                                    <th class="py-2 px-8 border border-gray-300 text-md">Umur</th>
                                    <th class="py-2 px-8 border border-gray-300 text-md">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="data-table-body" class="bg-gray">
                                @forelse ($dataKeragamans as $dataKeragaman)
                                    <tr class="border border-gray-300">
                                        <td class="py-2 px-8 border border-gray-300 text-sm">{{ $dataKeragaman->nama }}
                                        </td>
                                        <td class="py-2 px-8 border border-gray-300">
                                            @if ($dataKeragaman->foto_keragaman)
                                                <img src="{{ asset('storage/' . $dataKeragaman->foto_keragaman) }}"
                                                    alt="Foto Keragaman {{ $dataKeragaman->nama }}"
                                                    class="h-12 w-12 md:h-16 md:w-16 object-cover rounded" />
                                            @else
                                                <img src="{{ asset('img/gambarKosong.png') }}"
                                                    alt="Foto Keragaman {{ $dataKeragaman->nama }}"
                                                    class="h-12 w-12 md:h-16 md:w-16 object-cover rounded" />
                                            @endif
                                        </td>
                                        <td class="py-2 px-8 border border-gray-300 text-sm">{!! $dataKeragaman->deskripsi !!}</td>
                                        <td class="py-2 px-8 border border-gray-300 text-sm">{{ $dataKeragaman->lokasi }}
                                        </td>
                                        <td class="py-2 px-8 border border-gray-300 text-sm">{{ $dataKeragaman->umur }}
                                        </td>
                                        <td class="py-2 px-8 border border-gray-300 text-sm text-center">
                                            <div class="flex justify-end mt-2">
                                                <a href="{{ route('admin.editDK', $dataKeragaman->id) }}">
                                                    <button class="text-blue-500 hover:text-blue-700 mr-4">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a>
                                                <form class="delete-form"
                                                    action="{{ route('admin.destroyDK', $dataKeragaman->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="button" data-id="{{ $dataKeragaman->id }}"
                                                        class="delete-button text-red-500 hover:text-red-700">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-3 px-6 text-center text-gray-500">Data tidak tersedia
                                            untuk jenis keragaman yang dipilih.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <div class="mt-4">
                                {{ $dataKeragamans->appends(['jenis_keragaman' => request('jenis_keragaman')])->links() }}
                            </div>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="mb-8 px-6">
                <h2 class="text-2xl font-bold text-indigo-900 mt-12 inline-block border-b-2 border-indigo-900">
                    Kontak Museum
                    <!-- Ikon edit yang mengarahkan ke halaman edit -->
                    <a href="{{ route('admin.editKM', $kontakMuseum->id) }}" class="text-yellow-500 cursor-pointer ml-2"
                        title="edit kontak pihak kedua">
                        <i class="fas fa-edit"></i>
                    </a>
                </h2>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-indigo-900 mb-4 border-b-2">
                        Kontak Pihak Museum
                    </h3>
                    <p class="text-gray-700 mb-3">
                        Untuk informasi lebih lanjut, Anda dapat menghubungi:
                    </p>

                    <div class="flex items-center mb-1">
                        <i class="fas fa-user-circle text-indigo-700 text-xl mr-4"></i>
                        <p class="text-gray-800 text-lg">Nama Kontak: {{ $kontakMuseum->nama_kontak }}</p>
                    </div>

                    <div class="flex items-center mb-1">
                        <i class="fas fa-phone-alt text-indigo-700 text-xl mr-4"></i>
                        <p class="text-gray-800 text-lg cursor-pointer">
                            Telepon: {{ $kontakMuseum->telepon }}
                        </p>
                    </div>

                    <div class="flex items-center mb-1">
                        <i class="fas fa-envelope text-indigo-700 text-xl mr-4"></i>
                        <p class="text-gray-800 text-lg">
                            Email:
                            <a href="mailto:{{ $kontakMuseum->email }}"
                                class="text-indigo-600 hover:underline">{{ $kontakMuseum->email }}</a>
                        </p>
                    </div>

                    <div class="flex items-center mb-1">
                        <i class="fab fa-whatsapp text-indigo-700 text-xl mr-4"></i>
                        <p class="text-gray-800 text-lg">
                            Whatsapp:
                            <a href="https://wa.me/{{ $kontakMuseum->whatsapp }}?text=Halo%2C%20Admin%20Museum%20Geopark%20Merangin"
                                class="text-indigo-600 hover:underline">{{ $kontakMuseum->whatsapp }}</a>
                        </p>
                    </div>


                    <div class="flex items-center mb-1">
                        <i class="fab fa-instagram text-indigo-700 text-xl mr-4"></i>
                        <p class="text-gray-800 text-lg">
                            Instagram:
                            <a href="{{ $kontakMuseum->instagram }}"
                                class="text-indigo-600 hover:underline">{{ $username }}</a>
                        </p>
                    </div>

                    <div class="flex items-center mb-2">
                        <i class="fas fa-map-marker-alt text-indigo-700 text-xl mr-4"></i>
                        <p class="text-gray-800 text-lg">Alamat: {{ $kontakMuseum->alamat }}</p>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.createDK') }}">
                <button
                    class="fixed bottom-4 right-4 bg-green-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 mr-4"
                    aria-label="Tambah Data Keragaman">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </a>
    </main>

    <script>
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
