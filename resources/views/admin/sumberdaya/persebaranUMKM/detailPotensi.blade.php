@extends('layouts.app-admin')
@section('title', 'detail Potensi admin')
@section('content-admin')
    <main class="flex-1 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <!-- Konten detail potensi -->
            <div class="max-w-full p-6 bg-white shadow-md rounded-lg">
                <!-- Nama Potensi dan Penjelasan Singkat -->
                <h1 class="text-3xl font-bold text-indigo-900 mb-4 mt-6">
                    {{ $potensi->nama_potensi }}
                </h1>
                <p class="text-indigo-900 mb-8 text-justify">
                    {!! $potensi->deskripsi_potensi !!}
                </p>

                <div class="mb-8">
                    <!-- Galeri Foto -->
                    <h3 class="inline-block text-2xl font-bold text-indigo-900 mb-4 mt-6 border-b-2 border-indigo-900">
                        Galeri
                    </h3>

                    <!-- Galeri Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($potensi->fotoPotensi as $item)
                            <figure class="relative">
                                <img src="{{ asset('storage/' . $item->foto_potensi) }}" alt="" height="150px"
                                    width="150px"
                                    class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
                                    onclick="openModal('{{ asset('storage/' . $item->foto_potensi) }}', '{{ $item->deskripsi_foto }}')" />
                                <figcaption
                                    class="absolute bottom-0 left-0 w-full bg-gray-800 bg-opacity-60 text-white text-center p-2 rounded-b-lg">
                                    {{ $item->deskripsi_foto }}
                                </figcaption>
                            </figure>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>

    <a href="{{ route('admin.edit-potensi', ['kecamatan_id' => $kecamatan->id, 'potensi_id' => $potensi->id]) }}"
        class="fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
        aria-label="Edit Potensi">
        <i class="fas fa-edit"></i>
    </a>



    <!-- Modal untuk Menampilkan Gambar Besar -->
    <div id="modalImage" class="hidden fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
        <div class="relative">
            <!-- Gambar Besar di Modal -->
            <img id="modalImageContent" src="" alt="Gambar Besar" class="max-w-full max-h-full" />

            <!-- Deskripsi Gambar -->
            <div id="modalImageDescription"
                class="absolute bottom-0 left-0 w-full bg-gray-800 bg-opacity-60 text-white p-4">
                <!-- Deskripsi akan ditampilkan di sini -->
            </div>

            <!-- Tombol Tutup Modal -->
            <button onclick="closeModal()"
                class="absolute top-0 right-0 p-2 text-white bg-red-500 hover:bg-red-700 rounded-full">
                X
            </button>
        </div>
    </div>

    <script>
        // Fungsi untuk membuka modal dan menampilkan gambar serta deskripsi
        function openModal(src, description) {
            document.getElementById('modalImage').classList.remove('hidden'); // Menampilkan modal
            document.getElementById('modalImageContent').src = src; // Menampilkan gambar
            document.getElementById('modalImageDescription').textContent = description; // Menampilkan deskripsi
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById('modalImage').classList.add('hidden'); // Menyembunyikan modal
        }
    </script>

@endsection
