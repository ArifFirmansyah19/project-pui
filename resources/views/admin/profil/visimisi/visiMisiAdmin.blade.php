@extends('layouts.app-admin')
@section('title', 'halaman Visi Misi admin')
@section('content-admin')

    <main class="flex-1 bg-gray-200 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h1 class="text-3xl sm:text-4xl font-bold text-indigo-900 mb-6 mt-2 sm:mt-2">
                Visi
            </h1>
            <!--konten visi -->
            <p id="vision-content" class="text-gray-800 mt-4 sm:mt-6 leading-relaxed text-sm sm:text-base text-justify ">
            <p class="text-gray-800 mt-3 leading-relaxed px-4 text-justify">
                {!! $visionMission->vision !!}
            </p>
            </p>
            <h1 class="mt-10 text-3xl sm:text-4xl font-bold text-indigo-900 mb-6">
                Misi
            </h1>
            {{-- <ul class="text-gray-800 mt-4 sm:mt-6 leading-relaxed list-disc list-inside text-sm sm:text-base text-justify"> --}}
            <p class="text-gray-800 leading-relaxed px-4 text-justify">
                Adapun Misi dari PUI GEMAR UNJA adalah sebagai berikut:
                {!! $visionMission->missions !!}
            </p>
            {{-- </ul> --}}

            <!-- Floating Action Button -->
            <a href="{{ route('admin.edit-visimisi', $visionMission->id) }}">
                <button
                    class="fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-300 focus:ring-opacity-50 mr-4"
                    aria-label="Edit Visi Misi">
                    <i class="fa-regular fa-pen-to-square"></i>
                </button>
            </a>
        </div>
    </main>

@endsection
