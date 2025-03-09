<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>
    @include('layouts.style-user')
</head>

<body class="min-h-screen flex flex-col font-poppins">
    <main class="flex-grow top-0">
        @include('layouts.nav-pui')
        @yield('content')
    </main>
    @include('layouts.footer')

    <!-- Link JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="{{ asset('js/js-web.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('commentModal');
            const commentContainer = document.getElementById('commentContainer');
            const closeModalButton = document.getElementById('closeModal');
            const commentForm = document.getElementById('commentForm');
            const articleIdInput = document.getElementById('article_id');

            // Tombol untuk membuka modal komentar
            document.querySelectorAll('.commentBtn').forEach(button => {
                button.addEventListener('click', async function() {
                    const articleId = this.getAttribute('data-article-id');
                    articleIdInput.value = articleId;

                    try {
                        // Fetch komentar untuk artikel tertentu
                        const response = await fetch(
                            `/sumberdaya/artikel/${articleId}/comments`);
                        const comments = await response.json();

                        // Batasi jumlah komentar yang ditampilkan (maksimal 10 komentar)
                        const limitedComments = comments.slice(0, 10);

                        // Render komentar ke dalam container
                        renderComments(limitedComments, articleId);
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
            function renderComments(comments, articleId) {
                commentContainer.innerHTML = comments.map(comment => `
                <div class="comment flex flex-col border-b border-gray-300 py-2" data-comment-id="${comment.id}" data-article-id="${articleId}">
                    <div class="flex items-start">
                        <strong class="mr-1">${comment.nama}:</strong>
                        <p class="text-gray-800">${comment.isi_komentar}</p>
                        <button class="ml-3 text-blue-500 hover:underline reply-btn" data-comment-id="${comment.id}" data-article-id="${articleId}">
                            Balas
                        </button>
                    </div>
                    <div class="replies-container ml-4 mt-2">
                        ${renderReplies(comment.replies)}
                    </div>
                </div>
            `).join('');

                // Menambahkan event listener untuk tombol reply
                attachReplyHandlers();
            }

            // Fungsi untuk merender balasan (nested comments)
            function renderReplies(replies) {
                if (!replies || replies.length === 0) return '';

                return replies.map(reply => `
                <div class="comment flex flex-col border-b border-gray-300 py-2 ml-4" data-comment-id="${reply.id}">
                    <div class="flex items-start">
                        <strong class="mr-1">${reply.nama}:</strong>
                        <p class="text-gray-800">${reply.isi_komentar}</p>
                        <button class="ml-3 text-blue-500 hover:underline reply-btn" data-comment-id="${reply.id}">
                            Balas
                        </button>
                    </div>
                    <div class="replies-container ml-4 mt-2">
                        ${renderReplies(reply.replies)} <!-- Rekursi untuk balasan lebih dalam -->
                    </div>
                </div>
            `).join('');
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
                        <div class="mb-2">
                            <input name="nama" class="w-full p-2 border border-gray-400 rounded" placeholder="Nama" />
                        </div>
                        <button class="submit-reply-btn text-white bg-green-600 px-4 py-2 rounded-md hover:bg-green-700">Kirim</button>
                    `;

                        // Tambahkan form ke dalam replies-container
                        const repliesContainer = commentElement.querySelector('.replies-container');
                        repliesContainer.appendChild(replyForm);

                        // Event listener untuk tombol submit balasan
                        replyForm.querySelector('.submit-reply-btn').addEventListener('click',
                            async function() {
                                const namaInput = replyForm.querySelector(
                                    'input[name="nama"]').value;
                                const replyContent = replyForm.querySelector('textarea')
                                    .value;

                                try {
                                    // Data yang akan dikirim
                                    const requestData = {
                                        nama: namaInput,
                                        isi_komentar: replyContent,
                                        article_id: articleId,
                                        parent_id: commentId, // Kirim parent_id untuk balasan
                                    };

                                    // Kirim balasan ke server
                                    const response = await fetch(
                                        '{{ route('store.komentar-artikel') }}', {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': document.querySelector(
                                                        'meta[name="csrf-token"]')
                                                    .content,
                                                'Content-Type': 'application/json',
                                            },
                                            body: JSON.stringify(requestData),
                                        });

                                    const responseData = await response.json();

                                    if (response.ok) {
                                        // Jika berhasil, tambahkan balasan ke DOM
                                        const newReply = document.createElement('div');
                                        newReply.classList.add('reply', 'ml-4', 'border-l',
                                            'pl-4', 'mt-2');
                                        newReply.innerHTML = `
                                    <div class="comment flex flex-col border-b border-gray-300 py-2" data-comment-id="${responseData.comment.id}">
                                        <div class="flex items-start">
                                            <strong class="mr-1">${responseData.comment.nama}:</strong>
                                            <p class="text-gray-800">${responseData.comment.isi_komentar}</p>
                                            <button class="ml-3 text-blue-500 hover:underline reply-btn" data-comment-id="${responseData.comment.id}" data-article-id="${articleId}">
                                                Balas
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
                                    }
                                } catch (error) {
                                    console.error('Error submitting reply:', error);
                                }
                            });
                    });
                });
            }

            // Event listener untuk form komentar baru
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
                        body: formData,
                    });

                    const responseData = await response.json();

                    if (response.ok) {
                        // Buat elemen komentar baru dan tambahkan ke DOM
                        const newComment = `
                        <div class="comment flex flex-col border-b border-gray-300 py-2" data-comment-id="${responseData.comment.id}" data-article-id="${articleId}">
                            <div class="flex items-start">
                                <strong class="mr-1">${responseData.comment.nama}:</strong>
                                <p class="text-gray-800">${responseData.comment.isi_komentar}</p>
                            </div>
                            <div class="flex space-x-2 mt-2">
                                <button class="text-blue-500 hover:underline reply-btn" data-comment-id="${responseData.comment.id}" data-article-id="${articleId}">
                                    Balas
                                </button>
                            </div>
                            <div class="replies-container ml-4 mt-2"></div>
                        </div>
                    `;

                        // Tambahkan komentar baru di bagian atas
                        commentContainer.insertAdjacentHTML('afterbegin', newComment);

                        // Re-attach event listeners untuk tombol reply
                        attachReplyHandlers();

                        // Reset form
                        commentForm.reset();
                    }
                } catch (error) {
                    console.error('Error submitting comment:', error);
                }
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle comment buttons for activities (kegiatan)
            const commentButtons = document.querySelectorAll('.commentKegiatanBtn');
            const modal = document.getElementById('commentKegiatanModal');
            const closeModalButton = document.getElementById('closeKegiatanModal');
            const modalContent = document.getElementById('modalCommentKegiatanContent');

            commentButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const kegiatanId = this.getAttribute('data-kegiatan-id');

                    // Add the comment form to the modal
                    modalContent.innerHTML = `
                        <form action="{{ route('store.komentar-kegiatan') }}" method="POST">
                            @csrf
                            <input type="hidden" name="kegiatan_id" value="${kegiatanId}">
                            <div class="mb-2">
                                <textarea name="isi_komentar" rows="4" class="w-full p-2 border border-gray-400 rounded" placeholder="Tulis Komentar Anda......"></textarea>
                                </div>
                                <div class="mb-2">
                                    <input name="nama" class="w-full p-2 border border-gray-400 rounded" placeholder="Nama" />
                                </div>                            
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-600">Kirim</button>
                        </form>
                    `;
                    // Show modal
                    modal.classList.remove('hidden');
                });
            });

            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });
        });
    </script>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchButton = document.getElementById("searchButton");
            const searchBox = document.getElementById("searchBox");
            const searchInput = searchBox.querySelector("input");

            const searchButtonMobile = document.getElementById("searchButtonMobile");
            const searchBoxMobile = document.getElementById("searchBoxMobile");
            const searchInputMobile = searchBoxMobile.querySelector("input");

            // Fungsi untuk menangani tampilan kotak pencarian dan pencarian
            function handleSearch(button, searchBox, searchInput) {
                button.addEventListener("click", function(event) {
                    event.stopPropagation(); // Mencegah event bubbling
                    searchBox.classList.toggle("hidden");
                    if (!searchBox.classList.contains("hidden")) {
                        searchInput.focus();
                    } else {
                        clearHighlights(); // Hapus sorotan jika kotak pencarian ditutup
                    }
                });

                // Menangani pencarian ketika menekan tombol Enter
                searchInput.addEventListener("keypress", function(event) {
                    if (event.key === "Enter") {
                        event.preventDefault();
                        clearHighlights();
                        const firstMatchElement = highlightText(document.body, searchInput.value);
                        if (firstMatchElement) {
                            scrollToElement(firstMatchElement);
                        }
                    }
                });
            }

            // Panggil fungsi untuk desktop dan mobile
            handleSearch(searchButton, searchBox, searchInput);
            handleSearch(searchButtonMobile, searchBoxMobile, searchInputMobile);

            // Fungsi untuk menyorot teks pencarian
            function highlightText(element, searchTerm) {
                if (!searchTerm) return null;

                const regex = new RegExp(`(${searchTerm})`, "gi");
                const walker = document.createTreeWalker(
                    element,
                    NodeFilter.SHOW_TEXT,
                    null,
                    false
                );

                const nodesToReplace = [];
                let firstMatchElement = null;

                while (walker.nextNode()) {
                    const currentNode = walker.currentNode;
                    if (regex.test(currentNode.textContent)) {
                        nodesToReplace.push(currentNode);
                    }
                }

                nodesToReplace.forEach((node) => {
                    const parent = node.parentNode;
                    const highlightedSpan = document.createElement("span");
                    highlightedSpan.innerHTML = node.textContent.replace(
                        regex,
                        "<mark>$1</mark>"
                    );
                    parent.replaceChild(highlightedSpan, node);

                    if (!firstMatchElement) {
                        firstMatchElement = highlightedSpan;
                    }
                });

                return firstMatchElement;
            }

            // Fungsi untuk menghapus semua sorotan teks
            function clearHighlights() {
                const highlightedElements = document.querySelectorAll("mark");
                highlightedElements.forEach((mark) => {
                    const parent = mark.parentNode;
                    parent.replaceChild(
                        document.createTextNode(mark.textContent),
                        mark
                    );
                    parent.normalize(); // Gabungkan kembali node teks jika perlu
                });
            }

            // Fungsi untuk menggulir ke elemen yang disorot
            function scrollToElement(element) {
                element.scrollIntoView({
                    behavior: "smooth",
                    block: "center",
                });
            }

            // Event listener untuk menghapus sorotan saat klik di luar
            document.addEventListener("click", function(event) {
                if (
                    !searchBox.contains(event.target) &&
                    !searchButton.contains(event.target) &&
                    !searchBoxMobile.contains(event.target) &&
                    !searchButtonMobile.contains(event.target)
                ) {
                    clearHighlights();
                    searchBox.classList.add("hidden");
                    searchBoxMobile.classList.add("hidden");
                }
            });
        });
    </script>

</body>

</html>
