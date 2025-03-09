@extends('layouts.app-admin')
@section('title', 'Halaman Artikel Admin')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 overflow-y-auto mx-3">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h1 class="text-4xl font-bold text-indigo-900 mt-6 mb-5">Artikel</h1>
            @if ($articles->isEmpty())
                <div class="flex justify-center items-center">
                    <div class="text-center max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                        <h5 class="mb-2 text-2xl font-bold text-gray-900">Mohon Maaf Admin</h5>
                        <p class="text-gray-700">Saat ini kamu tidak memiliki data artikel apapun. Mulailah untuk menambahkan
                            artikel baru.</p>
                    </div>
                </div>
            @else
                @foreach ($articles as $article)
                    <div class="mb-8 mt-12">
                        <a href="{{ $article->file_path }}"
                            class="block text-xl font-semibold text-indigo-900 mb-0">{{ $article->judul }}</a>
                        <p class="text-sm text-gray-500 mb-2">Penulis: {{ $article->penulis }}</p>
                        <p class="text-gray-800 leading-relaxed text-justify">{!! $article->abstract !!}</p>
                        <div class="flex items-center mt-4 space-x-4">
                            <button class="commentBtn text-gray-400 hover:text-blue-400 transition duration-300"
                                data-article-id="{{ $article->id }}">
                                <i class="far fa-comment mr-1"></i><span
                                    class="commentCount">{{ $article->totalComments }}</span>
                            </button>
                        </div>

                        <div class="flex justify-end mt-2">
                            <a href="{{ route('admin.edit-artikel', $article->id) }}"
                                class="mx-2 text-amber-500 hover:text-amber-600">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form class="delete-form" action="{{ route('admin.destroy-artikel', $article->id) }}"
                                method="POST">
                                @csrf
                                <button type="button" data-id="{{ $article->id }}"
                                    class="delete-button mx-2 text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        <hr class="border-gray-800 my-1" />
                    </div>
                @endforeach
                <div class="mt-auto mb-0 px-3 flex justify-start">
                    {{ $articles->links() }}
                </div>
            @endif
            <a href="{{ route('admin.create-artikel') }}">
                <button
                    class="fixed bottom-4 right-4 bg-green-600 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-green-700">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </a>
        </div>
    </main>

    <div id="commentModal"
        class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center z-50 transition-opacity duration-300">
        <div class="modal-content bg-white p-6 rounded-lg w-1/2 mx-auto shadow-lg">
            <div class="modal-header flex justify-between items-center mb-4">
                <h2 id="modalTitle" class="text-xl font-bold">Komentar</h2>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
            </div>
            <div id="modalContent" class="modal-body">
                <form id="commentForm" method="POST" class="mt-2">
                    @csrf
                    <input type="hidden" name="article_id" id="article_id" />
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
            const articleIdInput = document.getElementById('article_id');
            let currentCommentPage = 1;

            // Fungsi untuk menangani tombol delete
            function attachDeleteHandlers() {
                document.querySelectorAll('.delete-btn').forEach(button => {
                    button.addEventListener('click', async function() {
                        const commentId = this.getAttribute('data-comment-id');
                        const articleId = this.getAttribute('data-article-id');

                        const confirmDelete = confirm(
                            'Apakah Anda yakin ingin menghapus komentar ini?');
                        if (!confirmDelete) return;

                        try {
                            const response = await fetch(
                                `/admin/artikel/${articleId}/destroy/komentar/${commentId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').content
                                    }
                                });

                            const responseData = await response.json();

                            if (response.ok) {
                                const commentElement = document.querySelector(
                                    `.comment[data-comment-id="${commentId}"]`);
                                if (commentElement) {
                                    commentElement.remove();
                                }
                                alert(responseData.message);
                            } else {
                                alert(responseData.message || 'Gagal menghapus komentar.');
                            }
                        } catch (error) {
                            console.error('Error deleting comment:', error);
                            alert('Terjadi kesalahan saat menghapus komentar.');
                        }
                    });
                });
            }

            // Fungsi untuk menambahkan event listener pada tombol reply
            function attachReplyHandlers() {
                document.querySelectorAll('.reply-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const commentId = this.getAttribute('data-comment-id');
                        const articleId = this.getAttribute('data-article-id');
                        const commentElement = document.querySelector(
                            `.comment[data-comment-id="${commentId}"]`);

                        // Periksa apakah form reply sudah ada
                        let replyForm = commentElement.querySelector('.reply-form');
                        if (replyForm) {
                            return; // Jika form sudah ada, jangan tambahkan form lagi
                        }

                        // Buat form reply baru
                        replyForm = document.createElement('div');
                        replyForm.classList.add('reply-form', 'mt-4', 'bg-gray-200', 'p-4',
                            'rounded-md', 'ml-8');
                        replyForm.innerHTML = `
                        <textarea class="w-full p-2 mb-2 border border-gray-300 rounded-md" rows="2" placeholder="Tulis balasan..."></textarea>
                        <button class="submit-reply-btn text-white bg-green-600 px-4 py-2 rounded-md hover:bg-green-700">Submit</button>
                    `;

                        // Tambahkan form ke dalam replies-container
                        const repliesContainer = commentElement.querySelector('.replies-container');
                        repliesContainer.appendChild(replyForm);

                        // Event listener untuk tombol submit balasan
                        replyForm.querySelector('.submit-reply-btn').addEventListener('click',
                            async function() {
                                const replyContent = replyForm.querySelector('textarea')
                                    .value;

                                if (!replyContent) {
                                    alert('Balasan tidak boleh kosong.');
                                    return;
                                }

                                try {
                                    // Kirim balasan menggunakan form standar
                                    const formData = new FormData();
                                    formData.append('isi_komentar', replyContent);
                                    formData.append('article_id', articleId);
                                    formData.append('parent_id',
                                        commentId); // Kirim parent_id untuk balasan

                                    const response = await fetch(
                                        '{{ route('store.komentar-artikel') }}', {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': document.querySelector(
                                                        'meta[name="csrf-token"]')
                                                    .content,
                                            },
                                            body: formData
                                        });

                                    const responseData = await response.json();

                                    if (response.ok) {
                                        const newReply = document.createElement('div');
                                        newReply.classList.add('reply', 'ml-4', 'border-l',
                                            'pl-4', 'mt-2');
                                        newReply.innerHTML = `
                                    <div class="comment flex flex-col border-b border-gray-300 py-2" data-comment-id="${responseData.comment.id}">
                                        <div class="flex items-start">
                                            <strong class="mr-1">${responseData.comment.nama}:</strong>
                                            <p class="text-gray-800">${responseData.comment.isi_komentar}</p>
                                        </div>
                                        <div class="flex space-x-2 mt-2">
                                            <button class="text-blue-500 hover:underline reply-btn" data-comment-id="${responseData.comment.id}" data-article-id="${articleId}">
                                                Reply
                                            </button>
                                            <button class="text-red-500 hover:underline delete-btn" data-comment-id="${responseData.comment.id}" data-article-id="${articleId}">
                                                Delete
                                            </button>
                                        </div>
                                        <div class="replies-container ml-4 mt-2"></div>
                                    </div>
                                `;
                                        repliesContainer.appendChild(newReply);

                                        // Reset form setelah balasan dikirim
                                        replyForm.remove();

                                        // Re-attach event listeners untuk balasan baru
                                        attachReplyHandlers();
                                        attachDeleteHandlers();
                                    } else {
                                        alert(responseData.message ||
                                            'Gagal mengirim balasan.');
                                    }
                                } catch (error) {
                                    console.error('Error submitting reply:', error);
                                    alert('Terjadi kesalahan saat mengirim balasan.');
                                }
                            });
                    });
                });
            }

            // Fungsi untuk mengirimkan komentar baru
            commentForm.addEventListener('submit', async function(event) {
                event.preventDefault();

                const formData = new FormData(commentForm);
                const articleId = articleIdInput.value;

                try {
                    const response = await fetch('{{ route('store.komentar-artikel') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content,
                        },
                        body: formData
                    });

                    const responseData = await response.json();

                    if (response.ok) {
                        const newComment = `
                        <div class="comment flex flex-col border-b border-gray-300 py-2" data-comment-id="${responseData.comment.id}" data-article-id="${articleId}">
                            <div class="flex items-start">
                                <strong class="mr-1">${responseData.comment.nama}:</strong>
                                <p class="text-gray-800">${responseData.comment.isi_komentar}</p>
                            </div>
                            <div class="flex space-x-2 mt-2">
                                <button class="text-blue-500 hover:underline reply-btn" data-comment-id="${responseData.comment.id}" data-article-id="${articleId}">
                                    Reply
                                </button>
                                <button class="text-red-500 hover:underline delete-btn" data-comment-id="${responseData.comment.id}" data-article-id="${articleId}">
                                    Delete
                                </button>
                            </div>
                        </div>
                    `;
                        commentContainer.insertAdjacentHTML('afterbegin', newComment);

                        commentForm.reset();
                        attachReplyHandlers();
                        attachDeleteHandlers();
                    } else {
                        alert(responseData.message || 'Gagal mengirim komentar.');
                    }
                } catch (error) {
                    console.error('Error submitting comment:', error);
                    alert('Terjadi kesalahan saat mengirim komentar.');
                }
            });

            // Fungsi untuk memuat komentar
            async function loadComments(articleId, page = 1) {
                try {
                    const response = await fetch(`artikel/${articleId}/comments?page=${page}`);
                    if (!response.ok) {
                        throw new Error('Gagal memuat komentar');
                    }

                    const comments = await response.json();
                    if (page === 1) {
                        commentContainer.innerHTML = '';
                    }

                    comments.forEach(comment => {
                        const commentElement = document.createElement('div');
                        commentElement.classList.add('comment');
                        commentElement.innerHTML = `
                            <div class="comment flex flex-col border-b border-gray-300 py-2" data-comment-id="${comment.id}" data-article-id="${articleId}">
                                <div class="flex items-start">
                                    <strong class="mr-1">${comment.nama}:</strong>
                                    <p class="text-gray-800">${comment.isi_komentar}</p>
                                </div>
                                <div class="flex space-x-2 mt-2">
                                    <button class="text-blue-500 hover:underline reply-btn" data-comment-id="${comment.id}" data-article-id="${articleId}">
                                        Reply
                                    </button>
                                    <button class="text-red-500 hover:underline delete-btn" data-comment-id="${comment.id}" data-article-id="${articleId}">
                                        Delete
                                    </button>
                                </div>
                                <div class="replies-container ml-4 mt-2"></div>
                            </div>
                        `;

                        commentContainer.insertAdjacentElement('afterbegin', commentElement);
                    });

                    attachReplyHandlers();
                    attachDeleteHandlers();

                    if (comments.length === 10) {
                        const loadMoreButton = document.createElement('button');
                        loadMoreButton.classList.add('text-blue-500', 'hover:underline', 'mt-4');
                        loadMoreButton.textContent = 'Lihat lebih banyak komentar';
                        loadMoreButton.addEventListener('click', function() {
                            currentCommentPage++;
                            loadComments(articleId, currentCommentPage);
                            loadMoreButton.remove();
                        });
                        commentContainer.appendChild(loadMoreButton);
                    }
                } catch (error) {
                    commentContainer.innerHTML =
                        '<p class="text-red-500">Gagal memuat komentar. Silakan coba lagi.</p>';
                    console.error('Error loading comments:', error);
                }
            }

            // Menangani tombol untuk membuka modal
            document.querySelectorAll('.commentBtn').forEach(button => {
                button.addEventListener('click', function() {
                    const articleId = this.getAttribute('data-article-id');
                    articleIdInput.value = articleId;
                    currentCommentPage = 1;
                    loadComments(articleId);
                    modal.classList.remove('hidden');
                });
            });

            // Tombol untuk menutup modal
            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });
        });
    </script>

    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form'); // Temukan formulir terdekat dari tombol
                const articleId = this.getAttribute('data-id');
                event.preventDefault(); // Cegah tindakan default

                Swal.fire({
                    title: 'Apakah Anda yakin ingin menghapus?',
                    text: "Data Kontak yang Dihapus Akan Hilang!",
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
