@extends('layouts.app-admin')
@section('title', 'detail Desa admin')
@section('content-admin')
    <div class="container mx-auto px-12 py-4 mb-10">
        <!-- Nama Desa dan Penjelasan Singkat -->
        <h1 class="text-3xl font-bold text-indigo-900 mb-4 pt-5">
            {{ $desa->nama_desa }}
        </h1>
        <p class="text-indigo-900 mb-8 text-justify">
            {{ $desa->deskripsi_desa }}
        </p>

        <!-- Galeri -->
        <div class="mb-8">
            <h3 class="inline-block text-2xl font-bold text-indigo-900 mb-4 mt-6 border-b-2 border-indigo-900">
                Galeri
            </h3>
            <!-- Galeri Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($desa->potensiDesa as $potensi)
                    <figure class="relative">
                        <img src="{{ asset('storage/' . $potensi->foto_potensi) }}" height="150px" width="150px"
                            alt="Foto {{ $potensi->nama_potensi }}"
                            class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
                            onclick="openModal('{{ asset('storage/' . $potensi->foto_potensi) }}', '{{ $potensi->deskripsi_potensi }}')" />
                        <figcaption
                            class="absolute bottom-0 left-0 w-full bg-gray-800 bg-opacity-60 text-white text-center p-2 rounded-b-lg">
                            Potensi {{ $potensi->nama_potensi }}
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </div>

    <a href="{{ route('admin.edit-desa', $desa->id) }}">
        <button
            class="fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
            aria-label="Edit Desa">
            <i class="fas fa-edit" style="color: #ffffff;">
            </i>
    </a>

    <!-- Modal -->
    <div id="modalImage" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75 hidden z-50">
        <div class="relative mt-20">
            <span class="absolute top-0 right-0 text-white text-2xl cursor-pointer p-4"
                onclick="closeModal()">&times;</span>
            <img id="modalImageContent" src="" class="w-80 h-80" />
            <!-- Deskripsi di bawah gambar -->
            <div id="modalImageDescription" class="text-white mt-4 p-4 bg-gray-900 bg-opacity-75 rounded">
                <!-- Deskripsi akan dimasukkan di sini -->
            </div>
        </div>
    </div>

    <script>
        function openModal(src, description) {
            document.getElementById('modalImage').classList.remove('hidden');
            document.getElementById('modalImageContent').src = src;
            document.getElementById('modalImageDescription').textContent = description; // Set deskripsi
        }

        function closeModal() {
            document.getElementById('modalImage').classList.add('hidden');
        }
    </script>
@endsection
