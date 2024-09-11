@extends('layouts.app-admin')
@section('title', 'halaman Persebaran UMKM admin')
@section('content-admin')

    <!-- Content -->
    <main class="flex-1 bg-gray-100 p-4 sm:p-6">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h3 class="text-3xl font-bold text-center font-poppins text-indigo-900 mt-2 mb-8 p-4">
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
                            <a href="{{ route('admin.detail-desa', $desa->id) }}"
                                class="text-blue-500 hover:text-blue-700">Potensi Alam Desa
                                {{ $desa->nama_desa }}</a>
                        </li>
                        <div class="flex">
                            <a href="{{ route('admin.edit-desa', $desa->id) }}">
                                <button class="mx-2 text-gray-600 hover:text-gray-900">
                                    <i class="fas fa-edit" style="color: #ea7434;"></i>
                                </button>
                            </a>
                        </div>
                    @endif

                    @if ($desa->umkm->isEmpty())
                        <li style="list-style-type: none;">
                            <p class="text-black-500">UMKM di Desa ini Kosong</p>
                        </li>
                    @else
                        @foreach ($desa->umkm as $umkm)
                            <li style="list-style-type: none;">
                                <a href="{{ route('admin.detail-umkm', $umkm->id) }}"
                                    class="text-blue-500 hover:text-blue-700">{{ $umkm->nama_umkm }}</a>
                            </li>
                            <div class="flex">
                                <a href="{{ route('admin.edit-umkm', $umkm->id) }}">
                                    <button class="mx-2 text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-edit" style="color: #ea7434;"></i>
                                    </button>
                                </a>
                                <form action="{{ route('admin.destroy-umkm', $umkm->id) }}" method="POST"
                                    class="text-red-500 mx-1 hover:text-red-700">
                                    @csrf
                                    <button type="submit" class="delete-button mx-2 text-gray-600 hover:text-gray-900">
                                        <i class="fa-solid fa-trash text-red-600 hover:text-gray-900"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    @endif
                </ul>
            @endforeach
        </div>


        </div>

        <button id="tambahButton"
            class="add-button fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
            aria-label="Tambah Tim">
            <i class="fa-solid fa-plus"></i>
        </button>
    </main>
    <br>

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
            var popupContent =
                '<div> <a href="persebaran/desa/detailDesa/' + desa.id + '">' +
                '<strong> <center>Data Potensi </center>' + desa
                .nama_desa + '</strong> </a> </div>';

            var marker = L.marker([desa.latitude, desa.longitude], {
                    icon: desaIcon
                })
                .addTo(map)
                .bindPopup(popupContent);
        });


        //Data UMKM dari controller
        var umkms = @json($umkms);

        // Tambahkan marker untuk setiap lokasi UMKM
        umkms.forEach(function(umkm) {
            var popupContent =
                '<div> <a href="/admin/persebaran/umkm/detailUMKM/' + umkm.id + '">' + umkm.nama_umkm +
                '<br>' + umkm
                .deskripsi_umkm + '</a></div>'

            var marker = L.marker([umkm.latitude, umkm.longitude])
                .addTo(map)
                .bindPopup(popupContent);
        });

        // Buat ikon khusus
        var customIcon = L.icon({
            iconUrl: 'path/to/your/icon.png', // Ganti dengan path ikon Anda
            iconSize: [32, 32], // Ukuran ikon
            iconAnchor: [16, 32], // Titik anchor (bagian bawah tengah ikon)
            popupAnchor: [0, -32] // Titik anchor popup
        });

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            // Hapus marker sebelumnya jika ada
            if (marker) {
                map.removeLayer(marker);
            }

            // Tambahkan marker pada lokasi yang diklik
            marker = L.marker([lat, lng]), {
                    icon: customIcon
                }
                .addTo(map);
        });

        function toggleDropdown(id) {
            const list = document.getElementById(id);
            list.style.display = list.style.display === "none" ? "block" : "none";
        }

        // pop up untuk memunculkan menu create desa, create UMKM dan create Produk UMKM dari tombol tambahButton
        document.getElementById('tambahButton').addEventListener('click', function() {
            Swal.fire({
                title: 'Pilih yang Ingin Ditambahkan',
                showCancelButton: true,
                showDenyButton: false,
                showConfirmButton: false,
                showCloseButton: true,
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'bg-blue-500 text-white px-4 py-2 rounded',
                    cancelButton: 'bg-red-500 text-white px-4 py-2 rounded',
                    denyButton: 'bg-yellow-500 text-white px-4 py-2 rounded'
                },
                html: `
            <div class="container-button-option mt-2">
                <button onclick="location.href='{{ route('admin.create-desa') }}'"
                    class="bg-blue-900 text-white px-4 py-2 mb-3 rounded w-[200px] ">Tambah Desa</button>
                <br>
                <button onclick="location.href='{{ route('admin.create-umkm') }}'"
                    class="bg-blue-900 text-white px-4 py-2 mb-3 rounded w-[200px] ">Tambah Daftar UMKM</button>
                <br>
            </div>
                   `,
                cancelButtonText: 'Batal'
            });
        });

        // Memunculkan pop-up untuk edit dan delete-button
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form'); // Temukan formulir terdekat dari tombol
                const persebaranId = this.getAttribute('data-id');
                event.preventDefault(); // Cegah tindakan default

                Swal.fire({
                    title: 'Apakah Anda yakin ingin menghapus?',
                    text: "Anda tidak akan dapat mengembalikan artikel ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Hapus!',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Kirim formulir penghapusan
                    }
                });
            });
        });
    </script>
@endsection
