@extends('layouts.app-user')
@section('title', 'Detail Kegiatan PUI GEMAR')

@section('content')
    <div class="flex flex-col md:flex-row w-full">
        <div class="bg-white mt-10 shadow-md rounded-lg p-4 md:w-2/3">
            <h1 class="text-4xl font-bold text-indigo-900 mt-24 mb-15">Kegiatan</h1>

            <!-- Kegiatan 1 -->
            <div class="p-5 mb-8 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                <h2 class="text-lg font-semibold text-indigo-900 mb-2 mt-5">
                    {{ $kegiatan->nama_kegiatan }}
                </h2>
                <p class="text-sm text-gray-500 mb-2">{{ $kegiatan->formatted_created_at }}</p>
                <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}"
                    alt="gambar kegiatan {{ $kegiatan->nama_kegiatan }}" class="mb-2 rounded-lg h-96 w-full object-cover" />
                <p class="text-gray-800 leading-relaxed">
                    {!! $kegiatan->deskripsi_kegiatan !!}
                </p>
            </div>

            <!-- Bagian komentar -->
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Komentar</h2>
            <div id="comments-container" class="space-y-4">
                <!-- Comment Form -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Tulis Komentar</h3>
                    <form method="POST" action="{{ route('store.komentar-kegiatan') }}" class="mb-4">
                        @csrf
                        <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id }}">
                        <div class="mb-2">
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="nama" class="w-full p-2 mb-2 border border-gray-300 rounded-lg"
                                placeholder="Masukkan namamu">
                        </div>
                        <div class="mb-2">
                            <label for="isi_komentar" class="block text-sm font-medium text-gray-700">Isi Komentar</label>
                            <textarea name="isi_komentar" class="w-full p-2 mb-2 border border-gray-300 rounded-lg" placeholder="Isi Komentar"></textarea>
                        </div>
                        <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Kirim</button>
                    </form>
                </div>

                <!-- Comment List -->
                <div class="container mx-auto" id="comments-list">
                    <h2 class="text-2xl font-bold mb-4">Daftar Komentar</h2>

                    {{-- munculin komentar kegiatan --}}
                    @foreach ($commentkegiatans as $commentKegiatan)
                        @include('user.sumberdaya.kegiatan._comment', [
                            'commentKegiatan' => $commentKegiatan,
                        ])
                    @endforeach
                </div>
            </div>
        </div>
        @include('layouts.session-article')
    </div>

@endsection
@section('scripts')
    <script>
        function toggleReplyForm(commentKegiatanId) {
            const replyForm = document.getElementById(`reply-form-${commentKegiatanId}`);
            if (replyForm.style.display === 'none' || replyForm.style.display === '') {
                replyForm.style.display = 'block';
            } else {
                replyForm.style.display = 'none';
            }
        }

        function toggleReplies(commentKegiatanId) {
            var repliesDiv = document.getElementById('replies-' + commentKegiatanId);
            if (repliesDiv.classList.contains('hidden')) {
                repliesDiv.classList.remove('hidden');
            } else {
                repliesDiv.classList.add('hidden');
            }
        }
    </script>
