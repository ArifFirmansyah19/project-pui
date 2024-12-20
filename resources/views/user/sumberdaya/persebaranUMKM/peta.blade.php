@extends('layouts.app-user')
@section('title', 'Peta Persebaran PUI GEMAR')

@section('content')
    <!-- Content -->
    <div class="flex flex-col md:flex-row w-full">
        <div class="bg-white shadow-md rounded-lg p-4 md:w-2/3">
            <!-- Konten Persebaran UMKM -->
            <div class="container mx-auto py-4">
                <h3 class="text-3xl font-bold text-center font-poppins text-indigo-900 mb-8 p-4">
                    Peta Persebaran Sumber Daya
                </h3>
                <div class="bg-gray-100 p-2">
                    <div id="map" class="h-50 p-2"></div>
                </div>
            </div>

            <div class="bg-gray-200 p-4">
                <div class="bg-gray-200 p-4">
                    @foreach ($kecamatans as $kecamatan)
                        <div class="flex items-start justify-between mb-1 cursor-pointer" id="kecamatan-{{ $kecamatan->id }}"
                            onclick="toggleDropdown('{{ $kecamatan->nama_kecamatan }}')">
                            <!-- Kolom untuk Nama Kecamatan dan Tombol Edit/Hapus -->
                            <div class="flex flex-col">
                                <h2 class="text-lg font-semibold">{{ $kecamatan->nama_kecamatan }}</h2>
                            </div>

                            <!-- Kolom untuk Chevron -->
                            <div class="ml-auto">
                                <i class="fas fa-chevron-down text-gray-600"></i>
                            </div>
                        </div>

                        <ul class="ml-2" id="{{ $kecamatan->nama_kecamatan }}" style="display: none">
                            @if ($kecamatan->potensiDesa->isEmpty())
                                <li style="list-style-type: none;">
                                    <p class="text-black-500">Desa ini Tidak Memiliki Potensi Persebaran</p>
                                </li>
                            @else
                                @foreach ($kecamatan->potensiDesa as $potensi)
                                    <li style="list-style-type: none;">
                                        <a href="{{ route('detail-potensi-kecamatan', ['kecamatan_id' => $kecamatan->id, 'potensi_id' => $potensi->id]) }}"
                                            class="text-blue-500 hover:text-blue-700">Potensi
                                            {{ $potensi->nama_potensi }}</a>
                                    </li>
                                @endforeach
                            @endif

                            @if ($kecamatan->umkm->isEmpty())
                                <li style="list-style-type: none;">
                                    <p class="text-black-500">UMKM di Desa ini Kosong</p>
                                </li>
                            @else
                                @foreach ($kecamatan->umkm as $umkm)
                                    <li style="list-style-type: none;">
                                        <a href="{{ route('detail-umkm', ['umkm_id' => $umkm->id, 'kecamatan_id' => $kecamatan->id]) }}"
                                            class="text-blue-500 hover:text-blue-700">UMKM {{ $umkm->nama_umkm }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    @endforeach
                </div>
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
        fetch('/geojson/geopark_merangin.json') // path file GeoJSON yang di simpan
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

        // Buat ikon marker hijau khusus untuk potensi
        var potensiIcon = L.icon({
            iconUrl: '../icon-marker/markergreen.png', // Ganti dengan path ikon Anda
            iconSize: [22, 34], // Ukuran ikon
            iconAnchor: [16, 32], // Titik anchor (bagian bawah tengah ikon)
            popupAnchor: [0, -32] // Titik anchor popup
        });

        // Data lokasi potensi dari controller
        var potensis = @json($potensis);

        // Membuat array untuk LatLngBounds
        var bounds = new L.LatLngBounds();

        potensis.forEach(function(potensi) {
            var popupContent =
                '<div>' +
                '<a href="/sumberdaya/persebaran/detail-kecamatan/' + potensi.kecamatan_id + '/potensi/' +
                potensi.id +
                '/detail">' +
                '<strong><center>Data Potensi</center>' + potensi.nama_potensi + '</strong></a>' +
                '</div>';

            var marker = L.marker([potensi.latitude, potensi.longitude], {
                    icon: potensiIcon
                })
                .addTo(map)
                .bindPopup(popupContent);

            // Tambahkan marker ke LatLngBounds
            bounds.extend([potensi.latitude, potensi.longitude]);
        });

        // Data UMKM dari controller
        var umkms = @json($umkms);

        // Tambahkan marker untuk setiap lokasi UMKM
        umkms.forEach(function(umkm) {
            var popupContent =
                '<div>' +
                '<a href="/sumberdaya/persebaran/detail-umkm/' + umkm.id + '/kecamatan/' + umkm.kecamatan_id +
                '/detail">' +
                umkm.nama_umkm + '<br>' + umkm.alamat_umkm + '</a>' +
                '</div>';

            var marker = L.marker([umkm.latitude, umkm.longitude])
                .addTo(map)
                .bindPopup(popupContent);

            // Tambahkan marker ke LatLngBounds
            bounds.extend([umkm.latitude, umkm.longitude]);
        });

        // Fokus peta pada semua marker
        map.fitBounds(bounds);

        // Buat ikon khusus
        var customIcon = L.icon({
            iconUrl: 'path/to/your/icon.png', // Ganti dengan path ikon Anda
            iconSize: [32, 32], // Ukuran ikon
            iconAnchor: [16, 32], // Titik anchor (bagian bawah tengah ikon)
            popupAnchor: [0, -32] // Titik anchor popup
        });


        function toggleDropdown(id) {
            const list = document.getElementById(id);
            list.style.display = list.style.display === "none" ? "block" : "none";
        }
    </script>




@endsection
