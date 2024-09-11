@extends('layouts.app-admin')
@section('title', 'halaman detail Artikel admin')
@section('content-admin')
    <!--konten detail artikel -->
    <div class="flex justify-center bg-gray-600">
        <div class="max-w-4xl w-full py-8 px-4 bg-gray-300">
            <div class="max-w-4xl w-full py-8 px-4 bg-gray-300">

                <!-- Floating Action Button -->
                <a href="{{ route('admin.artikel') }}">
                    <button
                        class="fixed bottom-4 left-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
                        aria-label="Kembali">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                </a>

                <div class="bg-gray-300 shadow-md rounded-lg px-8 py-0">
                    <h1 class="text-4xl font-bold text-indigo-900">
                        {{ $article->judul }}
                    </h1>

                    <!-- Artikel -->
                    <div class="mb-8">
                        <p class="text-sm text-gray-500 mb-2">Diunggah pada : {{ $article->formatted_created_at }}</p>
                        @if ($article->foto_artikel)
                            <img src="{{ asset('storage/' . $article->foto_artikel) }}"
                                alt="Foto Artikel {{ $article->judul }} " class="w-full max-w-md mx-auto rounded-lg mb-6">
                        @else
                        @endif
                        <p class="text-gray-800 p-5 leading-relaxed">
                            {!! $article->abstract !!}
                            <br>
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
                        <br>

                    </div>
                </div>

                {{--  Komentar --}}
                <div class="container mx-auto">
                    <h2 class="text-2xl font-bold mb-4">Comments</h2>

                    {{-- Tampilkan komentar utama --}}
                    @foreach ($commentArticles as $commentArticle)
                        <div class="mb-4 p-4 bg-white rounded shadow">
                            <!-- Tampilkan komentar utama terlebih dahulu -->
                            @include('admin.sumberdaya.artikel._comment', [
                                'comment' => $commentArticle,
                            ])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function toggleReplies(commentId) {
            const replies = document.getElementById(`replies-${commentId}`);
            if (replies.classList.contains('hidden')) {
                replies.classList.remove('hidden');
            } else {
                replies.classList.add('hidden');
            }
        }

        function toggleReplyForm(commentId) {
            const form = document.getElementById(`reply-form-${commentId}`);
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
            } else {
                form.classList.add('hidden');
            }
        }
    </script>

@endsection
