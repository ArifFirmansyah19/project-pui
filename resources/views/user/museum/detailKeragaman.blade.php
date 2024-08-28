@extends('layouts.app-user')
@section('title', 'Detail Kegiatan PUI GEMAR')

@section('content')

    <main>
        <div class="container mx-auto px-4 py-8" style="margin-top: 90px">
            <h2 class="text-3xl font-bold mb-6">{{ $dataKeragaman->nama }}</h2>

            <img src="{{ asset('storage/' . $dataKeragaman->foto_keragaman) }}" alt="gambar {{ $dataKeragaman->nama }}"
                class="mb-4 rounded-lg h-96 w-full object-cover" />

            <p class="text-gray-600 mb-4">{!! $dataKeragaman->deskripsi !!}</p>
            <p><strong>Lokasi:</strong> {{ $dataKeragaman->lokasi }}</p>
            <p><strong>Usia:</strong> {{ $dataKeragaman->umur }}</p>
        </div>

    </main>

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
