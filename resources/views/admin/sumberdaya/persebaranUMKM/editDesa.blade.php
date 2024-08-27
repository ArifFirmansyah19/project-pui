@extends('layouts.app-admin')
@section('title', 'halaman Edit Desa Persebaran PUI GEMAR')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Halaman Edit DESA PUI GEMAR
            </h2>
            <div id="map"></div>
        </div>
        <form id="updateForm" action="{{ route('admin.update-desa', $desa->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf

            <!-- Nama Desa -->
            <div>
                <label for="nama_desa" class="block text-sm font-medium text-gray-700">Nama Desa</label>
                <input type="text" id="nama_desa" name="nama_desa"
                    placeholder="Masukkan desa berpotensi di Kawasan Geopark Merangin" required
                    value="{{ old('nama_desa', $desa->nama_desa) }}"
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- Deskripsi Desa -->
            <div>
                <label for="deskripsi_desa" class="block text-sm font-medium text-gray-700">Deskripsi Desa</label>
                <input type="text" id="deskripsi_desa" name="deskripsi_desa"
                    placeholder="Masukkan desa berpotensi di Kawasan Geopark Merangin" required
                    value="{{ old('deskripsi_desa', $desa->deskripsi_desa) }}"
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- latitude -->
            <div>
                <label for="latitude" class="block text-sm font-medium text-gray-700">latitude</label>
                <input type="text" id="latitude" name="latitude" placeholder="latitude" readonly
                    value="{{ old('latitude', $desa->latitude) }}"
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- longitude -->
            <div>
                <label for="longitude" class="block text-sm font-medium text-gray-700">longitude</label>
                <input type="text" id="longitude" name="longitude" placeholder="longitude" readonly
                    value="{{ old('latitude', $desa->longitude) }}"
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            {{-- jenis potensi desa --}}
            <div id="potensi-container">
                <label for="potensi-desa" class="block text-sm font-medium text-gray-700">Potensi Desa</label>
                @if ($desa->potensiDesa->isEmpty())
                    <p>potensi desa kosong.</p>
                @else
                    @foreach ($desa->potensiDesa as $index => $potensi)
                        <div class="potensi-item bg-grey-600 shadow-md rounded-lg p-6" data-index="${potensiIndex}">
                            <div>
                                <label for="potensi_desa[{{ $index }}][nama_potensi]"
                                    class="block text-sm font-medium text-gray-700">Nama
                                    Potensi</label>
                                <input type="text" name="potensi_desa[{{ $index }}][nama_potensi]"
                                    id="nama_potensi" value="{{ $potensi->nama_potensi }}"
                                    placeholder="Masukkan Nama Potensi" required
                                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="potensi_desa[{{ $index }}][foto_potensi]"
                                    class="block text-sm font-medium text-gray-700">Foto Potensi</label>
                                @if ($potensi->foto_potensi)
                                    <input type="hidden" name="potensi_desa[{{ $index }}][old_foto_potensi]"
                                        value="{{ $oldFotos[$potensi->id] ?? '' }}">
                                    <img src="{{ asset('storage/' . $potensi->foto_potensi) }}"
                                        alt="Foto {{ $potensi->nama_potensi }}" class="mt-2"
                                        style="width: 100px; height: 100px;">
                                @endif
                                <input type="file" name="potensi_desa[{{ $index }}][foto_potensi]"
                                    class="form-control">
                            </div>
                            <div>
                                <label for="potensi_desa[{{ $index }}][deskripsi_potensi]"
                                    class="block text-sm font-medium text-gray-700">Deskripsi
                                    Potensi</label>
                                <input type="text" name="potensi_desa[{{ $index }}][deskripsi_potensi]"
                                    value="{{ $potensi->deskripsi_potensi }}" id="deskripsi_potensi"
                                    placeholder="Masukkan Deskripsi Potensi" required
                                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <button type="button" class="remove-potensi bg-red-500 text-white px-4 py-2 rounded-md mt-4"
                                data-index="${potensiIndex}">
                                Hapus Potensi
                            </button>
                        </div>
                        <br>
                    @endforeach
                @endif
            </div>
            <button type="button" id="add-potensi" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">
                Tambah Potensi
            </button>

            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <button type="button" id="updateButton"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                    UPDATE
                </button>
            </div>
        </form>
        </div>
    </main>


    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([-2.1, 102.3], 11);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 50,
            }).addTo(map);

            // Load GeoJSON data
            fetch('/geojson/geopark_merangin.json') // Ganti dengan path file GeoJSON yang Anda simpan
                .then(response => response.json())
                .then(data => {
                    L.geoJSON(data, {
                        style: function(feature) {
                            return {
                                color: 'blue',
                                fillColor: '#f03',
                                fillOpacity: 0.1
                            };
                        },

                    }).addTo(map);

                });


            // Buat ikon khusus
            var customIcon = L.icon({
                iconUrl: '../icon-marker/markergreen.png', // Ganti dengan path ikon Anda
                iconSize: [22, 34], // Ukuran ikon
                iconAnchor: [16, 32], // Titik anchor (bagian bawah tengah ikon)
                popupAnchor: [0, -32] // Titik anchor popup
            });

            // var marker yang berisi lokasi lama desa;
            let marker = L.marker([{{ $desa->latitude }}, {{ $desa->longitude }}], {
                draggable: true
            }).addTo(map);


            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;

                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                // Hapus marker sebelumnya jika ada
                if (marker) {
                    map.removeLayer(marker);
                }

                // Tambahkan marker pada lokasi yang diklik (pembaruan lokasi)
                marker = L.marker([lat, lng]).addTo(map);
            });
        });
    </script>
    <script>
        document.getElementById('updateButton').addEventListener('click', function() {
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
                    document.getElementById('updateForm').submit();
                }
            });
        });
    </script>

    <script>
        let potensiIndex = {{ count($desa->potensiDesa) }}; // Mulai indeks dari jumlah potensi yang sudah ada

        // Fungsi untuk menambahkan potensi baru
        document.getElementById('add-potensi').addEventListener('click', function() {
            const container = document.getElementById('potensi-container');

            const newPotensi = `
            <div class="potensi-item bg-grey-600 shadow-md rounded-lg p-6" data-index="${potensiIndex}">
                <div>
                    <label for="potensi_desa[${potensiIndex}][nama_potensi]" class="block text-sm font-medium text-gray-700">Nama Potensi</label>
                    <input type="text" name="potensi_desa[${potensiIndex}][nama_potensi]" id="nama_potensi"
                        placeholder="Masukkan Nama Potensi" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="potensi_desa[${potensiIndex}][foto_potensi]" class="block text-sm font-medium text-gray-700">Foto Potensi</label>
                    <input type="file" id="foto_potensi" name="potensi_desa[${potensiIndex}][foto_potensi]" accept="image/*"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                    <p class="text-xs text-gray-500 mt-1">
                        Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                    </p>
                </div>
                <div>
                    <label for="potensi_desa[${potensiIndex}][deskripsi_potensi]"
                        class="block text-sm font-medium text-gray-700">Deskripsi Potensi</label>
                    <input type="text" name="potensi_desa[${potensiIndex}][deskripsi_potensi]" id="deskripsi_potensi"
                        placeholder="Masukkan Deskripsi Potensi" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <button type="button" class="remove-potensi bg-red-500 text-white px-4 py-2 rounded-md mt-4" data-index="${potensiIndex}">
                    Hapus Potensi
                </button>
            </div>
        `;
            container.insertAdjacentHTML('beforeend', newPotensi);
            potensiIndex++;
        });

        // Fungsi untuk menghapus potensi
        document.getElementById('potensi-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-potensi')) {
                const potensiItem = e.target.closest('.potensi-item');
                potensiItem.remove();
            }
        });
    </script>

@endsection
