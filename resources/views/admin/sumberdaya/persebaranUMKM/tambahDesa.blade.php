@extends('layouts.app-admin')
@section('title', 'halaman tambah Desa admin')
@section('content-admin')
    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                TAMBAH DESA PERSEBARAN GEOPARK MERANGIN
            </h2>
            <div id="map"></div>
        </div>
        <form action="{{ route('admin.store-desa') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Nama Desa -->
            <div>
                <label for="nama_desa" class="block text-sm font-medium text-gray-700">Nama Desa</label>
                <input type="text" id="nama_desa" name="nama_desa"
                    placeholder="Masukkan desa berpotensi di Kawasan Geopark Merangin" required
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- Deskripsi Desa -->
            <div>
                <label for="deskripsi_desa" class="block text-sm font-medium text-gray-700">Deskripsi Desa</label>
                <input type="text" id="deskripsi_desa" name="deskripsi_desa"
                    placeholder="Masukkan desa berpotensi di Kawasan Geopark Merangin" required
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- latitude -->
            <div>
                <label for="latitude" class="block text-sm font-medium text-gray-700">latitude</label>
                <input type="text" id="latitude" name="latitude" placeholder="latitude" readonly
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- longitude -->
            <div>
                <label for="longitude" class="block text-sm font-medium text-gray-700">longitude</label>
                <input type="text" id="longitude" name="longitude" placeholder="longitude" readonly
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            {{-- jenis potensi desa --}}
            <div id="potensi-container">
                <label for="potensi-desa" class="block text-sm font-medium text-gray-700">Potensi Desa</label>
                <div class="potensi-item bg-grey-600 shadow-md rounded-lg p-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Potensi</label>
                        <input type="text" name="potensi_desa[${potensiIndex}][nama_potensi]"
                            placeholder="Masukkan Nama Potensi" required
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Foto Potensi</label>
                        <input type="file" name="potensi_desa[${potensiIndex}][foto_potensi]" accept="image/*"
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                        <p class="text-xs text-gray-500 mt-1">
                            Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi Potensi</label>
                        <input type="text" name="potensi_desa[${potensiIndex}][deskripsi_potensi]"
                            placeholder="Masukkan Deskripsi Potensi" required
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <button type="button" class="add-potensi bg-blue-500 text-white px-4 py-2 rounded-md mt-4">
                        Tambah Potensi
                    </button>

                    <button type="button" class="remove-potensi bg-red-500 text-white px-4 py-2 rounded-md mt-4">
                        Hapus Potensi
                    </button>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                    Tambah
                </button>
            </div>
        </form>
        </div>
    </main>


    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
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
            iconUrl: 'path/to/your/icon.png', // Ganti dengan path ikon Anda
            iconSize: [32, 32], // Ukuran ikon
            iconAnchor: [16, 32], // Titik anchor (bagian bawah tengah ikon)
            popupAnchor: [0, -32] // Titik anchor popup
        });

        var marker;

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            // Hapus marker sebelumnya jika ada
            if (marker) {
                map.removeLayer(marker);
            }

            // Tambahkan marker pada lokasi yang diklik
            marker = L.marker([lat, lng]).addTo(map);
        });
    </script>

    <script>
        let potensiIndex = 1;

        document.getElementById('potensi-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('add-potensi')) {
                const container = document.getElementById('potensi-container');
                const newPotensi = `
            <div class="potensi-item bg-grey-600 shadow-md rounded-lg p-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Potensi</label>
                    <input type="text" name="potensi_desa[${potensiIndex}][nama_potensi]"
                        placeholder="Masukkan Nama Potensi" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Foto Potensi</label>
                    <input type="file" name="potensi_desa[${potensiIndex}][foto_potensi]" accept="image/*"
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                    <p class="text-xs text-gray-500 mt-1">
                        Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Deskripsi Potensi</label>
                    <input type="text" name="potensi_desa[${potensiIndex}][deskripsi_potensi]"
                        placeholder="Masukkan Deskripsi Potensi" required
                        class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <button type="button" class="add-potensi bg-blue-500 text-white px-4 py-2 rounded-md mt-4">
                    Tambah Potensi
                </button>

                <button type="button" class="remove-potensi bg-red-500 text-white px-4 py-2 rounded-md mt-4">
                    Hapus Potensi
                </button>
            </div>
        `;
                container.insertAdjacentHTML('beforeend', newPotensi);
                potensiIndex++;
            } else if (e.target.classList.contains('remove-potensi')) {
                const potensiItem = e.target.closest('.potensi-item');
                potensiItem.remove();
            }
        });
    </script>
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            let isValid = true;
            document.querySelectorAll('input[type="file"]').forEach(function(fileInput) {
                if (fileInput.files.length > 0) {
                    const fileSize = fileInput.files[0].size / 1024 / 1024; // in MB
                    if (fileSize > 2) {
                        alert("Ukuran file maksimal adalah 2MB.");
                        isValid = false;
                    }
                }
            });
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>

@endsection
