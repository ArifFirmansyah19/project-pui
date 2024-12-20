@extends('layouts.app-user')
@section('title', 'Artikel PUI GEMAR')

@section('content')
    <div class="flex justify-center min-h-screen bg-gray-600">
        <div class="max-w-4xl w-full p-6 bg-gray-300">
            <div class="bg-gray-300 shadow-md rounded-lg px-8 py-6">
                <h1 class="text-4xl font-bold text-indigo-900 mb-8 ">
                    Artikel
                </h1>

                @foreach ($articles as $article)
                    <!-- Artikel -->
                    <div class="mb-4 mt-2">
                        <a href="{{ $article->file_path }}"
                            class="block text-xl font-semibold text-indigo-900 mb-0">{{ $article->judul }}</a>
                        <p class="text-sm text-gray-500 mb-2">{{ $article->formatted_created_at }}</p>
                        <p class="text-sm text-gray-800">
                            {{ implode("\n", array_slice(explode("\n", wordwrap(strip_tags($article->abstract), 150, "\n")), 0, 8)) }}
                            ........
                        </p>
                    </div>
                    <div class="flex items-center mt-4 space-x-4">
                        <button
                            class="flex items-center text-gray-400 hover:text-blue-400 transition duration-300 commentBtn"
                            data-article-id="{{ $article->id }}">
                            <i class="far fa-comment mr-1"></i>
                            <span class="commentCount">{{ $article->totalComments }}</span>
                        </button>
                    </div>
                    <hr class="border-gray-800 my-1" />
                @endforeach
                <div class="mt-auto mb-0 px-3 flex justify-start">
                    {{ $articles->links() }}
                </div>

            </div>
        </div>
    </div>



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
                    <div class="mb-2">
                        <input name="nama" class="w-full p-2 border border-gray-400 rounded" placeholder="Nama" />
                    </div>
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

@endsection
