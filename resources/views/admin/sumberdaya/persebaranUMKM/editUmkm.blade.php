@extends('layouts.app-admin')
@section('title', 'halaman Edit UMKM PUI GEMAR')
@section('content-admin')

    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                Halaman Edit UMKM PUI GEMAR
            </h2>

            <div id="map"></div>

        </div>
        <form id="updateForm" action="{{ route('admin.update-umkm', $umkm->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            <!-- Nama -->
            <div>
                <label for="nama_umkm" class="block text-sm font-medium text-gray-700">Nama UMKM</label>
                <input type="text" id="nama_umkm" name="nama_umkm" placeholder="Masukkan nama UMKM" required
                    value="{{ old('nama_umkm', $umkm->nama_umkm) }}"
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- Nama Pemilik -->
            <div>
                <label for="nama_pemilik" class="block text-sm font-medium text-gray-700">Nama Pemilik
                    UMKM</label>
                <input type="text" id="nama_pemilik" name="nama_pemilik" placeholder="Masukkan nama Pemilik" required
                    value="{{ old('nama_pemilik', $umkm->nama_pemilik) }}"
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            {{-- alamat UMKM --}}
            <div>
                <label for="alamat_umkm" class="block text-sm font-medium text-gray-700">Alamat UMKM</label>
                <input type="text" id="alamat_umkm" name="alamat_umkm" placeholder="Masukkan alamat UMKM" required
                    value="{{ old('alamat_umkm', $umkm->alamat_umkm) }}"
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- latitude -->
            <div>
                <label for="latitude" class="block text-sm font-medium text-gray-700">latitude</label>
                <input type="text" id="latitude" name="latitude" placeholder="latitude" readonly
                    value="{{ old('latitude', $umkm->latitude) }}"
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- longitude -->
            <div>
                <label for="longitude" class="block text-sm font-medium text-gray-700">longitude</label>
                <input type="text" id="longitude" name="longitude" placeholder="longitude" readonly
                    value="{{ old('longitude', $umkm->longitude) }}"
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- foto tempat UMKM -->
            <div>
                @if ($umkm->foto_umkm)
                    <label for="foto_umkm" class="block text-sm font-medium text-gray-700">foto UMKM Lama</label>
                    <input type="hidden" name="foto_lama" value="{{ $umkm->foto_umkm }}">
                    <div class="foto_lama">
                        <img src="{{ asset('storage/' . $umkm->foto_umkm) }}" height="150px" width="150px"
                            alt="foto {{ $umkm->nama_umkm }}">
                    </div>
                @endif
                <label for="foto_umkm" class="block text-sm font-medium text-gray-700">Input Foto UMKM Baru
                    (Opsional)</label>
                <input type="file" id="foto_umkm" name="foto_umkm" {{-- accept="image/*" --}}
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                <p class="text-xs text-gray-500 mt-1">
                    Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                </p>

            </div>

            {{-- deskripsi UMKM --}}
            <div>
                <label for="deskripsi_umkm" class="block text-sm font-medium text-gray-700">Deskripsi UMKM</label>
                <input type="text" id="deskripsi_umkm" name="deskripsi_umkm" placeholder="Masukkan detail UMKM" required
                    value="{{ old('deskripsi_umkm', $umkm->deskripsi_umkm) }}"
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            {{-- kontak UMKM --}}
            <div>
                <label for="kontak" class="block text-sm font-medium text-gray-700">KONTAK UMKM</label>
                <input type="text" id="kontak" name="kontak" placeholder="Masukkan kontak UMKM" required
                    value="{{ old('kontak', $umkm->kontak) }}"
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- WA UMKM -->
            <div>
                <label for="whatsapp" class="block text-sm font-medium text-gray-700">Kontak WhatsApp UMKM</label>
                <p class="text-xs text-gray-500 mt-1">Petunjuk Pengisian: cukup masukkan angka tanpa mengikutsertakan 0/+.
                </p>
                <input type="text" id="whatsapp" name="whatsapp" placeholder="Contoh: 6282250649883" required
                    value="{{ old('whatsapp', $umkm->whatsapp) }}"
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- Email UMKM -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email UMKM</label>
                <p class="text-xs text-gray-500 mt-1">Petunjuk Pengisian: Masukkan format email dengan benar.</p>
                <input type="email" id="email" name="email" placeholder="Masukkan email UMKM" required
                    value="{{ old('email', $umkm->email) }}"
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- Instagram UMKM -->
            <div>
                <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram UMKM</label>
                <p class="text-xs text-gray-500 mt-1">Petunjuk Pengisian: Masukkan link Instagram usaha di inputan berikut
                </p>
                <input type="url" id="instagram" name="instagram" placeholder="Masukkan Instagram UMKM" required
                    value="{{ old('instagram', $umkm->instagram) }}"class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- Desa Potensi Id -->
            <label for="desa_potensi_id" class="block text-sm font-medium text-gray-700">
                Desa
            </label>
            <select id="desa_potensi_id" name="desa_potensi_id" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                @foreach ($desas as $desa)
                    <option value="{{ $desa->id }}" {{ $desa->id == $umkm->desa_potensi_id ? 'selected' : '' }}>
                        {{ $desa->nama_desa }}</option>
                @endforeach
            </select>

            <!-- Input Produk -->
            <div id="produk-container">
                <label for="produk-umkm" class="block text-sm font-medium text-gray-700">Produk UMKM</label>
                @if ($umkm->produkUmkm->isEmpty())
                    <p>Produk UMKM kosong.</p>
                @else
                    @foreach ($umkm->produkUmkm as $index => $produk)
                        <div class="produk-item bg-grey-600 shadow-md rounded-lg p-6" data-index="${produkIndex}">
                            <div>
                                <label for="produk_umkm[{{ $index }}][nama_produk]"
                                    class="block text-sm font-medium text-gray-700">Nama
                                    Produk</label>
                                <input type="text" name="produk_umkm[{{ $index }}][nama_produk]"
                                    id="nama_produk" value="{{ $produk->nama_produk }}"
                                    placeholder="Masukkan Nama Produk" required
                                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="produk_umkm[{{ $index }}][deskripsi_produk]"
                                    class="block text-sm font-medium text-gray-700">Deskripsi
                                    Produk</label>
                                <input type="text" name="produk_umkm[{{ $index }}][deskripsi_produk]"
                                    id="deskripsi_produk" value="{{ $produk->deskripsi_produk }}"
                                    placeholder="Masukkan Deskripsi Produk" required
                                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="produk_umkm[{{ $index }}][foto_produk]"
                                    class="block text-sm font-medium text-gray-700">Foto
                                    Produk</label>
                                @if ($produk->foto_produk)
                                    <input type="hidden" name="produk_umkm[{{ $index }}][old_foto_produk]"
                                        value="{{ $produk->foto_produk }}">
                                    <img src="{{ asset('storage/' . $produk->foto_produk) }}"
                                        alt="Foto Produk {{ $produk->nama_produk }}" class="mt-2"
                                        style="width: 100px; height: 100px;">
                                @endif
                                <input type="file" id="foto_produk"
                                    name="produk_umkm[{{ $index }}][foto_produk]" accept="image/*"
                                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                                <p class="text-xs text-gray-500 mt-1">
                                    Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                                </p>
                            </div>

                            <div>
                                <label for="produk_umkm[{{ $index }}][harga_terendah]"
                                    class="block text-sm font-medium text-gray-700">Harga
                                    Terendah</label>
                                <input type="number" name="produk_umkm[{{ $index }}][harga_terendah]"
                                    id="harga_terendah" value="{{ $produk->harga_terendah }}" step="0,01"
                                    min="0" placeholder="Masukkan Harga Terendah Produk" required
                                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="produk_umkm[{{ $index }}][harga_tertinggi]"
                                    class="block text-sm font-medium text-gray-700">Harga
                                    Tertinggi</label>
                                <input type="number" name="produk_umkm[{{ $index }}][harga_tertinggi]"
                                    id="harga_tertinggi" step="0,01" min="0"
                                    placeholder="Masukkan Harga Tertinggi Produk" required
                                    value="{{ $produk->harga_tertinggi }}"
                                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <button type="button" class="remove-produk bg-red-500 text-white px-4 py-2 rounded-md mt-4"
                                data-index="${produkIndex}">
                                Hapus Produk
                            </button>
                        </div>
                        <br>
                    @endforeach
                @endif
            </div>

            <button type="button" id="add-produk" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">
                Tambah Produk
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
                iconUrl: 'path/to/your/icon.png', // Ganti dengan path ikon Anda
                iconSize: [32, 32], // Ukuran ikon
                iconAnchor: [16, 32], // Titik anchor (bagian bawah tengah ikon)
                popupAnchor: [0, -32] // Titik anchor popup
            });

            // var marker yang berisi lokasi lama UMKM;
            let marker = L.marker([{{ $umkm->latitude }}, {{ $umkm->longitude }}], {
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
        let produkIndex = {{ count($umkm->produkUmkm) }}; // Starting index based on existing products

        document.getElementById('add-produk').addEventListener('click', function() {
            const container = document.getElementById('produk-container');
            const newProduct = `
                <div class="produk-item bg-grey-600 shadow-md rounded-lg p-6" data-index="${produkIndex}">
                    <div>
                        <label for="produk_umkm[${produkIndex}][nama_produk]" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input type="text" name="produk_umkm[${produkIndex}][nama_produk]" id="nama_produk_${produkIndex}"
                            placeholder="Masukkan Nama Produk" required
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="produk_umkm[${produkIndex}][deskripsi_produk]" class="block text-sm font-medium text-gray-700">Deskripsi Produk</label>
                        <input type="text" name="produk_umkm[${produkIndex}][deskripsi_produk]" id="deskripsi_produk_${produkIndex}"
                            placeholder="Masukkan Deskripsi Produk" required
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="produk_umkm[${produkIndex}][foto_produk]" class="block text-sm font-medium text-gray-700">Foto Produk</label>
                        <input type="file" id="foto_produk_${produkIndex}" name="produk_umkm[${produkIndex}][foto_produk]" accept="image/*"
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                        <p class="text-xs text-gray-500 mt-1">Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.</p>
                    </div>
                    <div>
                        <label for="produk_umkm[${produkIndex}][harga_terendah]"
                            class="block text-sm font-medium text-gray-700">Harga
                            Terendah</label>
                        <input type="number" name="produk_umkm[${produkIndex}][harga_terendah]"
                            id="harga_terendah_${produkIndex}" step="0,01"
                            min="0" placeholder="Masukkan Harga Terendah Produk" required
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="produk_umkm[${produkIndex}][harga_tertinggi]"
                            class="block text-sm font-medium text-gray-700">Harga
                            Tertinggi</label>
                        <input type="number" name="produk_umkm[${produkIndex}][harga_tertinggi]"
                            id="harga_tertinggi_${produkIndex}" step="0,01" min="0"
                            placeholder="Masukkan Harga Tertinggi Produk" required
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <button type="button" class="remove-produk bg-red-500 text-white px-4 py-2 rounded-md mt-4 data-index="${produkIndex}"">Hapus Produk</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newProduct);
            produkIndex++;
        });

        document.getElementById('produk-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-produk')) {
                const produkItem = e.target.closest('.produk-item');
                produkItem.remove();
            }
        });
    </script>
@endsection
