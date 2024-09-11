@extends('layouts.app-user')
@section('title', 'Detail HKI PUI GEMAR')

@section('content')

    <!--konten detail artikel -->
    <div class="flex justify-center bg-gray-600">
        <div class="max-w-4xl w-full py-8 px-2 bg-gray-300">
            <div class="max-w-4xl w-full py-8 bg-gray-300">
                <div class="bg-gray-300 shadow-md rounded-lg px-8 py-0">
                    <h1 class="text-4xl font-bold text-indigo-900 mb-0 mt-20">
                        {{ $HKI->judul }}
                    </h1>

                    <!-- Detail HKI -->
                    <div class="mb-8 pt-2">
                        <p class="text-sm text-gray-500 mb-1">Pemilik: {{ $HKI->nama }}</p>
                        <br>
                        <p class="text-gray-800 leading-relaxed text-justify">
                            {!! $HKI->deskripsi !!}
                        </p>
                        <br>
                        <p class="text-blue-500">
                            File: {{ $HKI->judul }}.Pdf
                        </p>
                        @if ($HKI->file_path)
                            <!-- Tampilkan file PDF langsung di halaman -->
                            <embed src="{{ asset('storage/' . $HKI->file_path) }}" type="application/pdf" width="100%"
                                height="700px" />
                        @endif
                        <br />
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
