@extends('layouts.app-admin')
@section('title', 'halaman Persebaran UMKM admin')
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
                //  Menghapus session 'success' agar tidak muncul lagi ketika menekan tombol kembali
                window.history.replaceState({}, document.title, window.location.pathname);
            });
        </script>
    @endif

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

        {{-- Kontainer list --}}
        <div class="bg-gray-200 p-4 mt-10">
            {{-- Bagian Judul Konten List --}}
            <div class="flex items-center justify-between mb-4 cursor-pointer" onclick="toggleDropdown('list2')">
                <h4 class="font-semibold font-poppins">Persebaran Potensi Desa & UMKM</h4>
                <i class="fas fa-chevron-down text-gray-600"></i>
            </div>

            {{-- List 1 --}}
            <ul class="ml-4" id="list2" style="display: none">
                @foreach ($desas as $desa)
                    <li>
                        <div class="flex items-center justify-between mb-4 cursor-pointer"
                            onclick="toggleDropdown('{{ $desa->nama_desa }}')">
                            <h2 class="text-lg font-semibold font-poppins">{{ $desa->nama_desa }}</h2>
                            {{-- <i class="fas fa-chevron-down text-gray-600"></i> --}}

                        </div>

                        {{-- Isian list 1 --}}
                        <ul class="ml-4" id="{{ $desa->nama_desa }}" style="display: none">
                            <div class="container-persebaran grid grid-cols-1 lg:grid-cols-5 gap-6">
                                {{-- Potensi Desa --}}
                                <div class="potensi-desa p-2 col-span-3 bg-white rounded-md shadow-md">
                                    <h5 class="text-lg font-semibold">Daftar Persebaran Potensi Desa {{ $desa->nama_desa }}
                                    </h5>

                                    @if ($desa->potensiDesa->isEmpty())
                                        <a href="{{ route('admin.edit-desa', $desa->id) }}">
                                            <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-md mt-4">
                                                Edit Desa dan Persebarannya
                                            </button>
                                        </a>
                                        <p class="mb-5">Daftar POTENSI DESA KOSONG</p>
                                    @else
                                        <a href="{{ route('admin.edit-desa', $desa->id) }}">
                                            <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-md mt-4">
                                                Edit Desa dan Persebarannya
                                            </button>
                                        </a>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                                            @foreach ($desa->potensiDesa as $potensi)
                                                <div class="bg-white rounded-md shadow-md overflow-hidden">
                                                    <div class="gambar-produk mt-2 h-100">
                                                        <img src="{{ asset('fotoPotensiDesa/' . $potensi->foto_potensi) }}"
                                                            alt="{{ $potensi->nama_potensi }}"
                                                            class="w-full h-64 object-cover">
                                                    </div>
                                                    <div class="p-4">
                                                        <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                                            {{ $potensi->nama_potensi }}</h3>
                                                        <p class="text-gray-600">{{ $potensi->deskripsi_potensi }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                {{-- UMKM Desa --}}
                                <div class="potensi-umkm-desa p-2 col-span-2 bg-white rounded-md shadow-md">
                                    <h5 class="text-lg font-semibold">Daftar UMKM Desa {{ $desa->nama_desa }}</h5>

                                    @if ($desa->umkm->isEmpty())
                                        <p class="mb-5">Data UMKM di Desa Ini Kosong</p>
                                    @else
                                        @php $no = 1; @endphp
                                        <ul>
                                            @foreach ($desa->umkm as $umkm)
                                                <li class="mb-2" style="list-style-type: none;">
                                                    <a href="{{ route('admin.detail-umkm', $umkm->id) }}"
                                                        class="text-blue-500 hover:text-blue-700">{{ $no++ }}.
                                                        {{ $umkm->nama_umkm }}</a>
                                                    <div class="flex">
                                                        <a href="{{ route('admin.edit-umkm', $umkm->id) }}">
                                                            <button class="mx-2 text-gray-600 hover:text-gray-900">
                                                                <i class="fas fa-edit" style="color: #ea7434;"></i>
                                                            </button>
                                                        </a>
                                                        <form action="{{ route('admin.destroy-umkm', $umkm->id) }}"
                                                            method="POST" class="text-red-500 mx-1 hover:text-red-700">
                                                            @csrf
                                                            <button type="submit"
                                                                class="delete-button mx-2 text-gray-600 hover:text-gray-900">
                                                                <i
                                                                    class="fa-solid fa-trash text-red-600 hover:text-gray-900"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </ul>
                    </li>
                @endforeach
            </ul>
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
