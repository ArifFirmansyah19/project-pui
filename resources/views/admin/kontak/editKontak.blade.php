@extends('layouts.app-admin')
@section('title', 'halaman edit kontak admin')
@section('content-admin')

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Edit Kontak PUI GEMAR UNJA
            </h2>

            <form action="{{ route('admin.update-kontak', $kontak->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf

                <!-- alamat -->
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat PUI GEMAR"
                        value="{{ old('alamat', $kontak->alamat) }}"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500" />
                </div>

                <!-- email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <p class="text-xs text-gray-500 mt-1">
                        Peringatan: Masukkan format email yang benar.
                    </p>
                    <input type="text" id="email" name="email" placeholder="Masukkan email PUI GEMAR"
                        value="{{ old('email', $kontak->email) }}"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500" />
                </div>

                <!-- No_telepon -->
                <div>
                    <label for="telepon" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                    <input type="text" id="telepon" name="telepon" placeholder="Masukkan No telepon lengkap"
                        value="{{ old('telepon', $kontak->telepon) }}"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                </div>



                {{-- facebook (opsional) --}}
                <div>
                    <label for="facebook" class="block mb-1">Facebook (opsional):</label>
                    <p class="text-xs text-gray-500 mt-1">
                        Petunjuk Pengisian: isi dengan link facebook yang aktif.
                    </p>
                    <input type="text" id="facebook" name="facebook"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        value="{{ old('telepon', $kontak->facebook) }}" />
                </div>

                {{-- twitter (opsional) --}}
                <div>
                    <label for="twitter" class="block mb-1">Twitter (opsional):</label>
                    <p class="text-xs text-gray-500 mt-1">
                        Petunjuk Pengisian: isi dengan link twitter yang aktif.
                    </p>
                    <input type="text" id="twitter" name="twitter"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        value="{{ old('telepon', $kontak->twitter) }}" />
                </div>

                {{-- instagram (opsional) --}}
                <div>
                    <label for="instagram" class="block mb-1">Instagram (opsional):</label>
                    <p class="text-xs text-gray-500 mt-1">
                        Petunjuk Pengisian: isi dengan link instagram yang aktif.
                    </p>
                    <input type="text" id="instagram" name="instagram"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        value="{{ old('telepon', $kontak->instagram) }}" />
                </div>

                {{-- youtube (opsional) --}}
                <div>
                    <label for="youtube" class="block mb-1">YouTube (opsional):</label>
                    <p class="text-xs text-gray-500 mt-1">
                        Petunjuk Pengisian: isi dengan link youtube yang aktif.
                    </p>
                    <input type="text" id="youtube" name="youtube"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        value="{{ old('telepon', $kontak->youtube) }}" />
                </div>

                {{-- tiktok (opsional) --}}
                <div>
                    <label for="tiktok" class="block mb-1">Tiktok (opsional):</label>
                    <p class="text-xs text-gray-500 mt-1">
                        Petunjuk Pengisian: isi dengan link tiktok yang aktif.
                    </p>
                    <input type="text" id="tiktok" name="tiktok"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        value="{{ old('telepon', $kontak->tiktok) }}" />
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    UPDATE
                </button>
            </form>
        </div>
    </main>
    </div>
    </div>


@endsection
