<div class="comment">
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
                            action="{{ route('admin.destroy.komentar-kegiatan', $comment->id) }}">
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
    <form method="POST" action="{{ route('admin.store.komentar-kegiatan') }}" id="reply-form-{{ $comment->id }}"
        class="mt-2 hidden">
        @csrf
        <input type="hidden" name="kegiatan_id" value="{{ $comment->kegiatan_id }}">
        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
        <textarea name="isi_komentar" class="border rounded w-full py-2 px-3" placeholder="Your Reply"></textarea>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Reply</button>
    </form>

    <!-- Tampilkan balasan (jika ada) -->
    @if ($comment->replies->count() > 0)
        <div id="replies-{{ $comment->id }}" class="hidden ml-14 mt-2">
            @foreach ($comment->replies as $reply)
                @include('admin.sumberdaya.kegiatan._comment', ['comment' => $reply])
            @endforeach
        </div>
    @endif
</div>

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

    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('form');
            const kegiatanId = this.getAttribute('data-id');
            event.preventDefault();

            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus?',
                text: "Anda tidak akan dapat mengembalikan kegiatan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
