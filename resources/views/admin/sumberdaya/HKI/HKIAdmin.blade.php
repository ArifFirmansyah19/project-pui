@extends('layouts.app-admin')
@section('title', 'halaman HKI admin')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 overflow-y-auto mx-3">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h1 class="text-2xl sm:text-3xl font-bold mb-4 mt-3 text-indigo-800">
                HKI Table
            </h1>

            <div class="overflow-x-auto">
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
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                        <thead class="bg-indigo-900 text-gray-600 uppercase text-sm">
                            <tr>
                                <th class="py-3 px-4 border-b text-white">Judul</th>
                                <th class="py-3 px-4 border-b text-white">Nama</th>
                                <th class="py-3 px-4 border-b text-white">
                                    Deskripsi Singkat HKI
                                </th>
                                <th class="py-3 px-4 border-b text-white">Dokumen HKI</th>
                                <th class="py-3 px-4 border-b text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm text-center">
                            @foreach ($HKIs as $HKI)
                                <tr>
                                    <td class="py-3 px-4 border-b">
                                        {{ $HKI->judul }}
                                    </td>
                                    <td class="py-3 px-4 border-b">
                                        {{ $HKI->nama }}
                                    </td>
                                    <td class="py-3 px-4 border-b">
                                        {!! $HKI->deskripsi !!}
                                    </td>
                                    <td class="py-3 px-4 border-b">
                                        @if ($HKI->file_path)
                                            <a href="{{ asset('storage/' . $HKI->file_path) }}" download target="_blank"
                                                class="text-indigo-600 hover:underline">
                                                Unduh PDF
                                            </a>
                                        @endif
                                    </td>
                                    <td class="p-4 border-b">
                                        <div class="flex space-x-2 justify-center items-center">
                                            <a href="{{ route('admin.edit-HKI', $HKI->id) }}">
                                                <button
                                                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">
                                                    edit
                                                </button>
                                            </a>
                                            <form class="delete-form" action="{{ route('admin.destroy-HKI', $HKI->id) }}"
                                                method="POST">
                                                @csrf
                                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <tr></tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </main>
    <a href="{{ route('admin.create-HKI') }}">
        <button
            class="fixed bottom-4 right-4 bg-green-600 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-amber-800 focus:ring-opacity-50 mr-4"
            aria-label="Tambah HKI">
            <i class="fa-solid fa-plus"></i>
        </button>
    </a>


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
