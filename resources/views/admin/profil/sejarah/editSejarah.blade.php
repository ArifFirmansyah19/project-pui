@extends('layouts.app-admin')
@section('title', 'halaman Edit Konten Sejarah PUI GEMAR')
@section('content-admin')

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Edit Konten Sejarah
            </h2>

            <form id="updateForm" action="{{ route('admin.update-sejarah', $sejarah->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="isi_sejarah" class="block text-sm font-medium text-gray-700">Konten Sejarah</label>
                    <p class="text-xs text-gray-500 mt-1">
                        Usahakan deskripsi sejarah tidak mengandung gambar.
                    </p>
                    <textarea name="isi_sejarah" id="summernote">{!! old('isi_sejarah', $sejarah->isi_sejarah) !!}</textarea>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end">
                    <button type="submit" id="updateButton"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                        Update
                    </button>
                </div>
            </form>
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
@endsection
