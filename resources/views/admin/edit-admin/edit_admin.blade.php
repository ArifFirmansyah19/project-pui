@extends('layouts.app-admin')

@section('title', 'Halaman Edit Admin')

@section('content-admin')
    <main class="flex-1 bg-gray-100 p-4 sm:p-6">
        <div id="content" class="transition-transform duration-500 ease-in-out">

            @if (session()->has('message'))
                <div class="text-green-600 mb-4">{{ session()->get('message') }}</div>
            @endif

            <h1 class="text-4xl font-bold text-indigo-900 mb-8 mt-20">
                Halaman Edit Profil Admin
            </h1>

            <form action="{{ route('dashboard.updateprofil') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Nama -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Nama
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    @error('name')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email
                    </label>
                    <input type="text" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Foto Profil -->
                <div>
                    <label for="foto" class="block text-sm font-medium text-gray-700">
                        Foto Admin
                    </label>
                    @if (Auth::user()->foto)
                        <!-- Jika Admin memiliki foto, tampilkan foto lama -->
                        <div class="foto_lama mb-4">
                            <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="{{ Auth::user()->name }}"
                                height="150px" width="150px" />
                        </div>
                    @endif

                    <!-- Form input untuk upload foto baru -->
                    <input type="file" id="foto" name="foto" accept="image/*"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    @error('foto')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
