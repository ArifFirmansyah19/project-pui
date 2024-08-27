@extends('layouts.app-admin')
@section('title', 'detail Umkm admin')
@section('content-admin')

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h1 class="text-3xl font-bold text-gray-800 mb-4 mt-3">
                {{ $umkm->nama_umkm }}
            </h1>
            <h2 class="text-lg text-gray-700 mb-8">
                Alamat: {{ $umkm->desaPotensi->nama_desa }} - {{ $umkm->alamat_umkm }}
            </h2>
            <p class="text-lg text-gray-700 mb-8">
                {{ $umkm->deskripsi_umkm }}
            </p>

            @if ($umkm->foto_umkm)
                <!-- Jika ada gambar, tampilkan gambar -->
                <img src="{{ asset('storage/' . $umkm->foto_umkm) }}" alt="Foto UMKM {{ $umkm->nama_umkm }}"
                    class="mb-2 rounded-lg h-96 w-full object-cover" />
            @else
                <!-- Jika tidak ada gambar, isi foto Default -->
                <img src="{{ asset('img/gambarKosong.png') }}" alt="Foto UMKM {{ $umkm->nama_umkm }}"
                    class="mb-2 rounded-lg h-96 w-full object-cover" />
            @endif


            {{-- <div class="mb-8">
                <h3 class="inline-block text-2xl font-bold text-indigo-900 mb-4 mt-6 border-b-2 border-indigo-900">
                    Produk
                </h3>
                <!-- Produk Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($umkm->produkUmkm as $produk)
                        <figure class="relative">
                            <img src="{{ asset('storage/' . $produk->foto_produk) }}" alt="{{ $produk->nama_produk }}"
                                height="150px" width="150px"
                                class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
                                onclick="openModal('{{ asset('storage/' . $produk->foto_produk) }}', '{{ $produk->deskripsi_produk }}')" />
                            <figcaption
                                class="absolute bottom-0 left-0 w-full bg-gray-800 bg-opacity-60 text-white text-center p-2 rounded-b-lg">
                                Produk {{ $produk->nama_produk }}
                            </figcaption>
                        </figure>
                    @endforeach
                </div>
            </div> --}}


            <div class="mb-8">
                <h3 class="text-2xl font-semibold text-indigo-900 mb-4">Produk</h3>
                <div class="grid grid-cols-2 gap-6 px-8 md:grid-cols-3">
                    @foreach ($umkm->produkUmkm as $produk)
                        <div class="bg-white rounded-md shadow-md overflow-hidden">
                            <img src="{{ asset('storage/' . $produk->foto_produk) }}" alt="{{ $produk->nama_produk }}"
                                class="w-full h-60 object-cover" />
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-indigo-900 mb-2">
                                    {{ $produk->nama_produk }}
                                </h3>
                                <p class="text-gray-600 mb-1">{{ $produk->deskripsi_produk }}</p>
                                <div class="flex items-center justify-between">
                                    @if ($produk->harga_terendah == $produk->harga_tertinggi)
                                        <span class="text-indigo-700 font-semibold text-sm">
                                            Rp {{ number_format($produk->harga_terendah, 2, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-indigo-700 font-semibold text-sm">
                                            Rp {{ number_format($produk->harga_terendah, 2, ',', '.') }} - Rp
                                            {{ number_format($produk->harga_tertinggi, 2, ',', '.') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>



            <a href="{{ route('admin.edit-umkm', $umkm->id) }}">
                <button
                    class="fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
                    aria-label="Edit UMKM">
                    <i class="fas fa-edit" style="color: #ffffff;">
                    </i>
            </a>
            </button>
        </div>
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
    </main>
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
