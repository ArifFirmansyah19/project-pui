@extends('layouts.app-user')
@section('title', 'HKI PUI GEMAR')

@section('content')

    <div class="flex justify-center min-h-screen bg-gray-600">
        <div class="max-w-4xl w-full py-8 px-4 bg-gray-300">
            <div class="max-w-4xl w-full py-8 px-4 bg-gray-300">
                <div class="bg-gray-300 shadow-md rounded-lg px-8 py-6">
                    <h1 class="text-4xl font-bold text-indigo-900 mb-8 mt-10">
                        Daftar HKI PUI GEMAR
                    </h1>
                    <hr class="border-gray-800 my-1" />

                    @foreach ($HKIs as $HKI)
                        <!-- HKI -->
                        <div class="mb-4 mt-2">
                            <a href="{{ route('HKI-detail', $HKI->id) }}"
                                class="block text-xl font-semibold text-indigo-900 mb-0">Judul HKI : {{ $HKI->judul }}
                            </a>
                            <p class="text-gray-800 leading-relaxed">Pemilik HKI : {{ $HKI->nama }}</p>
                            <br>
                            <p class="text-gray-800 leading-relaxed line-clamp">{{ $HKI->deskripsi }}
                            </p>
                            <br>
                            <p class="text-gray-800 leading-relaxed">
                                Link File HKI:
                                @if ($HKI->file_path)
                                    <a href="{{ asset('storage/' . $HKI->file_path) }}" target="_blank"
                                        class="text-blue-500 underline">
                                        {{ $HKI->judul }}.Pdf
                                    </a>
                                @endif
                            </p>


                        </div>
                        <hr class="border-gray-800 my-1" />
                    @endforeach
                    <div class="mt-auto mb-0 px-3 flex justify-start">
                        {{ $HKIs->links() }}
                    </div>

                </div>
            </div>

        @endsection
