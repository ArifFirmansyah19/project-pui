@extends('layouts.app-admin')
@section('title', 'halaman Edit Kegiatan PUI GEMAR')
@section('content-admin')
    {{-- <main class="flex-1 bg-gray-100 p-3 sm:p-3">
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

            <!-- Komentar -->
            <div class="container mx-auto">
                <h2 class="text-2xl font-bold mb-4">Comments</h2>

                <!-- Komentar (Nested comment) -->
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
    </main> --}}

    <main class="flex-1 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <!--konten detail artikel -->
            <div class="max-w-full p-6 bg-white shadow-md rounded-lg">
                <h1 class="text-4xl font-bold text-indigo-900 mt-3 mb-15">
                    {{ $kegiatan->nama_kegiatan }}
                </h1>

                <!-- Container slideshow gambar kegiatan -->
                <div class="relative mb-8 mt-8">
                    @if (Str::endsWith($kegiatan->foto_kegiatan, ['jpg', 'jpeg', 'png', 'webp']))
                        <!-- Menampilkan Gambar -->
                        <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}"
                            alt="Kegiatan {{ $kegiatan->nama_kegiatan }}" class="mb-2 rounded-lg h-96 w-full object-cover" />
                    @elseif (Str::endsWith($kegiatan->foto_kegiatan, ['mp4', 'avi', 'mov']))
                        <!-- Menampilkan Video -->
                        <video controls class="mb-2 rounded-lg h-96 w-full object-cover">
                            <source src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}"
                                type="video/{{ pathinfo($kegiatan->foto_kegiatan, PATHINFO_EXTENSION) }}">
                            Browser Anda tidak mendukung pemutar video.
                        </video>
                    @endif
                </div>

                <!-- Deskripsi kegiatan -->
                <div class="mb-8">
                    <p class="text-gray-800 leading-relaxed">
                        {!! $kegiatan->deskripsi_kegiatan !!}
                    </p>
                </div>
                <!-- Bagian komentar -->
                <div id="comments" class="mt-10">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Komentar</h2>
                    <div id="comments-container" class="space-y-4">
                        <form method="POST" action="{{ route('admin.store.komentar-kegiatan') }}" class="mb-4">
                            @csrf
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                <h3 class="text-xl font-semibold mb-2">Tulis Komentar</h3>
                                <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id }}">
                                <textarea id="isi_komentar" name="isi_komentar" placeholder="Tulis komentar Anda..."
                                    class="w-full p-2 mb-2 border border-gray-300 rounded-lg h-24"></textarea>
                                <button id="submit"
                                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                                    Kirim
                                </button>
                            </div>
                        </form>


                        <!-- Comment List -->
                        <div id="comments-list" class="space-y-4">
                            <h3 class="text-xl font-semibold mb-2">Daftar Komentar</h3>

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
                </div>
            </div>

            <!-- Floating Action Button -->
            <a href="{{ route('admin.edit-kegiatan', $kegiatan->id) }}">
                <button
                    class="fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 mr-4"
                    aria-label="Edit Kegiatan">
                    <i class="fa-regular fa-pen-to-square"></i>
                </button>
            </a>

        </div>
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
