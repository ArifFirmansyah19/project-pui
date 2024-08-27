@extends('layouts.app-admin')
@section('title', 'halaman kontak PUI admin')
@section('content-admin')

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Kontak PUI GEMAR UNJA
            </h2>
            @if (!$kontakExists)
                <div class="flex justify-start">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        <a href="{{ route('admin.create-kontak') }}">
                            Tambah Kontak
                        </a>
                    </button>
                </div>
            @endif


            <div class="container" style="padding:100px 100px 100px 100px";>
                @if (!$kontakExists)
                    <div class="flex justify-center items-center ">
                        <a href="#"
                            class=" text-center block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Mohon Maaf
                                Admin
                            </h5>
                            <br>
                            <p class="font-normal text-gray-700 dark:text-gray-400">Saat ini kamu tidak memiliki data
                                Kontak
                                Silahkan menginputkan data kontak dengan menekan Tombol tambah Kontak di Pojok kiri atas
                            </p>
                            <br>
                        </a>
                    </div>
                @else
                    <!-- Tabel -->
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                        <thead>
                            <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Alamat</th>
                                <th class="py-3 px-6 text-left">Email</th>
                                <th class="py-3 px-6 text-left">No. Telepon</th>
                                <th class="py-3 px-6 text-left">Twitter</th>
                                <th class="py-3 px-6 text-left">Instagram</th>
                                <th class="py-3 px-6 text-left">Facebook</th>
                                <th class="py-3 px-6 text-left">Youtube</th>
                                <th class="py-3 px-6 text-left">Tiktok</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6">{{ $kontak->alamat }}</td>
                                <td class="py-3 px-6">{{ $kontak->email }}</td>
                                <td class="py-3 px-6">{{ $kontak->telepon }}</td>
                                <td class="py-3 px-6">{{ $kontak->twitter }}</td>
                                <td class="py-3 px-6">{{ $kontak->instagram }}</td>
                                <td class="py-3 px-6">{{ $kontak->facebook }}</td>
                                <td class="py-3 px-6">{{ $kontak->youtube }}</td>
                                <td class="py-3 px-6">{{ $kontak->tiktok }}</td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex justify-center">
                                        <a href="{{ route('admin.edit-kontak', $kontak->id) }}">
                                            <button class="mx-2 hover:text-gray-900">
                                                <i class="fas fa-edit" style="color: #ea7434;"></i>
                                            </button>
                                        </a>
                                        <form class="delete-form" action="{{ route('admin.destroy-kontak', $kontak->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="button" data-id="{{ $kontak->id }}"
                                                class="delete-button mx-2">
                                                <i class="fa-solid fa-trash text-red-600 hover:text-gray-900"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>
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
