@extends('layouts.app-admin')

@section('title', 'Halaman Profil Admin')

@section('content-admin')
    <main class="flex-1 bg-gray-100 p-4 sm:p-6">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="flex">
                <!-- Konten Profil -->
                <div class="max-w-full p-12 bg-white shadow-md rounded-lg w-2/3">
                    <h1 class="text-4xl font-bold text-indigo-900 mb-10 mt-24">
                        Profil Admin {{ Auth::user()->name }}
                    </h1>

                    <!-- Teks Penjelasan -->
                    <div class="text-gray-800 leading-relaxed mx-8 mt-6">
                        <p class="mb-1">
                            <span class="font-bold">Nama:</span> {{ Auth::user()->name }}
                        </p>
                        <p class="mb-1">
                            <span class="font-bold">Email:</span> {{ Auth::user()->email }}
                        </p>
                    </div>

                    <!-- Tautan Edit -->
                    <div class="p-12">
                        <a href="{{ route('dashboard.editprofil') }}"
                            class="block px-4 py-2 text-sm text-white bg-blue-400 hover:bg-blue-500 rounded-md mb-2"
                            role="menuitem">
                            Edit Profil Admin
                        </a>
                        <a href="{{ route('dashboard.editpassword') }}"
                            class="block px-4 py-2 text-sm text-white bg-blue-400 hover:bg-blue-500 rounded-md"
                            role="menuitem">
                            Edit Password Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
