@extends('layouts.app-admin')
@section('title', 'halaman struktur organisasi admin')
@section('content-admin')

    <!-- alert succes simpan data / ubah data -->
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success'
                });
            });
        </script>
    @endif

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6">
        @if (!$gambarStrukturOrganisasiExists)
            <div class="flex justify-start">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    <a href="{{ route('admin.create-SO') }}">
                        Tambah Gambar Struktur Organisasi
                    </a>
                </button>
            </div>
        @endif

        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h1 class="text-4xl font-bold text-indigo-900 mb-16 mt-12">
                Struktur Organisasi
            </h1>
            <!--konten strurktur organisasi-->
            @if (!$gambarStrukturOrganisasiExists)
            @else
                <div class="items-center mt-6">
                    <img src="{{ asset('storage/' . $strukturOrganisasi->foto_struktur_organisasi) }}"
                        alt="Foto Struktur Organisasi" style="width: 70%; height:40%" />
                </div>
            @endif
        </div>
        <div class="max-w-full p-12 bg-white shadow-md rounded-lg">
            @if ($divisis->isEmpty())
                <h1 class="text-4xl font-bold text-indigo-900 mb-15">Tidak ada Divisi yang Tersedia</h1>
            @else
                <h1 class="text-4xl font-bold text-indigo-900 mb-15">Divisi</h1>

                @php $no = 1; @endphp
                <p class="text-gray-800 mt-6 leading-relaxed ">
                    @foreach ($divisis as $divisi)
                        <li class="list-none">
                            {{ $no++ }}. {{ $divisi->nama_divisi }}
                            <br>
                            {{ $divisi->deskripsi_divisi }}
                        </li>
                        <br>
                    @endforeach
                </p>
            @endif
            <!-- Floating Action Button -->
            @if (!$gambarStrukturOrganisasiExists)
            @else
                <button
                    class="fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
                    aria-label="Tambah SO">
                    <a href="{{ route('admin.edit-SO', $strukturOrganisasi->id) }}">
                        <i class="fas fa-edit" style="color: #ffffff;"></i>
                    </a>
                    </i>
                </button>
            @endif
        </div>
    </main>

@endsection
