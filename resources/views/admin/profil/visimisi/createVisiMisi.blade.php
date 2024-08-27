@extends('layouts.app-admin')
@section('title', 'halaman create Visi Misi admin')
@section('content-admin')
    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16">
                <!-- Tambahkan tombol edit disini -->
                <h1 class="text-3xl font-bold mb-4">Tambah Misi PUI GEMAR</h1>
                <form action="{{ route('admin.store-visimisi') }}" method="POST">
                    @csrf
                    <!-- Visi PUI GEMAR -->
                    <div>
                        <label for="vision" class="block text-sm font-medium text-gray-700">Visi</label>
                        <textarea name="vision" id="summernote"></textarea>
                    </div>

                    <!-- Misi PUI GEMAR -->
                    <div id="missions">
                        <label for="missions" class="block text-sm font-medium text-gray-700">Misi</label>
                        <div class="mt-1 flex">
                            <input type="text" name="missions[]" placeholder="Masukkan misi"
                                class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                            <button type="button" onclick="addMissionField()"
                                class="ml-2 bg-green-500 text-white px-3 py-2 rounded-md">
                                +
                            </button>
                        </div>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>


        <div class="flex justify-start">
            <button
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                <a href="{{ route('admin.visimisi') }}">
                    Kembali
                </a>
            </button>
        </div>

    </main>

    <script>
        function addMissionField() {
            const missionsDiv = document.getElementById('missions');
            const newField = document.createElement('div');
            newField.className = 'mt-1 flex';
            newField.innerHTML = `
                <input type="text" name="missions[]" class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                <button type="button" onclick="removeMissionField(this)" class="ml-2 bg-red-500 text-white px-3 py-2 rounded-md">-</button>
            `;
            missionsDiv.appendChild(newField);
        }

        function removeMissionField(button) {
            button.parentElement.remove();
        }
    </script>

@endsection
