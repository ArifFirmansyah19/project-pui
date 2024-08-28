@extends('layouts.app-user')
@section('title', 'Peta Persebaran PUI GEMAR')

@section('content')
    <!-- Content -->
    <div class="flex flex-col mt-5 md:flex-row w-full">
        <div class="bg-white shadow-md mt-5 rounded-lg p-4 md:w-2/3">
            <!-- Konten Persebaran UMKM -->
            <div class="container mx-auto py-4">
                <h3 class="text-3xl font-bold text-center font-poppins text-indigo-900 mt-10 mb-8 p-4">
                    Peta Persebaran Sumber Daya
                </h3>
                <div class="bg-gray-100 p-2">
                    <div id="map" class="h-50 p-2"></div>
                </div>
            </div>

            <div class="bg-gray-200 p-4">
                @foreach ($desas as $desa)
                    <div class="flex items-center justify-between mb-1 cursor-pointer"
                        onclick="toggleDropdown('{{ $desa->nama_desa }}')">
                        <h2 class="text-lg font-semibold">{{ $desa->nama_desa }}</h2>
                        <i class="fas fa-chevron-down text-gray-600"></i>
                    </div>
                    <ul class="ml-2" id="{{ $desa->nama_desa }}" style="display: none">
                        @if ($desa->potensiDesa->isEmpty())
                            <li style="list-style-type: none;">
                                <p class="text-black-500">Desa ini Tidak Memiliki Potensi Persebaran</p>
                            </li>
                        @else
                            <li style="list-style-type: none;">
                                <a href="{{ route('detail-potensi-desa', $desa->id) }}"
                                    class="text-blue-500 hover:text-blue-700">Potensi Alam Desa {{ $desa->nama_desa }}</a>
                            </li>
                        @endif

                        @if ($desa->umkm->isEmpty())
                            <li style="list-style-type: none;">
                                <p class="text-black-500">UMKM di Desa ini Kosong</p>
                            </li>
                        @else
                            @foreach ($desa->umkm as $umkm)
                                <li style="list-style-type: none;">
                                    <a href="{{ route('detail-umkm', $umkm->id) }}"
                                        class="text-blue-500 hover:text-blue-700">{{ $umkm->nama_umkm }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                @endforeach
            </div>
        </div>
        @include('layouts.session-article')
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Inisialisasi peta dengan koordinat tengah dan zoom level
        var map = L.map('map').setView([-2.1, 102.3], 11);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
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
                    onEachFeature: function(feature, layer) {
                        if (feature.properties && feature.properties.name) {
                            layer.bindPopup(feature.properties.name);
                        }
                    }
                }).addTo(map);
            });

        // Buat ikon marker hijau khusus untuk desa
        var desaIcon = L.icon({
            iconUrl: '../icon-marker/markergreen.png', // Ganti dengan path ikon Anda
            iconSize: [22, 34], // Ukuran ikon
            iconAnchor: [16, 32], // Titik anchor (bagian bawah tengah ikon)
            popupAnchor: [0, -32] // Titik anchor popup
        });

        // Data lokasi desa dari controller
        var desas = @json($desas);

        // Tambahkan marker dengan ikon hijau untuk setiap desa
        desas.forEach(function(desa) {
            var popupContent = `
                <div>
                    <a href="persebaran/detail-desa/${desa.id}">
                        <strong><center>Data Potensi</center> ${desa.nama_desa}</strong>
                    </a>
                </div>
            `;

            L.marker([desa.latitude, desa.longitude], {
                    icon: desaIcon
                })
                .addTo(map)
                .bindPopup(popupContent);
        });

        // Data UMKM dari controller
        var umkms = @json($umkms);

        // Tambahkan marker untuk setiap lokasi UMKM
        umkms.forEach(function(umkm) {
            var popupContent = `
                <div>
                    <a href="persebaran/detail-umkm/${umkm.id}">${umkm.nama_umkm}</a>
                    <br>${umkm.alamat_umkm}
                    <br><br>${umkm.deskripsi_umkm}
                </div>
            `;

            L.marker([umkm.latitude, umkm.longitude])
                .addTo(map)
                .bindPopup(popupContent);
        });

        // Buat ikon khusus untuk marker yang ditambahkan secara manual
        var customIcon = L.icon({
            iconUrl: 'path/to/your/icon.png', // Ganti dengan path ikon Anda
            iconSize: [32, 32], // Ukuran ikon
            iconAnchor: [16, 32], // Titik anchor (bagian bawah tengah ikon)
            popupAnchor: [0, -32] // Titik anchor popup
        });

        var marker; // Variabel untuk marker yang ditambahkan secara manual

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            // Hapus marker sebelumnya jika ada
            if (marker) {
                map.removeLayer(marker);
            }

            // Tambahkan marker pada lokasi yang diklik
            marker = L.marker([lat, lng], {
                    icon: customIcon
                })
                .addTo(map);
        });

        function toggleDropdown(id) {
            const list = document.getElementById(id);
            list.style.display = list.style.display === "none" ? "block" : "none";
        }
    </script>
@endsection
