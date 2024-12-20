@extends('layouts.app-admin')

@section('title', 'Halaman Edit Admin')

@section('content-admin')
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16 pl-12">
                <!-- Formulir Edit Akun -->
                <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
                    <h1 class="text-3xl font-bold mb-6 text-indigo-800">
                        Edit Profil Akun
                    </h1>

                    <form id="updateForm" action="{{ route('dashboard.updateprofil') }}" method="POST"
                        enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <!-- Input Nama -->
                        <div class="mb-6">
                            <label for="name" class="block text-gray-700 text-lg font-semibold mb-2">Nama</label>
                            <input type="text" id="name" value="{{ old('name', Auth::user()->name) }}"
                                name="name" placeholder="Masukkan nama lengkap" required
                                class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                            @error('name')
                                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Email -->
                        <div class="mb-6">
                            <label for="email" class="block text-gray-700 text-lg font-semibold mb-2">Email</label>
                            <input type="email" id="email" name="email"
                                value="{{ old('email', Auth::user()->email) }}" placeholder="Masukkan email" required
                                class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                            @error('email')
                                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Gambar Utama (Opsional) -->
                        <div class="mb-6">
                            <label for="image" class="block text-gray-700 text-lg font-semibold mb-2">
                                Unggah Gambar Profil (Opsional)
                            </label>

                            <!-- Jika Admin memiliki foto, tampilkan foto lama -->
                            @if (Auth::user()->foto)
                                <label for="image" class="block text-gray-700 text-lg font-semibold mb-2">
                                    Foto Admin Lama
                                </label>
                                <div class="foto_lama mb-4">
                                    <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="{{ Auth::user()->name }}"
                                        height="150px" width="150px" />
                                </div>
                            @endif

                            <!-- Form input untuk upload foto baru -->
                            <input type="file" id="foto" name="foto" accept="image/*"
                                class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                onchange="previewImage(event)" />
                            <p class="text-gray-600 text-sm mt-2">
                                *Gambar tidak wajib diunggah.
                            </p>
                            <img id="imagePreview" src="" alt="Pratinjau Gambar" class="mt-4 hidden border rounded"
                                style="max-width: 200px;" />
                            @error('foto')
                                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="border-indigo-900 border-b-2"></div>
                        <!-- Ganti Password -->
                        <div class="mb-6 mt-4">
                            <h2 class="text-2xl font-semibold text-indigo-800 mb-4">
                                Edit Password
                            </h2>

                            <div class="mb-4">
                                <label for="password_lama" class="block text-gray-700 text-lg font-semibold mb-2">Password
                                    Saat
                                    Ini</label>
                                <input type="password" id="password_lama" name="password_lama" autocomplete="new-password"
                                    placeholder="Masukkan Password saat ini"
                                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                                @error('password_lama')
                                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="block text-gray-700 text-lg font-semibold mb-2">Password
                                    Baru</label>
                                <input type="password" id="password" name="password" autocomplete="new-password"
                                    placeholder="Masukkan Password baru"
                                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                                @error('password')
                                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation"
                                    class="block text-gray-700 text-lg font-semibold mb-2">Konfirmasi Password
                                    Baru</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    placeholder="Konfirmasi Password baru"
                                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                                @error('password_confirmation')
                                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>

                            <p class="text-gray-600 text-sm mt-2">
                                *Isi bagian ini jika ingin mengganti Password.
                            </p>
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById("imagePreview");
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result; // Set the image source to the loaded data
                    imagePreview.classList.remove("hidden"); // Show the image
                };
                reader.readAsDataURL(file); // Read the file as a data URL
            } else {
                imagePreview.src = ""; // Reset the image source if no file is selected
                imagePreview.classList.add("hidden"); // Hide the image
            }
        }
    </script>
@endsection
