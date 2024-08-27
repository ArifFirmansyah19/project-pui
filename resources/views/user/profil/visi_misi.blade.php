@extends('layouts.app-user')
@section('title', 'Visi Misi PUI GEMAR')

@section('content')

    <div class="flex flex-col md:flex-row w-full">
        <!-- konten-->
        <div class="bg-white shadow-md rounded-lg mt-10 p-4 md:w-2/3">
            @if (!$visiMisiExists)
                <div class=" p-4">
                    <div class="max-w-full p-12">
                        <h1 class="text-4xl font-bold text-indigo-900 mb-15 mt-8">Visi</h1>
                    </div>
                    <div class="max-w-full p-12">
                        <h1 class="text-4xl font-bold text-indigo-900 mb-15">Misi</h1>
                    </div>
                </div>
            @else
                <div class=" p-4">
                    <div class="max-w-full p-12 mt-10 mb-3">
                        <h1 class="text-4xl font-bold text-indigo-900 mb-15 mt-8">Visi</h1>
                        <!--konten visi -->
                        <p class="text-gray-800 mt-6 leading-relaxed">
                            {!! $visionMission->vision !!}
                        </p>
                    </div>
                    <div class="max-w-full p-12">
                        <h1 class="text-4xl font-bold text-indigo-900 mb-15">Misi</h1>
                        <!--konten misi-->

                        <p class="text-gray-800 mt-6 leading-relaxed">
                            Adapun Misi dari PUI GEMAR UNJA adalah sebagai berikut:
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($visionMission->missions as $mission)
                                <p>
                                    {{ $no++ }}. {{ $mission }}
                                </p>
                            @endforeach

                        </p>
                    </div>
                </div>
            @endif
        </div>
        @include('layouts.session-article')
    </div>
@endsection
