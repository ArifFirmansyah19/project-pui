<div class="comment border-b border-gray-300 pb-2 mb-2">
    <p class="text-gray-800 font-semibold">{{ $comment->user->name ?? 'Anonim' }}</p>
    <p class="text-gray-700">{{ $comment->isi_komentar }}</p>
    <div class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</div>

    <!-- Tombol Balas -->
    <button class="reply-btn text-blue-600 text-sm mt-2" data-comment-id="{{ $comment->id }}">
        Balas
    </button>

    <!-- Form Balasan -->
    @if ($comment->replies->isNotEmpty())
        <div class="replies mt-4 pl-4 border-l border-gray-300">
            @foreach ($comment->replies as $reply)
                @include('_comment', ['comment' => $reply])
            @endforeach
        </div>
    @endif
</div>










{{-- <div class="comment">
    <!-- Informasi Pengguna -->
    <div class="flex items-center">
        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-500">
            <span class="font-bold">{{ strtoupper(substr($comment->nama, 0, 1)) }}</span>
        </div>
        <div class="ml-4">
            <div class="p-3">
                @if ($comment->is_admin)
                    <p class="font-bold text-green-500">Admin</p>
                @else
                    <p class="font-bold">{{ $comment->nama }}</p>
                @endif
                <p>{{ $comment->isi_komentar }}</p>

                <!-- Tombol untuk menampilkan balasan -->
                @if ($comment->replies->count() > 0)
                    <button class="bg-blue-500 rounded text-white mt-2 p-1" onclick="toggleReplies({{ $comment->id }})">
                        {{ $comment->replies->count() }} balasan
                    </button>
                @endif

                <!-- Tombol Balas Komentar dan Hapus Komentar -->
                <div class="flex items-center mt-2 space-x-2">
                    <a href="javascript:void(0);" onclick="toggleReplyForm({{ $comment->id }});"
                        class="text-blue-500">Balas Komentar</a>

                    <!-- Logika tombol hapus -->
                    @if (Auth::check() && Auth::user()->isAdmin())
                        <form class="delete-form" method="POST"
                            action="{{ route('admin.destroy.komentar-artikel', $comment->id) }}">
                            @csrf
                            <button type="button" data-id="{{ $comment->id }}" class="delete-button mx-2">
                                <i class="fa-solid fa-trash text-red-600 hover:text-gray-900"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Form untuk membalas komentar -->
    <form method="POST" action="{{ route('admin.store.komentar-artikel') }}" id="reply-form-{{ $comment->id }}"
        class="mt-2 hidden">
        @csrf
        <input type="hidden" name="article_id" value="{{ $comment->article_id }}">
        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
        <textarea name="isi_komentar" class="border rounded w-full py-2 px-3" placeholder="Your Reply"></textarea>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Reply</button>
    </form>

    <!-- Tampilkan balasan (jika ada) -->
    @if ($comment->replies->count() > 0)
        <div id="replies-{{ $comment->id }}" class="hidden ml-14 mt-2">
            @foreach ($comment->replies as $reply)
                @include('admin.sumberdaya.artikel._comment', ['comment' => $reply])
            @endforeach
        </div>
    @endif
</div>

<script>
    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('form');
            const articleId = this.getAttribute('data-id');
            event.preventDefault();

            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus?',
                text: "Anda tidak akan dapat mengembalikan artikel ini!",
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
</script> --}}

{{-- @foreach ($comments as $comment)
    <div class="comment mb-4 p-2 border border-gray-200 rounded-md">
        <p><strong>{{ $comment->nama }}</strong>: {{ $comment->isi_komentar }}</p>

        <!-- Reply and Delete Buttons for Comment -->
        <div class="flex space-x-2 mt-2">
            <button class="text-blue-500 hover:text-blue-700 text-sm" onclick="replyToComment({{ $comment->id }})">
                Reply
            </button>
            <button class="text-red-500 hover:text-red-700 text-sm" onclick="deleteComment({{ $comment->id }})">
                Delete
            </button>
        </div>

        <!-- Nested Replies -->
        @if ($comment->replies)
            <div class="ml-4 mt-2">
                @foreach ($comment->replies as $reply)
                    <div class="comment mb-2 p-2 border border-gray-100 rounded-md">
                        <p><strong>{{ $reply->nama }}</strong>: {{ $reply->isi_komentar }}</p>

                        <!-- Reply and Delete Buttons for Reply -->
                        <div class="flex space-x-2 mt-1">
                            <button class="text-blue-500 hover:text-blue-700 text-sm"
                                onclick="replyToComment({{ $reply->id }})">
                                Reply
                            </button>
                            <button class="text-red-500 hover:text-red-700 text-sm"
                                onclick="deleteComment({{ $reply->id }})">
                                Delete
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endforeach

<script>
    function replyToComment(commentId) {
        // Logic for replying to a comment
        // You can open a reply form or a modal, passing the commentId for reference
        console.log("Reply to comment ID:", commentId);
    }

    function deleteComment(commentId) {
        // Confirmation and logic for deleting a comment
        if (confirm("Apakah Anda yakin ingin menghapus komentar ini?")) {
            // Perform delete action, possibly an AJAX call or form submission
            console.log("Delete comment ID:", commentId);
        }
    }
</script> --}}




{{-- <div class="comment mb-2 p-2 border border-gray-300 rounded-lg">
    <p class="font-semibold">{{ $comment->user->name }}</p>
    <p>{{ $comment->content }}</p>

    <!-- Tombol Reply -->
    <button class="reply-btn text-blue-600" data-comment-id="{{ $comment->id }}">Reply</button>

    <!-- Tombol Delete -->
    <button class="delete-btn text-red-600" data-comment-id="{{ $comment->id }}">Delete</button>

    <!-- Replies -->
    @if ($comment->replies)
        <div class="replies ml-4 mt-2">
            @foreach ($comment->replies as $reply)
                <p class="font-semibold">{{ $reply->user->name }}</p>
                <p>{{ $reply->content }}</p>
            @endforeach
        </div>
    @endif
</div> --}}
