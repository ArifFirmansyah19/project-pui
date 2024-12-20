@extends('layouts.app-user')
@section('title', 'HKI PUI GEMAR')

@section('content')
    <div class="flex flex-col md:flex-row w-full">
        <div class="bg-white mt-5 shadow-md rounded-lg p-4 md:w-2/3 px-10">
            <h3 class="inline-block text-2xl font-bold text-indigo-900 mb-4  border-b-2 border-indigo-900">
                Hak Kekayaan Intelektual (HKI)
            </h3>

            <!-- Konten HKI -->
            <div class="grid grid-cols-1 gap-6 mt-12">
                @foreach ($HKIs as $HKI)
                    <div class="bg-white rounded-lg shadow-lg flex overflow-hidden">
                        <!-- PDF Viewer (Iframe) -->
                        <iframe
                            src="{{ $HKI->file_path ? asset('storage/' . $HKI->file_path) : asset('img/hki-placeholder.pdf') }}"
                            class="w-1/3 sm:w-1/3 md:w-1/3 h-[300px] object-cover" title="Sertifikat HKI">
                        </iframe>

                        <!-- Deskripsi (Kontainer deskripsi) -->
                        <div class="p-4 flex flex-col justify-between w-2/3 sm:w-2/3 md:w-2/3">
                            <h2 class="text-xl font-semibold text-indigo-700">
                                <a href="{{ $HKI->file_path ? asset('storage/' . $HKI->file_path) : asset('img/hki-placeholder.pdf') }}"
                                    target="_blank" class="hover:underline">
                                    {{ $HKI->judul }}
                                </a>
                            </h2>
                            <p class="text-gray-700 mt-2">
                                {!! $HKI->deskripsi !!}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @include('layouts.session-article')
    </div>

@endsection
