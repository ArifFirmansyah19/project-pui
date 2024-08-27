@extends('layouts.app-admin')
@section('title', 'halaman Edit Kegiatan PUI GEMAR')
@section('content-admin')
    <main class="flex-1 bg-gray-100 p-3 sm:p-3">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h1 class="text-4xl font-bold text-indigo-900 mt-10 ">Kegiatan</h1>

            <!-- Kegiatan 1 -->
            <div class="mb-8 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                <h2 class="text-lg font-semibold text-indigo-900 mb-2 mt-10">
                    {{ $kegiatan->nama_kegiatan }}
                </h2>
                <p class="text-sm text-gray-500 mb-2">{{ $kegiatan->formatted_created_at }}</p>
                <img src="{{ asset('fotoKegiatan/' . $kegiatan->foto_kegiatan) }}"
                    alt="gambar kegiatan {{ $kegiatan->nama_kegiatan }}" class="mb-2 rounded-lg h-96 w-full object-cover" />
                <p class="text-gray-800 leading-relaxed">
                    {!! $kegiatan->deskripsi_kegiatan !!}
                </p>
            </div>

            {{-- testing Komentar --}}
            <div class="container mx-auto">
                <h2 class="text-2xl font-bold mb-4">Comments</h2>

                {{-- munculin komentar kegiatan --}}
                @foreach ($commentkegiatans as $commentKegiatan)
                    @include('admin.sumberdaya.kegiatan._comment', ['commentKegiatan' => $commentKegiatan])
                @endforeach
            </div>
        </div>


        <!-- Floating Action Button -->
        <a href="{{ route('admin.kegiatan') }}">
            <button
                class="fixed bottom-4 left-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
                aria-label="Kembali">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
        </a>

    </main>


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
