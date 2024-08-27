@extends('layouts.app-admin')
@section('title', 'halaman create Visi Misi admin')
@section('content-admin')

    {{-- allert berhasil simpan data artikel, update --}}
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success'
                });
            });
        </script>
    @endif

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <div class="text-left mb-4 mr-16">
                <!-- Tambahkan tombol edit disini -->
                <h1 class="text-3xl font-bold mb-4">Edit Visi Misi PUI GEMAR</h1>
                <form id="updateForm" action="{{ route('admin.update-visimisi', $visionMission->id) }}" method="POST">
                    @csrf
                    <!-- Edit Visi PUI GEMAR -->
                    <div>
                        <label for="vision" class="block text-sm font-medium text-gray-700">Visi</label>
                        <textarea name="vision" id="summernote">{!! $visionMission->vision !!}</textarea>
                    </div>

                    <div class="mt-5">
                        <label for="missions" class="block text-sm font-medium text-gray-700">Misi</label>
                        @foreach ($visionMission->missions as $index => $mission)
                            <div id="missions">
                                <div class="mission-item mt-1 flex" id="mission_{{ $index }}">
                                    <input type="text" name="missions[]" id="mission_{{ $index }}"
                                        value="{{ old('missions.' . $index, $mission) }}" required
                                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                                    <button type="button" onclick="removeMissionField(this)"
                                        class="ml-2 bg-red-500 text-white px-3 py-2 rounded-md">
                                        <i class="fa-solid fa-trash text-white-600 hover:text-grey-900"></i>
                                    </button>
                                </div>
                        @endforeach
                    </div>
            </div>
        </div>

        {{-- Tombol untuk tambah misi / simpan --}}
        <div class="button">
            <div class="flex justify-end m-5 pt-2">
                <button type="button" onclick="addMissionField()"
                    class="fixed bottom-4 center bg-green-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700"
                    style="margin-left: 20px; ">
                    Tambah
                </button>
                {{-- <button type="submit" id="updateButton" --}}
                <button type="submit" id="updateButton"
                    class="fixed bottom-4 right-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan
                </button>
            </div>
        </div>
        </form>

        {{-- Tombol untuk kembali ke halaman awal visi Misi --}}
        <a href="{{ route('admin.visimisi') }}">
            <button type="button"
                class="fixed bottom-4 left-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                aria-label="Kembali">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
        </a>

    </main>
    <br>

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

        function addMissionField() {
            const missionsDiv = document.getElementById('missions');
            const newField = document.createElement('div');
            newField.className = 'mt-1 flex';
            newField.innerHTML = `
            <input type="text" name="missions[]" required class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
            <button type="button" onclick="removeMissionField(this)" class="ml-2 bg-red-500 text-white px-3 py-2 rounded-md">-</button>
        `;
            // missionsDiv.appendChild(newField);
            missionsDiv.insertBefore(newField, missionsDiv.LastElementChild);
        }

        function removeMissionField(button) {
            button.parentElement.remove();
        }
    </script>

@endsection
