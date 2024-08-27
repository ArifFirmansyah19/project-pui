@extends('layouts.app-admin')
@section('title', 'halaman edit artikel admin')
@section('content-admin')

    {{-- allert berhasil simpan data artikel, update --}}
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
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h1 class="text-4xl font-bold text-indigo-900 mb-8 mt-10">
                Artikel
            </h1>

            {{-- keterangan jika tidak ada artikel --}}
            @if ($articles->isEmpty())
                <div class="flex justify-center items-center ">
                    <a href="#"
                        class=" text-center block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Mohon Maaf Admin
                        </h5>
                        <br>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Saat ini kamu tidak memiliki data artikel
                            apapun.
                            Mulailah untuk menambahkan artikel baru untuk memuat data. Tombol buat artikel tersedia di pojok
                            kanan bawah
                        </p>
                        <br>
                    </a>
                </div>
            @else
                {{-- jika artikel tersedia, tampilkan artikel --}}
                @foreach ($articles as $article)
                    <!-- Artikel 1 -->
                    <div class="mb-8">
                        <a href="{{ route('admin.detail-artikel', $article->id) }}"
                            class="block text-xl font-semibold text-indigo-900 mb-0">Artikel:
                            {{ $article->judul }}</a>
                        <p class="text-sm text-gray-500 mb-2">Diunggah pada : {{ $article->formatted_created_at }}</p>
                        <p class="text-sm text-gray-500 mb-2">Penulis : {{ $article->penulis }}</p>
                        <div class="prose lg:prose-xl">

                            <p class="text-gray-800 leading-relaxed line-clamp">
                                {!! $article->deskripsi !!}
                            </p>
                        </div>
                        <a href="{{ route('admin.detail-artikel', $article->id) }}"
                            class="block text-blue-500 font-semibold mt-2 hover:text-blue-300 transition duration-300">
                            Baca Selengkapnya
                        </a>

                        <!-- Edit Button  -->
                        <div class="flex justify-end mt-4">
                            <a href="{{ route('admin.edit-artikel', $article->id) }}">
                                <button class="mx-2 hover:text-gray-900">
                                    <i class="fas fa-edit" style="color: #ea7434;"></i>
                                </button>
                            </a>

                            <!-- Delete Buttons -->
                            <form class="delete-form" action="{{ route('admin.destroy-artikel', $article->id) }}"
                                method="POST">
                                @csrf
                                <button type="button" data-id="{{ $article->id }}" class="delete-button mx-2">
                                    <i class="fa-solid fa-trash text-red-600 hover:text-gray-900"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <hr class="border-gray-800 my-1" />
                @endforeach
            @endif


        </div>
        <!-- Floating Action Button -->

        <button
            class="fixed bottom-1 right-3 border-4 border-green-500 rounded-full w-14 h-14 bg-white items-center justify-center shadow-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
            aria-label="Tambah Artikel">
            <a href="{{ route('admin.create-artikel') }}">
                <i class="fa-solid fa-plus" style="color: #19be71;"></i>
            </a>
        </button>
        </div>
    </main>
    </div>
    </div>

    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form'); // Temukan formulir terdekat dari tombol
                const articleId = this.getAttribute('data-id');
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
