@extends('layouts.app-admin')
@section('title', 'halaman Kegiatan PUI admin')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 overflow-y-auto mx-3">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h1 class="text-4xl font-bold text-indigo-900 mt-6 mb-5">
                Kegiatan
            </h1>

            @if ($dataKegiatan->isEmpty())
                <div class="flex justify-center items-center ">
                    <a href="{{ route('create-kegiatan') }}"
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
                    <!-- Kegiatan 1 -->
                    <div
                        class="kegiatan mx-10 mb-8 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                        <a href="{{ route('admin.detail-kegiatan', $kegiatan->id) }}">
                            <h2 class="text-lg font-semibold text-indigo-900 mb-2 mt-14">
                                {{ $kegiatan->nama_kegiatan }}
                            </h2>
                            <p class="text-sm text-gray-500 mb-2">{{ $kegiatan->formatted_created_at }}</p>
                            @if (Str::endsWith($kegiatan->foto_kegiatan, ['jpg', 'jpeg', 'png', 'webp']))
                                <!-- Menampilkan Gambar -->
                                <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}"
                                    alt="Kegiatan {{ $kegiatan->nama_kegiatan }}"
                                    class="mb-2 rounded-lg h-96 w-full object-cover" />
                            @elseif (Str::endsWith($kegiatan->foto_kegiatan, ['mp4', 'avi', 'mov']))
                                <!-- Menampilkan Video -->
                                <video controls class="mb-2 rounded-lg h-96 w-full object-cover">
                                    <source src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}"
                                        type="video/{{ pathinfo($kegiatan->foto_kegiatan, PATHINFO_EXTENSION) }}">
                                    Browser Anda tidak mendukung pemutar video.
                                </video>
                            @endif
                            <p class="text-gray-800 leading-relaxed text-justify">
                                {{ implode("\n", array_slice(explode("\n", wordwrap(strip_tags($kegiatan->deskripsi_kegiatan), 150, "\n")), 0, 7)) }}
                                ...........
                            </p>
                        </a>
                        <div class="flex items-center mb-4 space-x-4">
                            <button class="commentBtn text-gray-400 hover:text-blue-400 transition duration-300"
                                data-kegiatan-id="{{ $kegiatan->id }}">
                                <i class="far fa-comment mr-1"></i><span
                                    class="commentCount">{{ $kegiatan->totalComments }}</span>
                            </button>
                        </div>
                        <div class="flex justify-center mt-4">
                            <a href="{{ route('admin.edit-kegiatan', $kegiatan->id) }}"
                                class="mx-2 text-yellow-600 hover:text-gray-900">
                                <button type="button">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </a>

                            <form class="delete-form" action="{{ route('admin.destroy-kegiatan', $kegiatan->id) }}"
                                method="POST">
                                @csrf
                                <button type="button" data-id="{{ $kegiatan->id }}"
                                    class="delete-button mx-2 text-red-600 hover:text-gray-900">
                                    <i class="fas fa-trash"></i>
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
                    class="fixed bottom-4 right-4 bg-green-600 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 mr-4"
                    aria-label="Tambah Kegiatan">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </a>
        </div>
    </main>

    <!-- Modal -->
    <div id="commentModal"
        class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center z-50 transition-opacity duration-300">
        <div class="modal-content bg-white p-6 rounded-lg w-1/2 mx-auto shadow-lg">
            <div class="modal-header flex justify-between items-center mb-4">
                <h2 id="modalTitle" class="text-xl font-bold">Komentar</h2>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
            </div>
            <div id="modalContent" class="modal-body">
                <form id="commentForm" method="POST" action="{{ route('store.komentar-kegiatan') }}" class="mt-2">
                    @csrf
                    <input type="hidden" name="kegiatan_id" id="kegiatan_id" />
                    <textarea class="w-full p-2 mb-1 text-gray-800 border border-gray-300 rounded-md" rows="3" name="isi_komentar"
                        placeholder="Tulis komentar anda..."></textarea>
                    <button type="submit"
                        class="text-white hover:bg-blue-700 px-4 py-2 mt-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50"
                        style="background-color: #1D4ED8 !important;">
                        Submit
                    </button>
                </form>
                <div id="commentContainer" class="comments mt-4 text-sm text-gray-700 overflow-y-auto"
                    style="max-height: 300px;">
                    <p id="loadingText" class="hidden">Memuat komentar...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('commentModal');
            const commentContainer = document.getElementById('commentContainer');
            const closeModalButton = document.getElementById('closeModal');
            const commentForm = document.getElementById('commentForm');
            const kegiatanIdInput = document.getElementById('kegiatan_id');

            // Tombol untuk membuka modal komentar
            document.querySelectorAll('.commentBtn').forEach(button => {
                button.addEventListener('click', async function() {
                    const kegiatanId = this.getAttribute('data-kegiatan-id');
                    kegiatanIdInput.value = kegiatanId;

                    try {
                        // Fetch komentar untuk kegiatan tertentu
                        const response = await fetch(`kegiatan/${kegiatanId}/comments`);
                        const comments = await response.json();

                        // Batasi jumlah komentar yang ditampilkan (maksimal 10 komentar)
                        const limitedComments = comments.slice(0, 10);

                        // Render komentar ke dalam container
                        renderComments(limitedComments, kegiatanId);
                    } catch (error) {
                        commentContainer.innerHTML =
                            '<p class="text-red-500">Gagal memuat komentar. Silakan coba lagi.</p>';
                        console.error('Error loading comments:', error);
                    }
                    modal.classList.remove('hidden');
                });
            });

            // Tombol untuk menutup modal
            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            // Fungsi untuk merender komentar
            function renderComments(comments, kegiatanId) {
                commentContainer.innerHTML = comments.map(comment => `
            <div class="comment flex flex-col border-b border-gray-300 py-2" data-comment-id="${comment.id}" data-kegiatan-id="${kegiatanId}">
                <div class="flex items-start">
                    <strong class="mr-1">${comment.nama}:</strong>
                    <p class="text-gray-800">${comment.isi_komentar}</p>
                </div>
                <div class="flex space-x-2 mt-2">
                    <button class="text-red-500 hover:underline delete-btn" data-comment-id="${comment.id}" data-kegiatan-id="${kegiatanId}">
                        Delete
                    </button>
                </div>
            </div>
        `).join('');

                // Menambahkan event listener untuk tombol hapus
                attachDeleteHandlers();
            }

            // Fungsi untuk menambahkan event listener pada tombol hapus
            function attachDeleteHandlers() {
                document.querySelectorAll('.delete-btn').forEach(button => {
                    button.addEventListener('click', async function() {
                        const commentId = this.getAttribute('data-comment-id');

                        // Konfirmasi penghapusan
                        const confirmDelete = confirm(
                            'Apakah Anda yakin ingin menghapus komentar ini?');
                        if (!confirmDelete) return;

                        try {
                            const response = await fetch(
                                `{{ url('admin/kegiatan/komentar/destroy') }}/${commentId}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').content
                                    }
                                });

                            if (response.ok) {
                                this.closest('.comment').remove();
                            } else {
                                alert('Gagal menghapus komentar. Silakan coba lagi.');
                            }
                        } catch (error) {
                            console.error('Gagal menghapus komentar:', error);
                            alert(
                                'Terjadi kesalahan saat menghapus komentar. Silakan coba lagi.'
                            );
                        }
                    });
                });
            }


            // commentForm.addEventListener('submit', function(event) {
            //     event
            //         .preventDefault(); // Menangani form dengan JavaScript, tetapi akan dikirim menggunakan standar form

            //     // Menetapkan nilai kegiatan_id jika belum diatur
            //     if (!kegiatanIdInput.value) {
            //         kegiatanIdInput.value = 'default_kegiatan_id'; // Ganti dengan ID yang sesuai
            //     }

            //     // Mengirimkan form menggunakan submit standar
            //     commentForm.submit(); // Form akan dikirim ke server secara standar
            // });
            // // Event listener untuk pengiriman komentar baru


        });
    </script>



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
