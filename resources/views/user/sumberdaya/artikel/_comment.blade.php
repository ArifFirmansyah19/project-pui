<div class="mb-4 p-4 bg-grey-900 rounded shadow">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-blue-300 rounded-full flex items-center justify-center text-gray-500">
                <span class="font-bold">{{ strtoupper(substr($commentArticle->nama, 0, 1)) }}</span>
            </div>
            <div class="ml-4">
                <div class="p-3">
                    @if ($commentArticle->is_admin)
                        <p class="font-bold text-green-500">Admin PUI GEMAR</p>
                    @else
                        <p class="font-bold">{{ $commentArticle->nama }}</p>
                    @endif
                    <p>{{ $commentArticle->isi_komentar }}</p>

                    <!-- Tombol Balasan -->
                    @if ($commentArticle->total_replies > 0)
                        <button class="bg-blue-500 rounded text-white mt-2 p-1"
                            onclick="toggleReplies({{ $commentArticle->id }})">
                            {{ $commentArticle->total_replies }} balasan
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <a href="javascript:void(0);" onclick="toggleReplyForm({{ $commentArticle->id }});"
        class="text-blue-500 mt-2 inline-block">Balas Komentar</a>
    <form method="POST" action="{{ route('store.komentar-artikel') }}" id="reply-form-{{ $commentArticle->id }}"
        class="mt-2 hidden">
        @csrf
        <input type="hidden" name="article_id" value="{{ $commentArticle->article_id }}">
        <input type="hidden" name="parent_id" value="{{ $commentArticle->id }}">
        <div class="mb-2">
            <input type="text" name="nama" class="border rounded w-full py-2 px-3" placeholder="Your Name">
        </div>
        <div class="mb-2">
            <textarea name="isi_komentar" class="border rounded w-full py-2 px-3" placeholder="Your Reply"></textarea>
        </div>
        <input type="hidden" name="is_admin" value="false">
        <!-- Atur sesuai kebutuhan, true jika admin -->
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Reply</button>
    </form>

    {{-- tampilkan balasan komentar --}}
    @if ($commentArticle->replies->count() > 0)
        <div id="replies-{{ $commentArticle->id }}" class="hidden ml-14 mt-2">
            @foreach ($commentArticle->replies as $reply)
                <div class="p-3 border-l-2">
                    <label for="comment" class="block text-sm font-medium text-gray-700">
                        <p>
                            <strong class="{{ $reply->nama === 'Admin' ? 'text-green-500' : 'text-black' }}">
                                {{ $reply->nama }}</strong> membalas <strong>{{ $commentArticle->nama }}</strong>:
                        </p>
                    </label>
                    <input type="text" id="comment" name="comment" readonly required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ $reply->isi_komentar }}" />

                    <!-- Form untuk membalas balasan komentar -->
                    <a href="javascript:void(0);" onclick="toggleReplyForm({{ $reply->id }});"
                        class="text-blue-500 mt-2 inline-block">Balas Komentar</a>
                    <form method="POST" action="{{ route('store.komentar-artikel') }}"
                        id="reply-form-{{ $reply->id }}" class="mt-2 hidden">
                        @csrf
                        <input type="hidden" name="article_id" value="{{ $reply->article_id }}">
                        <input type="hidden" name="parent_id" value="{{ $reply->id }}">
                        <div class="mb-2">
                            <input type="text" name="nama" class="border rounded w-full py-2 px-3"
                                placeholder="Your Name">
                        </div>
                        <div class="mb-2">
                            <textarea name="isi_komentar" class="border rounded w-full py-2 px-3" placeholder="Your Reply"></textarea>
                        </div>
                        <input type="hidden" name="is_admin" value="false">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Reply</button>
                    </form>


                    <!-- Nested replies -->
                    @if ($reply->replies->count() > 0)
                        @foreach ($reply->replies as $nestedReply)
                            <div class="pt-3 pb-3">
                                <label for="comment" class="block text-sm font-medium text-gray-700">
                                    <p><strong
                                            class="{{ $nestedReply->nama === 'Admin' ? 'text-green-500' : 'text-black' }}">
                                            {{ $nestedReply->nama }}</strong>
                                        membalas
                                        <strong>{{ $reply->nama }}</strong>:
                                    </p>
                                </label>
                                <input type="text" id="comment" name="comment" readonly required
                                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500"
                                    value="{{ $nestedReply->isi_komentar }}" />

                                <!-- Form untuk membalas balasan nested -->
                                <a href="javascript:void(0);" onclick="toggleReplyForm({{ $nestedReply->id }});"
                                    class="text-blue-500 mt-2 inline-block">Balas Komentar</a>
                                <form method="POST" action="{{ route('store.komentar-artikel') }}"
                                    id="reply-form-{{ $nestedReply->id }}" class="mt-2 hidden">
                                    @csrf
                                    <input type="hidden" name="article_id" value="{{ $nestedReply->article_id }}">
                                    <input type="hidden" name="parent_id" value="{{ $nestedReply->id }}">
                                    <div class="mb-2">
                                        <textarea name="isi_komentar" class="border rounded w-full py-2 px-3" placeholder="Your Reply"></textarea>
                                    </div>
                                    <input type="hidden" name="is_admin" value="false">
                                    <button type="submit"
                                        class="bg-blue-500 text-white py-2 px-4 rounded">Reply</button>
                                </form>
                            </div>
                        @endforeach
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
