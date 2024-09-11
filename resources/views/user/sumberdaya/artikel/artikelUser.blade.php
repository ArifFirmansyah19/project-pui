@extends('layouts.app-user')
@section('title', 'Artikel PUI GEMAR')

@section('content')
    <div class="flex justify-center min-h-screen bg-gray-600">
        <div class="max-w-4xl w-full py-8 px-4 bg-gray-300">
            <div class="max-w-4xl w-full py-8 px-4 bg-gray-300">
                <div class="bg-gray-300 shadow-md rounded-lg px-8 py-6">
                    <h1 class="text-4xl font-bold text-indigo-900 mb-8 mt-10">
                        Artikel PUI GEMAR
                    </h1>

                    @foreach ($articles as $article)
                        <!-- Artikel -->
                        <div class="mb-4 mt-2">
                            <a href="{{ route('artikel-detail', $article->id) }}"
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
                                data-article-id="1">
                                <i class="far fa-comment mr-1"></i>
                                <span class="commentCount" data-article-id="1"> {{ $article->totalComments }}</span>
                            </button>
                        </div>
                        <hr class="border-gray-800 my-1" />
                    @endforeach
                    <div class="mt-auto mb-0 px-3 flex justify-start">
                        {{ $articles->links() }}
                    </div>

                </div>
            </div>

        @endsection
