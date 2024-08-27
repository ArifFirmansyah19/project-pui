@extends('layouts.app-admin')

@section('title', 'Halaman Edit Password Admin')

@section('content-admin')
    <main class="flex-1 bg-gray-100 p-4 sm:p-6">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            @if (session()->has('message'))
                <div class="text-green-600 mb-4">{{ session()->get('message') }}</div>
            @endif

            <h1 class="text-4xl font-bold text-indigo-900 mb-8 mt-20">
                Halaman Edit Password
            </h1>

            <form action="{{ route('dashboard.updatepassword') }}" method="POST" class="space-y-4">
                @csrf
                <!-- current Password -->
                <div>
                    <label for="password_lama" class="block text-sm font-medium text-gray-700">
                        Password Lama
                    </label>
                    <input type="password" id="password_lama" name="password_lama" autocomplete="new-password"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    @error('password_lama')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password Baru
                    </label>
                    <input type="password" id="password" name="password" autocomplete="new-password"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm New Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                        Konfirmasi Password Baru
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    @error('password_confirmation')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
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
