@extends('layouts.app-user')
@section('title', 'Detail Kegiatan PUI GEMAR')

@section('content')

    <!-- Content -->
    <div class="flex flex-col mt-5 md:flex-row w-full">
        <div id="content" class="transition-transform duration-500 ease-in-out" style="margin-top: 90px">
            <!-- Bagian untuk menampilkan data keragaman -->
            <div class="container mx-auto px-4 py-1">
                <h2 class="text-3xl font-bold mb-6">Data {{ $jenisKeragaman->jenis_keragaman }}</h2>
                <div class="grid grid-cols-1 gap-6 px-8 md:grid-cols-2">
                    @foreach ($jenisKeragaman->dataKeragaman as $dataKeragaman)
                        <a href="{{ route('detail-data-keragaman', $dataKeragaman->id) }}">
                            <div class="bg-white shadow-md rounded-lg p-6">
                                <h3 class="text-xl font-semibold mb-2">{{ $dataKeragaman->nama }}</h3>
                                <img src="{{ asset('storage/' . $dataKeragaman->foto_keragaman) }}"
                                    alt="gambar {{ $dataKeragaman->nama }}"
                                    class="mb-2 rounded-lg h-48 w-full object-cover" />
                                <p class="text-gray-600 line-clamp-3">{!! $dataKeragaman->deskripsi !!}</p>
                                <br>
                                <p>Lokasi: {{ $dataKeragaman->lokasi }}</p>
                                <p>Usia: {{ $dataKeragaman->umur }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua elemen menu dan submenu
            const menuItems = document.querySelectorAll('.relative');

            // Loop melalui setiap elemen menu
            menuItems.forEach(menuItem => {
                const menuButton = menuItem.querySelector('button');
                const submenu = menuItem.querySelector('.submenu');
                let timeoutId;

                // Tambahkan event listener untuk menampilkan submenu saat tombol menu dihover
                menuButton.addEventListener('mouseenter', function() {
                    // Sembunyikan semua submenu terlebih dahulu
                    hideAllSubmenus();
                    // Tampilkan submenu yang sesuai
                    submenu.classList.remove('hidden');
                });

                // Tambahkan event listener untuk menyembunyikan submenu saat kursor meninggalkan area menu
                menuItem.addEventListener('mouseleave', function() {
                    // Tetapkan penundaan sebelum menyembunyikan submenu
                    timeoutId = setTimeout(function() {
                        // Sembunyikan submenu setelah penundaan
                        submenu.classList.add('hidden');
                    }, 300); // Ubah angka ini untuk menyesuaikan dengan kebutuhan Anda
                });

                // Batalkan penundaan jika kursor kembali ke menu sebelum submenu disembunyikan
                submenu.addEventListener('mouseenter', function() {
                    clearTimeout(timeoutId);
                });
            });

            // Fungsi untuk menyembunyikan semua submenu
            function hideAllSubmenus() {
                const allSubmenus = document.querySelectorAll('.submenu');
                allSubmenus.forEach(submenu => {
                    submenu.classList.add('hidden');
                });
            }
        });
    </script>
@endsection
