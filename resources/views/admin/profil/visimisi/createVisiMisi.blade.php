@extends('layouts.app-admin')
@section('title', 'halaman create Visi Misi admin')
@section('content-admin')
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16 pl-12">
                <!-- Form tambah Konten Visi Misi -->
                <form id="updateForm" action="{{ route('admin.update-visimisi', $visionMission->id) }}"
                    class="max-w-4xl mx-auto" method="POST">
                    @csrf
                    <h1 class="text-2xl sm:text-3xl font-bold mb-4 mt-3 text-indigo-800">
                        Tambah Visi Misi
                    </h1>
                    <div class="mb-4">
                        <label for="vision" class="block text-black-700 text-lg font-bold mb-2">Visi</label>
                        <p class="text-xs text-gray-500 mt-1">
                            Peringatan: Tidak disarankan mengunggah gambar di kolom inputan.
                        </p>
                        <textarea name="vision" class="summernote" id="vision"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="missions" class="block text-black-700 text-lg font-bold mb-2">Misi</label>
                        <p class="text-xs text-gray-500 mt-1">
                            Peringatan: Tidak disarankan mengunggah gambar di kolom inputan.
                        </p>
                        <textarea name="missions" class="summernote" id="missions"></textarea>
                    </div>
                    <div class="flex justify-end m-5 pt-2">
                        <button type="submit" id="updateButton"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>


    <script>
        document.getElementById('updateButton').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form submission

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Pastikan data yang diinput sudah benar!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yakin!',
                cancelButtonText: 'Batalkan',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('updateForm').submit(); // Submit the form
                }
            });
        });
    </script>

    {{-- <script>
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
    </script>  --}}

@endsection
