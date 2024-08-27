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
                    <h1 class="text-4xl font-bold text-indigo-900 mb-0 mt-20">
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
                            {!! $article->deskripsi !!}
                            <br>
                        </p>
                    </div>

                </div>
                {{-- testing Komentar --}}
                <div class="container mx-auto">
                    <h2 class="text-2xl font-bold mb-4">Comments</h2>

                    {{-- munculin komentarkegiatan --}}
                    @foreach ($commentArticles as $commentArticle)
                        @include('admin.sumberdaya.artikel._comment', [
                            'commentArticle' => $commentArticle,
                        ])
                    @endforeach
                </div>

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
@endsection
