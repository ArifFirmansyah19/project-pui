@extends('layouts.app-admin')
@section('title', 'halaman Kegiatan PUI admin')
@section('content-admin')

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h1 class="text-4xl font-bold text-indigo-900 mt-10 mb-4">
                Kegiatan
            </h1>

            @if ($dataKegiatan->isEmpty())
                <div class="flex justify-center items-center ">
                    <a href="#"
                        class=" text-center block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Mohon Maaf Admin
                        </h5>
                        <br>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Saat ini kamu tidak memiliki data kegiatan
                            apapun.
                            Mulailah untuk menambahkan kegiatan baru untuk memuat data. Tombol buat kegiatan tersedia di
                            pojok
                            kanan bawah
                        </p>
                        <br>
                    </a>
                </div>
            @else
                @foreach ($dataKegiatan as $kegiatan)
                    <!-- Data Kegiatan -->
                    <div
                        class="mx-10 mb-8 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                        <h2 class="text-lg font-semibold text-indigo-900 mb-2 mt-14">
                            {{ $kegiatan->nama_kegiatan }}
                        </h2>
                        <p class="text-sm text-gray-500 mb-2">{{ $kegiatan->formatted_created_at }}</p>

                        @if ($kegiatan->foto_kegiatan)
                            <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}"
                                alt="Gambar Kegiatan {{ $kegiatan->nama_kegiatan }}"
                                class="mb-2 rounded-lg h-96 w-full object-cover" />
                        @endif
                        <p class="text-gray-800 leading-relaxed">
                            {{ implode("\n", array_slice(explode("\n", wordwrap(strip_tags($kegiatan->deskripsi_kegiatan), 150, "\n")), 0, 7)) }}
                            ...........
                        </p>
                        <a href="{{ route('admin.detail-kegiatan', $kegiatan->id) }}"
                            class="block text-blue-500 font-semibold mt-2 hover:text-blue-300 transition duration-300">
                            Baca Selengkapnya
                        </a>
                        <div class="flex justify-center mt-4">
                            <a href="{{ route('admin.edit-kegiatan', $kegiatan->id) }}">
                                <button class="mx-2 text-gray-600 hover:text-gray-900">
                                    <i class="fas fa-edit" style="color: #ea7434;"></i>
                                </button>
                            </a>

                            <!-- Delete Buttons -->
                            <form class="delete-form" action="{{ route('admin.destroy-kegiatan', $kegiatan->id) }}"
                                method="POST">
                                @csrf
                                <button type="button" data-id="{{ $kegiatan->id }}"
                                    class="delete-button mx-2 text-gray-600 hover:text-gray-900">
                                    <i class="fa-solid fa-trash text-red-600 hover:text-gray-900"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
                <div class="mt-auto mb-0 px-3 flex justify-start">
                    {{ $dataKegiatan->links() }}
                </div>
            @endif

            <!-- Floating Action Button -->
            <a href="{{ route('admin.create-kegiatan') }}">
                <button
                    class="fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
                    aria-label="Tambah Kegiatan">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </a>
        </div>
    </main>

    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form'); // Temukan formulir terdekat dari tombol
                const kegiatanId = this.getAttribute('data-id');
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
