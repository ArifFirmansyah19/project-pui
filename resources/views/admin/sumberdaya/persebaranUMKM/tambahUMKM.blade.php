@extends('layouts.app-admin')
@section('title', 'Halaman Tambah UMKM Admin')
@section('content-admin')
    <main class="flex-1 bg-gray-100 p-4 sm:p-6 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Formulir UMKM</h2>
            <div id="map"></div>
        </div>

        <form action="{{ route('admin.store-umkm') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <!-- Nama UMKM -->
            <div>
                <label for="nama_umkm" class="block text-sm font-medium text-gray-700">Nama UMKM</label>
                <input type="text" id="nama_umkm" name="nama_umkm" placeholder="Masukkan nama UMKM" required
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                @error('nama_umkm')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Desa Potensi Id -->
            <div>
                <label for="desa_potensi_id" class="block text-sm font-medium text-gray-700">Desa UMKM</label>
                <select id="desa_potensi_id" name="desa_potensi_id" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Pilih Desa</option>
                    @foreach ($desas as $desa)
                        <option value="{{ $desa->id }}">{{ $desa->nama_desa }}</option>
                    @endforeach
                </select>
                @error('desa_potensi_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nama Pemilik -->
            <div>
                <label for="nama_pemilik" class="block text-sm font-medium text-gray-700">Nama Pemilik UMKM</label>
                <input type="text" id="nama_pemilik" name="nama_pemilik" placeholder="Masukkan nama Pemilik" required
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                @error('nama_pemilik')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Alamat UMKM -->
            <div>
                <label for="alamat_umkm" class="block text-sm font-medium text-gray-700">Alamat UMKM</label>
                <input type="text" id="alamat_umkm" name="alamat_umkm" placeholder="Masukkan alamat UMKM" required
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                @error('alamat_umkm')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Latitude -->
            <div>
                <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                <input type="text" id="latitude" name="latitude" placeholder="Latitude" readonly
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- Longitude -->
            <div>
                <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                <input type="text" id="longitude" name="longitude" placeholder="Longitude" readonly
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <!-- Foto UMKM -->
            <div>
                <label for="foto_umkm" class="block text-sm font-medium text-gray-700">Foto UMKM</label>
                <input type="file" id="foto_umkm" name="foto_umkm"
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                <p class="text-xs text-gray-500 mt-1">Format yang didukung: JPG, PNG. Ukuran file maksimal: 2MB.</p>
                @error('foto_umkm')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Deskripsi UMKM -->
            <div>
                <label for="deskripsi_umkm" class="block text-sm font-medium text-gray-700">Deskripsi UMKM</label>
                <input type="text" id="deskripsi_umkm" name="deskripsi_umkm" placeholder="Masukkan detail UMKM" required
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                @error('deskripsi_umkm')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Kontak UMKM -->
            <div>
                <label for="kontak" class="block text-sm font-medium text-gray-700">Nomor Telepon UMKM</label>
                <input type="text" id="kontak" name="kontak" placeholder="Masukkan kontak telepon UMKM" required
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                @error('kontak')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- WA UMKM -->
            <div>
                <label for="whatsapp" class="block text-sm font-medium text-gray-700">Kontak WhatsApp UMKM</label>
                <p class="text-xs text-gray-500 mt-1">Petunjuk Pengisian: cukup masukkan angka tanpa mengikutsertakan 0/+.
                </p>
                <input type="text" id="whatsapp" name="whatsapp" placeholder="Contoh: 6282250649883" required
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                @error('whatsapp')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email UMKM -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email UMKM</label>
                <p class="text-xs text-gray-500 mt-1">Petunjuk Pengisian: Masukkan format email dengan benar.</p>
                <input type="email" id="email" name="email" placeholder="Masukkan email UMKM" required
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Instagram UMKM -->
            <div>
                <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram UMKM</label>
                <p class="text-xs text-gray-500 mt-1">Petunjuk Pengisian: Masukkan link Instagram usaha di inputan berikut
                </p>
                <input type="url" id="instagram" name="instagram" placeholder="Masukkan Instagram UMKM" required
                    class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                @error('instagram')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Produk UMKM -->
            <!-- Input Produk -->
            <div id="produk-container">
                <label for="produk-umkm" class="block text-sm font-medium text-gray-700">Produk UMKM</label>
                <div class="produk-item bg-grey-600 shadow-md rounded-lg p-6">
                    <div>
                        <label for="produk_umkm[0][nama_produk]" class="block text-sm font-medium text-gray-700">Nama
                            Produk</label>
                        <input type="text" name="produk_umkm[0][nama_produk]" id="nama_produk"
                            placeholder="Masukkan Nama Produk" required
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="produk_umkm[0][deskripsi_produk]"
                            class="block text-sm font-medium text-gray-700">Deskripsi
                            Produk</label>
                        <input type="text" name="produk_umkm[0][deskripsi_produk]" id="deskripsi_produk"
                            placeholder="Masukkan Deskripsi Produk" required
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="produk_umkm[0][foto_produk]" class="block text-sm font-medium text-gray-700">Foto
                            Produk</label>
                        <input type="file" id="foto_produk" name="produk_umkm[0][foto_produk]" accept="image/*"
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                        <p class="text-xs text-gray-500 mt-1">
                            Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                        </p>
                    </div>
                    <div>
                        <label for="produk_umkm[0][harga_terendah]" class="block text-sm font-medium text-gray-700">Harga
                            Terendah</label>
                        <input type="number" name="produk_umkm[0][harga_terendah]" id="harga_terendah" step="0,01"
                            min="0" placeholder="Masukkan Harga Terendah Produk" required
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="produk_umkm[0][harga_tertinggi]" class="block text-sm font-medium text-gray-700">Harga
                            Tertinggi</label>
                        <input type="number" name="produk_umkm[0][harga_tertinggi]" id="harga_tertinggi" step="0,01"
                            min="0" placeholder="Masukkan Harga Tertinggi Produk" required
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <button type="button" class="add-produk bg-blue-500 text-white px-4 py-2 rounded-md mt-4">
                        Tambah Produk
                    </button>
                    <button type="button" class="remove-produk bg-red-500 text-white px-4 py-2 rounded-md mt-4">
                        Hapus Produk
                    </button>
                </div>
            </div>



            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                    Simpan
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
        let produkIndex = 1;


        document.getElementById('produk-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('add-produk')) {
                const container = document.getElementById('produk-container');
                const newProduk = `
                <div class="produk-item bg-grey-600 shadow-md rounded-lg p-6">
                    <div>
                        <label for="produk_umkm[${produkIndex}][nama_produk]" class="block text-sm font-medium text-gray-700">Nama
                            Produk</label>
                        <input type="text" name="produk_umkm[${produkIndex}][nama_produk]" id="nama_produk"
                            placeholder="Masukkan Nama Produk" required
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="produk_umkm[${produkIndex}][deskripsi_produk]"
                            class="block text-sm font-medium text-gray-700">Deskripsi
                            Produk</label>
                        <input type="text" name="produk_umkm[${produkIndex}][deskripsi_produk]" id="deskripsi_produk"
                            placeholder="Masukkan Deskripsi Produk" required
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="produk_umkm[${produkIndex}][foto_produk]" class="block text-sm font-medium text-gray-700">Foto
                            Produk</label>
                        <input type="file" id="foto_produk" name="produk_umkm[${produkIndex}][foto_produk]" accept="image/*"
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500" />
                        <p class="text-xs text-gray-500 mt-1">
                            Format yang didukung: JPG, PNG Ukuran file maksimal: 2MB.
                        </p>
                    </div>
                    <div>
                        <label for="produk_umkm[${produkIndex}][harga_terendah]"
                            class="block text-sm font-medium text-gray-700">Harga Terendah</label>
                        <input type="number" name="produk_umkm[${produkIndex}][harga_terendah]" id="harga_terendah" step="0,01" min="0"
                            placeholder="Masukkan Harga Terendah Produk" required
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    </div> 
                    <div>
                        <label for="produk_umkm[${produkIndex}][harga_tertinggi]"
                            class="block text-sm font-medium text-gray-700">Harga tertinggi</label>
                        <input type="number" name="produk_umkm[${produkIndex}][harga_tertinggi]" id="harga_tertinggi" step="0,01" min="0"
                            placeholder="Masukkan Harga Tertinggi Produk" required
                            class="w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                    </div>                   
                    <button type="button" class="add-produk bg-blue-500 text-white px-4 py-2 rounded-md mt-4">
                        Tambah Produk
                    </button>
                    <button type="button" class="remove-produk bg-red-500 text-white px-4 py-2 rounded-md mt-4">
                        Hapus Produk
                    </button>
                </div>
        `;
                container.insertAdjacentHTML('beforeend', newProduk);
                produkIndex++;
            } else if (e.target.classList.contains('remove-produk')) {
                const produkItem = e.target.closest('.produk-item');
                produkItem.remove();
            }
        });
    </script>

@endsection
