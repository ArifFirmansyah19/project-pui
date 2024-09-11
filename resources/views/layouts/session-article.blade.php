<!-- Artikel -->
<div class="w-full min-h-full p-8 bg-gray-600 md:w-1/3 mt-10">
    <h2 class="text-3xl font-semibold text-white mb-5 mt-10">Article</h2>
    <!-- Artikel -->
    @foreach ($articlesWithComments as $article)
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-white mb-0">
                <a href="{{ route('artikel', $article->id) }}">{{ $article->judul }}
                </a>
            </h3>
            <p class="text-sm text-gray-300 mb-2">{{ $article->formatted_created_at }}</p>
            <p class="text-sm text-black">
                {{ implode("\n", array_slice(explode("\n", wordwrap(strip_tags($article->abstract), 150, "\n")), 0, 5)) }}
            </p>
            <a href="{{ route('artikel-detail', $article->id) }}"
                class="block text-blue-500 font-semibold mt-2 hover:text-blue-300 transition duration-300">Baca
                Selengkapnya</a>
            <div class="flex items-center mt-4 space-x-4">
                <button class="flex items-center text-gray-400 hover:text-blue-400 transition duration-300 commentBtn"
                    data-article-id="{{ $article->id }}">
                    <i class="far fa-comment mr-1"></i>
                    <span class="commentCount">{{ $article->totalComments }}</span>
                </button>
            </div>
        </div>
        <hr class="border-gray-800 my-1" />
    @endforeach
    <div class="mt-auto mb-0 px-3 flex justify-start">
        {{ $articles->links() }}
    </div>
</div>

<!-- Modal -->
<div id="commentModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Tulis Komentar</h2>
            <button id="closeModal" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
        </div>
        <div id="modalContent">
            <!-- Comments will be dynamically added here -->
        </div>
    </div>
</div>
