@extends('layouts.app-user')
@section('title', 'Sejarah PUI GEMAR')

@section('content')
    <div class="flex flex-col md:flex-row w-full">
        <div class="bg-white shadow-md rounded-lg p-4 md:w-2/3 ">
            <div class="max-w-full p-6">
                <h1 class="text-4xl font-bold text-indigo-900 mb-15">{{ $sejarah->judul }}</h1>
                @if (!$sejarahExists)
                    <p class="text-gray-800 mt-6 leading-relaxed text-justify">
                        Konten Sejarah Belum Ditambahkan
                    </p>
                @else
                    <p class="text-gray-800 mt-6 leading-relaxed text-justify">
                        {!! $sejarah->isi_sejarah !!}
                    </p>
                @endif
            </div>
        </div>
        @include('layouts.session-article')
    </div>

@endsection
