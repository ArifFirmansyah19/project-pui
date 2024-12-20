@extends('layouts.app-user')
@section('title', 'Detail Artikel PUI GEMAR')

@section('content')

    <!--konten detail artikel -->
    <div class="flex justify-center bg-gray-600">
        <div class="max-w-4xl w-full py-8 px-2 bg-gray-300">
            <div class="max-w-4xl w-full py-8 bg-gray-300">
                <div class="bg-gray-300 shadow-md rounded-lg px-8 py-0">
                    <h1 class="text-4xl font-bold text-indigo-900">
                        {{ $article->judul }}
                    </h1>
                    <!-- Detail Artikel -->
                    <div class="mb-8 pt-2">
                        <p class="text-sm text-gray-500 mb-1">Penulis: {{ $article->penulis }}</p>
                        <p class="text-sm text-gray-500 mb-4">Tanggal: 01 April 2024</p>

                        @if ($article->foto_artikel)
                            <img src="{{ asset('storage/' . $article->foto_artikel) }}"
                                alt="gambar_artikel {{ $article->judul }}" style="width: 80%px; height:500px">
                            <br>
                        @else
                        @endif
                        <br>
                        <p class="text-gray-800 leading-relaxed text-justify">
                            {!! $article->abstract !!}
                        </p>
                        <br>

                        @if ($article->file_path)
                            <!-- Container untuk PDF -->
                            <div id="pdf-container">
                                <!-- Loading indicator -->
                                <p>Loading PDF...</p>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var pdfUrl = "{{ $article->file_path }}";
                                    var container = document.getElementById('pdf-container');

                                    // Cek apakah URL PDF dapat diakses
                                    fetch(pdfUrl, {
                                            method: 'HEAD'
                                        })
                                        .then(response => {
                                            if (response.ok) {
                                                // Jika PDF dapat diakses, tampilkan di iframe
                                                container.innerHTML = `
                                                <iframe src="${pdfUrl}" type="application/pdf" width="100%" height="700px">
                                                    Your browser does not support PDFs. <a href="${pdfUrl}">Link Ke File Article yang Dimaksud</a>.
                                                </iframe>
                                            `;
                                            } else {
                                                // Jika PDF tidak dapat diakses, tampilkan link
                                                container.innerHTML = `
                                                <a href="${pdfUrl}" target="_blank" class="text-blue-500 underline">
                                                    Link Ke File Article yang Dimaksud
                                                </a>
                                            `;
                                            }
                                        })
                                        .catch(() => {
                                            // Jika ada kesalahan dalam permintaan fetch, tampilkan link
                                            container.innerHTML = `
                                            <a href="${pdfUrl}" target="_blank" class="text-blue-500 underline">
                                                Link Ke File Article yang Dimaksud
                                            </a>
                                        `;
                                        });
                                });
                            </script>
                        @endif
                        <br>
                    </div>
                </div>
            </div>

            <!-- Bagian komentar -->
            <div class="mt-10">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Komentar</h2>
                <div id="comments-container" class="space-y-4">
                    <!-- Comment Form -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold mb-2">Tulis Komentar</h3>
                        <form method="POST" action="{{ route('store.komentar-artikel') }}" class="mb-4">
                            @csrf
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <div class="mb-2">
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                                <input type="text" name="nama" class="border rounded w-full py-2 px-3"
                                    placeholder="Masukkan namamu">
                            </div>
                            <div class="mb-2">
                                <label for="isi_komentar" class="block text-sm font-medium text-gray-700">Isi
                                    Komentar</label>
                                <textarea name="isi_komentar" class="border rounded w-full py-2 px-3" placeholder="Isi Komentar"></textarea>
                            </div>
                            <button type="submit"
                                class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Comment List -->
            <div class="mt-10 comment-list">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Komentar</h2>

                <!-- munculin komentar kegiatan -->
                @foreach ($commentArticles as $commentArticle)
                    @include('user.sumberdaya.artikel._comment', [
                        'commentArticle' => $commentArticle,
                    ])
                @endforeach
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function toggleReplies(id) {
            var repliesElement = document.getElementById('replies-' + id);
            if (repliesElement.classList.contains('hidden')) {
                repliesElement.classList.remove('hidden');
            } else {
                repliesElement.classList.add('hidden');
            }
        }

        function toggleReplyForm(id) {
            var formElement = document.getElementById('reply-form-' + id);
            if (formElement.classList.contains('hidden')) {
                formElement.classList.remove('hidden');
            } else {
                formElement.classList.add('hidden');
            }
        }
    </script>
