@extends('layouts.app-admin')
@section('title', 'halaman Edit Kegiatan PUI GEMAR')
@section('content-admin')
    <main class="flex-1 bg-gray-100 p-3 sm:p-3">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h1 class="text-4xl font-bold text-indigo-900 mt-10 ">Kegiatan</h1>

            <!-- Kegiatan 1 -->
            <div class="mb-8 p-5">
                <h2 class="text-lg font-semibold text-indigo-900 mb-2 mt-10">
                    {{ $kegiatan->nama_kegiatan }}
                </h2>
                <p class="text-sm text-gray-500 mb-2">{{ $kegiatan->formatted_created_at }}</p>
                <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}"
                    alt="gambar kegiatan {{ $kegiatan->nama_kegiatan }}" class="mb-2 rounded-lg h-96 w-full object-cover" />
                <p class="text-gray-800 leading-relaxed">
                    {!! $kegiatan->deskripsi_kegiatan !!}
                </p>
            </div>

            {{-- testing Komentar --}}
            <div class="container mx-auto">
                <h2 class="text-2xl font-bold mb-4">Comments</h2>

                {{-- Tampilkan komentar utama --}}
                @foreach ($commentKegiatans as $commentKegiatan)
                    <div class="mb-4 p-4 bg-white rounded shadow">
                        <!-- Tampilkan komentar utama terlebih dahulu -->
                        @include('admin.sumberdaya.kegiatan._comment', [
                            'comment' => $commentKegiatan,
                        ])
                    </div>
                @endforeach
            </div>
        </div>
        <br><br>
    </main>

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
