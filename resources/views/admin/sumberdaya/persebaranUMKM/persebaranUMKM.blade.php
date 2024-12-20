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
                <p class="text-sm mt-2 text-indigo-900">
                    *klik marker untuk melihat detail potensi/umkm
                </p>
            </div>
        </div>

        <div class="bg-gray-200 p-4">
            @foreach ($kecamatans as $kecamatan)
                <div class="flex items-start justify-between mb-1 cursor-pointer" id="kecamatan-{{ $kecamatan->id }}"
                    onclick="toggleDropdown('{{ $kecamatan->nama_kecamatan }}')">
                    <!-- Kolom untuk Nama Kecamatan dan Tombol Edit/Hapus -->
                    <div class="flex flex-col">
                        <h2 class="text-lg font-semibold">{{ $kecamatan->nama_kecamatan }}</h2>
                        <div class="flex mt-1">
                            <button class="text-yellow-500 mx-1 hover:text-blue-700 text-sm"
                                onclick="openEditKecamatanModal('{{ $kecamatan->id }}', '{{ $kecamatan->nama_kecamatan }}'); event.stopPropagation();">
                                <i class="fas fa-edit"></i>
                            </button>
                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.delete-kecamatan', $kecamatan->id) }}" method="POST"
                                class="text-red-500 mx-1 hover:text-red-700" onclick="event.stopPropagation();">
                                @csrf
                                <button type="submit" class="delete-button mx-2 text-gray-600 hover:text-gray-900">
                                    <i class="fa-solid fa-trash text-red-600 hover:text-gray-900"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Kolom untuk Chevron -->
                    <div class="ml-auto">
                        <i class="fas fa-chevron-down text-gray-600"></i>
                    </div>
                </div>

                <ul id="{{ $kecamatan->nama_kecamatan }}" style="display: none">
                    @if ($kecamatan->potensiDesa->isEmpty())
                        <li style="list-style-type: none;">
                            <p class="text-black-500">Desa ini Tidak Memiliki Potensi Persebaran</p>
                        </li>
                    @else
                        @foreach ($kecamatan->potensiDesa as $potensi)
                            <li style="list-style-type: none;">
                                <a href="{{ route('admin.detail-potensi', ['kecamatan_id' => $kecamatan->id, 'potensi_id' => $potensi->id]) }}"
                                    class="text-blue-500 hover:text-blue-700">Potensi {{ $potensi->nama_potensi }}</a>

                                <!-- Tombol Edit -->
                                <div class="flex">
                                    <a href="{{ route('admin.edit-potensi', ['kecamatan_id' => $kecamatan->id, 'potensi_id' => $potensi->id]) }}"
                                        class="text-yellow-500 hover:text-yellow-700 ml-4">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form
                                        action="{{ route('admin.delete-potensi', ['kecamatan_id' => $kecamatan->id, 'potensi_id' => $potensi->id]) }}"
                                        method="POST" class="inline-block ml-2">
                                        @csrf
                                        <button type="submit" onclick="return false;"
                                            class="delete-button text-red-500 hover:text-red-700"
                                            data-id="{{ $potensi->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
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
                                <a href="{{ route('admin.detail-umkm', ['umkm_id' => $umkm->id, 'kecamatan_id' => $kecamatan->id]) }}"
                                    class="text-blue-500 hover:text-blue-700">UMKM {{ $umkm->nama_umkm }}</a>
                            </li>
                            <div class="flex">
                                <a
                                    href="{{ route('admin.edit-umkm', ['umkm_id' => $umkm->id, 'kecamatan_id' => $kecamatan->id]) }}">
                                    <button class="mx-2 text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-edit" style="color: #ea7434;"></i>
                                    </button>
                                </a>
                                <form
                                    action="{{ route('admin.destroy-umkm', ['umkm_id' => $umkm->id, 'kecamatan_id' => $kecamatan->id]) }}"
                                    method="POST" class="text-red-500 mx-1 hover:text-red-700">
                                    @csrf
                                    <button type="submit" class="delete-button mx-2 text-gray-600 hover:text-gray-900">
                                        <i class="fa-solid fa-trash text-red-600 hover:text-gray-900"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    @endif

                    <!-- Tombol Tambah (potensi / umkml) -->
                    <li class="flex justify-end">
                        <a href="#" class="text-green-500 mx-1 hover:text-green-700"
                            onclick="openAddModal('{{ $kecamatan->id }}')">
                            <i class="fas fa-plus"></i>
                        </a>
                    </li>
                </ul>
            @endforeach
        </div>

        <div class="flex">
            <a href="#" class="text-green-500 mx-1 hover:text-green-700" onclick="openAddKecamatanModal()">
                <i class="fas fa-plus"></i> Tambah List Kecamatan
            </a>
        </div>

        <!-- Modal untuk menambahkan kecamatan baru -->
        <div id="addKecamatanModal"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-xl font-bold mb-4">Tambah Kecamatan Baru</h2>
                <!-- Form untuk menambahkan kecamatan -->
                <form action="{{ route('admin.store-kecamatan') }}" method="POST" id="addKecamatanForm">
                    @csrf
                    <input type="text" name="nama_kecamatan" id="nama_kecamatan" placeholder="Nama Kecamatan"
                        class="border p-2 mb-4 w-full" required />

                    <div class="flex justify-start">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Tambah
                        </button>
                        <button type="button" onclick="closeAddKecamatanModal()"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 ml-2">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Modal Untuk Tambah data -->
        <div id="addModal" class="hidden fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-xl font-bold mb-4">Pilih Jenis Tambahan</h2>
                <a id="addPotensiLink" href="#">
                    <button class="block w-full text-left py-2 px-4 mb-2 hover:bg-green-200">
                        Potensi Alam
                    </button>
                </a>
                <a id="addUmkmLink" href="#">
                    <button class="block w-full text-left py-2 px-4 mb-2 hover:bg-blue-200">
                        UMKM
                    </button>
                </a>
                <button onclick="closeAddModal()"
                    class="block w-full text-center py-2 px-4 bg-red-200 hover:bg-gray-300 rounded-lg text-gray-700 font-semibold">
                    Batal
                </button>
            </div>
        </div>



        <!-- Modal untuk Mengedit Kecamatan -->
        <div id="editKecamatanModal"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-xl font-bold mb-4">Edit Kecamatan</h2>

                <!-- Form Edit Kecamatan -->
                <form id="editKecamatanForm" method="POST">
                    @csrf
                    <input type="text" name="nama_kecamatan" id="editKecamatanName" class="border p-2 mb-4 w-full"
                        value="{{ old('nama_kecamatan', $kecamatan->nama_kecamatan) }}" required />

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Simpan
                        </button>
                        <button type="button" onclick="closeEditKecamatanModal()"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 ml-2">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
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

        // Tambahkan marker dengan ikon hijau untuk setiap potensi
        potensis.forEach(function(potensi) {
            var popupContent =
                '<div>' +
                '<a href="/admin/persebaran/potensi/kecamatan/' + potensi.kecamatan_id + '/potensi/' + potensi.id +
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
                '<a href="/admin/persebaran/umkm/' + umkm.id + '/kecamatan/' + umkm.kecamatan_id + '/detail">' +
                umkm.nama_umkm + '<br>' + umkm.deskripsi_umkm + '</a>' +
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

        var marker; // Deklarasi marker di luar event click

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
    </script>


    <script>
        function toggleDropdown(id) {
            const list = document.getElementById(id);
            list.style.display = list.style.display === "none" ? "block" : "none";
        }

        // Function to open modal and set links with kecamatan id
        function openAddModal(kecamatanId) {
            document.getElementById('addModal').classList.remove('hidden');

            // Set href dynamically based on kecamatanId
            document.getElementById('addPotensiLink').href = `/admin/persebaran/potensi/create/kecamatan/${kecamatanId}`;
            document.getElementById('addUmkmLink').href = `/admin/persebaran/umkm/create/kecamatan/${kecamatanId}`;
        }

        // Function to close modal
        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }


        // Fungsi untuk menampilkan modal Kecamatan
        function openAddKecamatanModal() {
            document.getElementById('addKecamatanModal').classList.remove('hidden');
        }

        // Fungsi untuk menutup modal kecamatan
        function closeAddKecamatanModal() {
            document.getElementById('addKecamatanModal').classList.add('hidden');
        }

        // Fungsi untuk membuka modal edit kecamatan dan mengisi nilai awal
        function openEditKecamatanModal(id, namaKecamatan) {
            // Atur action form edit ke route Laravel dengan ID kecamatan
            const form = document.getElementById('editKecamatanForm');
            form.action = `/admin/persebaran/kecamatan/${id}/update`;

            // Isi input dengan nama kecamatan yang akan diedit
            document.getElementById('editKecamatanName').value = namaKecamatan;

            // Tampilkan modal
            document.getElementById('editKecamatanModal').classList.remove('hidden');
        }

        // Fungsi untuk menutup modal edit kecamatan
        function closeEditKecamatanModal() {
            document.getElementById('editKecamatanModal').classList.add('hidden');
        }


        // Fungsi untuk memunculkan pop-up konfirmasi dengan SweetAlert pada tombol hapus
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Cegah submit form langsung

                const form = this.closest('form'); // Temukan form terdekat
                const persebaranId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Apakah Anda yakin ingin menghapus?',
                    text: "Anda tidak akan dapat mengembalikan data ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Hapus!',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Kirim formulir jika konfirmasi diterima
                    }
                });
            });
        });
    </script>
@endsection
