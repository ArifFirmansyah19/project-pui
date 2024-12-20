@extends('layouts.app-admin')
@section('title', 'halaman tim admin')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h1 class="text-4xl font-bold text-indigo-900 mb-6 px-2 ">Team</h1>
            <!-- divisi 1 -->
            @foreach ($groupedTims as $divisiName => $dataTimPui)
                <div class="team-section">
                    <h2 class="text-2xl font-bold text-indigo-900 mt-5 border-b-2 px-2">
                        {{ $divisiName }}
                    </h2>

                    <!-- Grid container -->
                    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6 px-2">
                        @foreach ($dataTimPui as $tim)
                            <div
                                class="team-member bg-white rounded-lg overflow-hidden shadow-md transform transition duration-300 hover:scale-105 flex flex-col h-[400px]">
                                <!-- Perpanjang tinggi div -->
                                <a href="{{ route('admin.detail-tim-admin', $tim->id) }}" class="flex flex-col h-full">
                                    @if ($tim->foto)
                                        <img src="{{ asset('storage/' . $tim->foto) }}"
                                            alt="Foto Divisi {{ $divisiName }}: {{ $tim->nama }}"
                                            class="object-cover object-top w-full h-72 sm:h-48 md:h-56 lg:h-72 object-position[50% 20%]" />
                                    @else
                                        <img src="{{ asset('img/fotoKosong.png') }}"
                                            alt="Foto Divisi {{ $divisiName }}: {{ $tim->nama }}"
                                            class="object-cover object-top w-full h-72 sm:h-48 md:h-56 lg:h-72 object-position[50% 20%]" />
                                    @endif

                                    <!-- Konten -->
                                    <div class="p-4 flex flex-col justify-between flex-grow">
                                        <div class="flex flex-col justify-between flex-grow">
                                            <!-- Nama -->
                                            <h3
                                                class="text-base sm:text-lg md:text-xl font-semibold text-center text-gray-800 mb-1 sm:mb-2">
                                                {{ $tim->nama }}
                                            </h3>
                                            <!-- Jabatan -->
                                            <p
                                                class="text-gray-600 text-center text-sm sm:text-sm md:text-base mb-2 sm:mb-4">
                                                {{ $tim->jabatan }}
                                            </p>
                                        </div>

                                        <!-- Aksi (edit & delete) -->
                                        <div class="flex justify-center mt-2">
                                            <a href="{{ route('admin.edit-tim', $tim->id) }}">
                                                <button
                                                    class="mx-2 text-gray-600 hover:text-gray-900 text-base sm:text-sm md:text-base">
                                                    <i
                                                        class="fas fa-edit text-yellow-500 hover:text-yellow-700 text-base sm:text-sm md:text-base"></i>
                                                </button>
                                            </a>

                                            <form class="delete-form" action="{{ route('admin.destroy-tim', $tim->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="button" id="delete" data-id="{{ $tim->id }}"
                                                    class="delete-button mx-2 text-red-600 hover:text-red-800">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    </div>
    <a href="{{ route('admin.create-tim') }}">
        <button
            class="fixed bottom-4 right-4 bg-green-600 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-50 mr-4"
            aria-label="Tambah Tim">
            <i class="fa-solid fa-plus"></i>
        </button>
    </a>
    </div>



    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form'); // Temukan formulir terdekat dari tombol
                const timId = this.getAttribute('data-id');
                event.preventDefault(); // Cegah tindakan default

                Swal.fire({
                    title: 'Apakah Anda yakin ingin menghapus?',
                    text: "Anda tidak akan dapat mengembalikan artikel ini!",
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
