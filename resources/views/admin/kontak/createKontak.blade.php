@extends('layouts.app-admin')
@section('title', 'halaman tambah kontak admin')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16">
                <h1 class="text-3xl font-bold mb-4 mt-3 text-indigo-800">
                    Tambah Kontak
                </h1>

                <!-- Form Tambah Kontak disini -->
                <form action="{{ route('admin.store-kontak') }}" method="POST" enctype="multipart/form-data"
                    class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="alamat">Alamat:</label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="alamat" type="text" name="alamat" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="telepon">Telepon:</label>
                        <p class="text-xs text-gray-500 mt-1">
                            Peringatan: Ketikkan nomor dari 62.
                        </p>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="telepon" type="text" name="telepon" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email:</label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="email" type="email" name="email" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="facebook">Facebook
                            URL:</label>
                        <p class="text-xs text-gray-500 mt-1">
                            Peringatan: isi dengan link URL Facebook PUI GEMAR yang aktif.
                        </p>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="facebook" type="text" name="facebook" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="instagram">Instagram
                            URL:</label>
                        <p class="text-xs text-gray-500 mt-1">
                            Peringatan: isi dengan link URL Instagram PUI GEMAR yang aktif.
                        </p>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="instagram" type="text" name="instagram" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="tiktok">Tiktok URL:</label>
                        <p class="text-xs text-gray-500 mt-1">
                            Peringatan: isi dengan link URL Tiktok PUI GEMAR yang aktif.
                        </p>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="tiktok" type="text" name="tiktok" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="youtube">Youtube URL:</label>
                        <p class="text-xs text-gray-500 mt-1">
                            Peringatan: isi dengan link URL Youtube PUI GEMAR yang aktif.
                        </p>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="youtube" type="text" name="youtube" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="twitter">Twitter URL:</label>
                        <p class="text-xs text-gray-500 mt-1">
                            Peringatan: isi dengan link URL Twitter PUI GEMAR yang aktif.
                        </p>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="twitter" type="text" name="twitter" />
                    </div>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        SIMPAN
                    </button>
                </form>
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
