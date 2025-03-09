<div class="mb-4 p-4 bg-white rounded shadow">
    <div class="flex items-start justify-between">
        <div class="flex items-start">
            <!-- Kotak profil kosong -->
            <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white">
                <!-- Placeholder initial -->
                <span class="font-bold">{{ strtoupper(substr($commentKegiatan->nama, 0, 1)) }}</span>
            </div>
            <div class="ml-4">
                @if ($commentKegiatan->is_admin)
                    <p class="font-bold text-green-500">Admin PUI GEMAR</p>
                @else
                    <p class="font-bold">{{ $commentKegiatan->nama }}</p>
                @endif
                <p>{{ $commentKegiatan->isi_komentar }}</p>

                <!-- Tombol Balasan -->
                @if ($commentKegiatan->total_replies > 0)
                    <button class="bg-indigo-600 rounded text-white mt-2 p-1"
                        onclick="toggleReplies({{ $commentKegiatan->id }})">
                        {{ $commentKegiatan->total_replies }} balasan
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Tombol untuk balas, sejajar di bawah komentar -->
    <div class="mt-2">
        <a href="javascript:void(0);" onclick="toggleReplyForm({{ $commentKegiatan->id }});"
            class="text-indigo-600 inline-block">Balas</a>
    </div>

    <!-- Form balasan tersembunyi -->
    <form method="POST" action="{{ route('store.komentar-kegiatan') }}" id="reply-form-{{ $commentKegiatan->id }}"
        class="mt-2 hidden">
        @csrf
        <input type="hidden" name="kegiatan_id" value="{{ $commentKegiatan->kegiatan_id }}">
        <input type="hidden" name="parent_id" value="{{ $commentKegiatan->id }}">
        <div class="mb-2">
            <input type="text" name="nama" class="border rounded w-full py-2 px-3" placeholder="Nama Anda">
        </div>
        <div class="mb-2">
            <textarea name="isi_komentar" class="border rounded w-full py-2 px-3" placeholder="Tulis Balasan..."></textarea>
        </div>
        <input type="hidden" name="is_admin" value="false">
        <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded">Kirim Balasan</button>
    </form>

    {{-- tampilkan balasan komentar --}}
    @if ($commentKegiatan->replies->count() > 0)
        <div id="replies-{{ $commentKegiatan->id }}" class="ml-14 mt-2">
            @foreach ($commentKegiatan->replies as $reply)
                @include('user.sumberdaya.kegiatan._comment', ['commentKegiatan' => $reply])
            @endforeach
        </div>
    @endif
</div>
