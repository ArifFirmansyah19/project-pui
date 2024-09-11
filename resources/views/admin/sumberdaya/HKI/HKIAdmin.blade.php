@extends('layouts.app-admin')
@section('title', 'halaman HKI admin')
@section('content-admin')
    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Data HKI PUI GEMAR UNJA
            </h2>
            @if (!$HKIExists)
                <div class="flex justify-center items-center ">
                    <a href="#"
                        class=" text-center block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Mohon Maaf Admin
                        </h5>
                        <br>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Saat ini kamu tidak memiliki data HKI
                            apapun.
                            Mulailah untuk menambahkan data HKI baru untuk memuat data. Tombol buat HKI tersedia di
                            pojok
                            kanan bawah
                        </p>
                        <br>
                    </a>
                </div>
            @else
                <!-- Tabel -->
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                    <thead>
                        <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">NO</th>
                            <th class="py-3 px-6 text-left">Judul</th>
                            <th class="py-3 px-6 text-left">Nama</th>
                            <th class="py-3 px-6 text-left">Deskripsi</th>
                            <th class="py-3 px-6 text-left">File</th>
                            <th class="py-3 px-6 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @php $no = 1; @endphp
                        @foreach ($HKIs as $HKI)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-center">{{ $no++ }}.</td>
                                <td class="py-3 px-6">{{ $HKI->judul }}</td>
                                <td class="py-3 px-6">{{ $HKI->nama }}</td>
                                <td class="py-3 px-6">{{ $HKI->deskripsi }}</td>
                                <td class="py-3 px-6">

                                    @if ($HKI->file_path)
                                        <a href="{{ asset('storage/' . $HKI->file_path) }}" target="_blank"
                                            class="text-blue-500 underline">
                                            {{ $HKI->judul }}.Pdf
                                        </a>
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex justify-center">
                                        <a href="{{ route('admin.edit-HKI', $HKI->id) }}">
                                            <button class="mx-2 hover:text-gray-900">
                                                <i class="fas fa-edit" style="color: #ea7434;"></i>
                                            </button>
                                        </a>
                                        <form class="delete-form" action="{{ route('admin.destroy-HKI', $HKI->id) }}"
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
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Floating Action Button -->
        <a href="{{ route('admin.create-HKI') }}">
            <button
                class="fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
                aria-label="Tambah HKI">
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
                    text: "Data Kontak yang Dihapus Akan Hilang!",
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
