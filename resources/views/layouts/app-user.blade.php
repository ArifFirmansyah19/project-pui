<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> @yield('title') </title>
    @include('layouts.style-user')
</head>

<body class=" min-h-screen flex flex-col font-roboto">
    <main class="flex-grow ">
        @include('layouts.nav-pui')
        @yield('content')
    </main>
    @include('layouts.footer')

    <!--  link JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <!--  link JavaScript tambahan -->
    {{-- <script src="../js/js-web.js"></script> --}}
    <script src="{{ asset('js/js-web.js') }}"></script>
    {{-- @yield('scripts') --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const commentButtons = document.querySelectorAll('.commentBtn');
            const modal = document.getElementById('commentModal');
            const closeModalButton = document.getElementById('closeModal');
            const modalContent = document.getElementById('modalContent');

            commentButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const articleId = this.getAttribute('data-article-id');

                    // Tambahkan formulir komentar ke dalam modal
                    modalContent.innerHTML = `
                        <form action="{{ route('store.komentar-artikel') }}" method="POST">
                            @csrf
                            <input type="hidden" name="article_id" value="${articleId}">
                            <div class="mb-2">
                                <input name="nama" rows="4" class="w-full p-2 border border-gray-400 rounded"
                                    placeholder="Masukkan nama anda"></input>
                            </div>                            
                            <div class="mb-2">
                                <textarea name="isi_komentar" rows="4" class="w-full p-2 border border-gray-400 rounded"
                                    placeholder="Tulis komentar..."></textarea>
                            </div>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">kirim</button>
                        </form>
                    `;

                    // Tampilkan modal
                    modal.classList.remove('hidden');
                });
            });

            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const commentButtons = document.querySelectorAll('.commentKegiatanBtn');
            const modal = document.getElementById('commentKegiatanModal');
            const closeModalButton = document.getElementById('closeKegiatanModal');
            const modalContent = document.getElementById('modalCommentKegiatanContent');

            commentButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const kegiatanId = this.getAttribute('data-kegiatan-id');

                    // Tambahkan formulir komentar ke dalam modal
                    modalContent.innerHTML = `
                        <form action="{{ route('store.komentar-kegiatan') }}" method="POST">
                            @csrf
                            <input type="hidden" name="kegiatan_id" value="${kegiatanId}">
                            <div class="mb-2">
                                <input name="nama" rows="4" class="w-full p-2 border border-gray-400 rounded"
                                    placeholder="Masukkan nama anda"></input>
                            </div>                            
                            <div class="mb-2">
                                <textarea name="isi_komentar" rows="4" class="w-full p-2 border border-gray-400 rounded"
                                    placeholder="Tulis komentar..."></textarea>
                            </div>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">kirim</button>
                        </form>
                    `;

                    // Tampilkan modal
                    modal.classList.remove('hidden');
                });
            });

            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });
        });
    </script>

</body>

</html>
