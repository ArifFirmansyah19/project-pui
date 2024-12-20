@extends('layouts.app-user')
@section('title', 'Detail Geopark Merangin')

@section('content')

    <div class="mx-auto px-12">
        <!-- Nama UMKM dan Penjelasan Singkat -->

        <!-- Main Content -->
        <div class="container mx-auto p-8">
            <h2 class="text-4xl font-semibold mb-4">Sejarah Geopark Merangin</h2>
            <img src="{{ asset('storage/' . $museumGeopark->foto) }}" alt="Ilustrasi Stratigrafi"
                class="w-full h-80 rounded shadow-lg mb-4" />
            <p class="mb-6">
                {!! $museumGeopark->deskripsi !!}
            </p>


        </div>
    </div>

@endsection
