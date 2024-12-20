@extends('layouts.app-admin')
@section('title', 'Halaman Kontak PUI Admin')
@section('content-admin')
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16 px-8">
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

                @if (!$kontakExists)
                    <div class="flex justify-center items-center">
                        <a href="#"
                            class="text-center block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Mohon Maaf
                                Admin</h5>
                            <br>
                            <p class="font-normal text-gray-700 dark:text-gray-400">
                                Saat ini kamu tidak memiliki data Kontak. Silahkan menginputkan data kontak dengan menekan
                                Tombol tambah Kontak di Pojok kiri atas.
                            </p>
                            <br>
                        </a>
                    </div>
                @else
                    <!-- Form Edit Kontak -->
                    <form action="{{ route('admin.update-kontak', $kontak->id) }}" method="POST"
                        enctype="multipart/form-data" class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
                        @csrf

                        <h1 class="text-3xl font-bold mb-4 mt-3 text-indigo-800">Edit Kontak (Footer)</h1>

                        <!-- Alamat -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="alamat">Alamat:</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="alamat" type="text" name="alamat" value="{{ old('alamat', $kontak->alamat) }}" />
                        </div>

                        <!-- Telepon -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="telepon">Telepon:</label>
                            <p class="text-xs text-gray-500 mt-1">Peringatan: Ketikkan nomor dari 62.</p>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="telepon" type="text" name="telepon"
                                value="{{ old('telepon', $kontak->telepon) }}" />
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email:</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="email" type="email" name="email" value="{{ old('email', $kontak->email) }}" />
                        </div>

                        <!-- Social Media Links -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="facebook">Facebook URL:</label>
                            <p class="text-xs text-gray-500 mt-1">Peringatan: Isi dengan link URL Facebook PUI GEMAR yang
                                aktif.</p>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="facebook" type="text" name="facebook"
                                value="{{ old('facebook', $kontak->facebook) }}" />
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="instagram">Instagram URL:</label>
                            <p class="text-xs text-gray-500 mt-1">Peringatan: Isi dengan link URL Instagram PUI GEMAR yang
                                aktif.</p>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="instagram" type="text" name="instagram"
                                value="{{ old('instagram', $kontak->instagram) }}" />
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="tiktok">Tiktok URL:</label>
                            <p class="text-xs text-gray-500 mt-1">Peringatan: Isi dengan link URL Tiktok PUI GEMAR yang
                                aktif.</p>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="tiktok" type="text" name="tiktok" value="{{ old('tiktok', $kontak->tiktok) }}" />
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="youtube">Youtube URL:</label>
                            <p class="text-xs text-gray-500 mt-1">Peringatan: Isi dengan link URL Youtube PUI GEMAR yang
                                aktif.</p>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="youtube" type="text" name="youtube"
                                value="{{ old('youtube', $kontak->youtube) }}" />
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="twitter">Twitter URL:</label>
                            <p class="text-xs text-gray-500 mt-1">Peringatan: Isi dengan link URL Twitter PUI GEMAR yang
                                aktif.</p>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="twitter" type="text" name="twitter"
                                value="{{ old('twitter', $kontak->twitter) }}" />
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan
                        </button>
                    </form>
                @endif
            </div>
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
