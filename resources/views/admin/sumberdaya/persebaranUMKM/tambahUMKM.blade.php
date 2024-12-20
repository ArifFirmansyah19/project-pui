@extends('layouts.app-admin')
@section('title', 'Halaman Tambah UMKM Admin')
@section('content-admin')
    <!-- Content -->
    <main class="flex-1 overflow-y-auto">
        <div id="content" class="transition-transform duration-500 ease-in-out">
            <!--konten detail artikel -->
            <div class="max-w-full p-6 bg-white shadow-md rounded-lg">
                <h1 class="text-4xl font-bold text-indigo-900 mt-2">
                    Tambah UMKM
                </h1>
                <div id="map" class="h-96 p-2 z-0 mt-10"></div>
                <p class="text-sm text-indigo-900">
                    *ketuk di peta untuk memasukkan langitude, latitude, dan
                    alamat secara otomatis
                </p>
                <div class="form-container mt-10">

                    <form action="{{ route('admin.store-umkm') }}" method="POST" enctype="multipart/form-data"
                        class="bg-gray-100 p-6 rounded-lg shadow-lg mb-4">
                        @csrf

                        <h4 class="text-2xl font-bold text-indigo-900 mb-4">
                            Marker
                        </h4>

                        <!--mengambil data kecamatan_id -->
                        <input type="hidden" id="kecamatan_id" name="kecamatan_id" value="{{ $kecamatan->id }}" />

                        <!--lat-->
                        <div class="mb-4 ml-4">
                            <label for="latitude" class="block text-gray-700 text-lg font-semibold mb-2">Latitude</label>
                            <!--readonly untuk tidak dapat mauskkan data manual-->
                            <input type="text" id="latitude" name="latitude"
                                placeholder="klik lokasi pada peta untuk melihat latitude dari titik lokasi" required
                                readonly
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                        </div>
                        <!--lang-->
                        <div class="mb-4 ml-4">
                            <label for="longitude" class="block text-gray-700 text-lg font-semibold mb-2">Longitude</label>
                            <input type="text" id="longitude" name="longitude"
                                placeholder="klik lokasi pada peta untuk melihat longitude dari titik lokasi" required
                                readonly
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                        </div>
                        <div class="bg-gray-100 p-6 rounded-lg shadow-lg mb-4">
                            <h4 class="text-2xl font-bold text-indigo-900 mb-4 mt-2">
                                UMKM
                            </h4>
                            <div class="mb-4 ml-4">
                                <label for="nama_umkm" class="block text-gray-700 text-lg font-semibold mb-2">Nama
                                    UMKM</label>
                                <input type="text" id="nama_umkm" name="nama_umkm" placeholder="Masukkan Nama UMKM"
                                    required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                            </div>

                            <!--Deskripsi Singkat UMKM-->
                            <div class="mb-4 ml-4">
                                <label for="deskripsi_umkm" class="block text-gray-700 text-lg font-semibold mb-2">Deskripsi
                                    UMKM</label>
                                <!-- Summernote Editor -->
                                <textarea name="deskripsi_umkm" id="deskripsi_umkm" class="summernote"
                                    class="bg-white border border-gray-300 rounded-lg p-4 ml-4"></textarea>

                            </div>
                        </div>

                        <!-- Form untuk Tambah Produk -->
                        <div class="bg-gray-100 rounded-lg shadow-lg p-6 mb-8" id="form-tambah-produk">
                            <h4 class="text-2xl font-bold text-indigo-900 mb-4 mt-2">
                                Tambah Produk
                            </h4>
                            <div id="produk-container">
                                <!-- Produk pertama -->
                                <div class="produk-item mb-6 ml-4">
                                    <h5 class="text-lg font-semibold mb-2">Produk 1</h5>
                                    <div class="grid grid-cols-2 sm:grid-cols-2 gap-6">
                                        <div class="mb-4">
                                            <label for="produk_umkm[0][nama_produk]"
                                                class="block text-sm font-medium text-gray-700">Nama Produk</label>
                                            <input type="text" name="produk_umkm[0][nama_produk]" id="nama-produk-0"
                                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                                placeholder="Nama produk..." required />
                                        </div>
                                        <div class="mb-4 ml-3">
                                            <label for="produk_umkm[0][harga_terendah]"
                                                class="block text-sm font-medium text-gray-700">Harga Terendah</label>
                                            <input type="number" name="produk_umkm[0][harga_terendah]"
                                                id="harga-terendah-0"
                                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                                placeholder="Harga terendah..." required />
                                        </div>
                                        <div class="mb-4">
                                            <label for="produk_umkm[0][harga_tertinggi]"
                                                class="block text-sm font-medium text-gray-700">Harga Tertinggi</label>
                                            <input type="number" name="produk_umkm[0][harga_tertinggi]"
                                                id="harga-tertinggi-0"
                                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                                placeholder="Harga tertinggi..." required />
                                        </div>
                                        <div class="mb-4 col-span-2 ml-3">
                                            <label for="produk_umkm[0][deskripsi_produk]"
                                                class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                            <textarea name="produk_umkm[0][deskripsi_produk]" id="deskripsi-produk-0"
                                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Deskripsi produk..." required></textarea>
                                        </div>
                                        <div class="mb-4 col-span-2">
                                            <label for="produk_umkm[0][foto_produk]"
                                                class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                                            <input type="file" name="produk_umkm[0][foto_produk]" id="gambar-produk-0"
                                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                                accept="image/*" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="tambah-produk" class="bg-green-600 text-white px-4 py-2 rounded-md">
                                Tambah Produk Lain
                            </button>
                        </div>


                        <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                            <h2 class="text-2xl font-semibold text-indigo-900 mb-6 mt-2">
                                Tambah Kontak UMKM
                            </h2>
                            <div class="mb-4">
                                <label for="nama_pemilik" class="block text-sm font-medium text-gray-700">Nama Pemilik
                                    UMKM</label>
                                <input type="text" id="nama_pemilik" name="nama_pemilik"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                    placeholder="Masukkan nama_pemilik kontak" required />
                            </div>
                            <div class="mb-4">
                                <label for="kontak" class="block text-sm font-medium text-gray-700">Telepon</label>
                                <input type="text" id="kontak" name="kontak"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                    placeholder="Masukkan nomor kontak" required />
                            </div>
                            <div class="mb-4">
                                <label for="whatsapp" class="block text-sm font-medium text-gray-700">Whatsapp</label>
                                <input type="text" id="whatsapp" name="whatsapp"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                    placeholder="Masukkan nomor Whatsapp" required />
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="email" name="email"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                    placeholder="Masukkan email" required />
                            </div>
                            <div class="mb-4">
                                <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram</label>
                                <input type="text" id="instagram" name="instagram"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                    placeholder="Masukkan akun Instagram" />
                            </div>
                            <div class="mb-4">
                                <label for="alamat_umkm" class="block text-sm font-medium text-gray-700">Alamat</label>
                                <input type="text" id="alamat_umkm" name="alamat_umkm"
                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                    placeholder="Masukkan alamat" required />
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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
            // Panggil fungsi untuk mendapatkan alamat
            getAddress(lat, lng);
        });
        // Fungsi untuk mendapatkan alamat berdasarkan lat & lng menggunakan Nominatim
        function getAddress(lat, lng) {
            var url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    var address = data.display_name || "Alamat tidak ditemukan";
                    document.getElementById("alamat_umkm").value = address;
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

    <script>
        let produkIndex = 1;
        document.getElementById("tambah-produk").addEventListener("click", function() {
            const produkContainer = document.getElementById("produk-container");

            const produkItem = document.createElement("div");
            produkItem.classList.add("produk-item", "mb-6", "ml-4");
            produkItem.innerHTML = `
        <h5 class="text-lg font-semibold mb-2">Produk ${produkIndex + 1}</h5>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div class="mb-4">
            <label for="produk_umkm[${produkIndex}][nama_produk]" class="block text-sm font-medium text-gray-700">Nama Produk</label>
            <input type="text" name="produk_umkm[${produkIndex}][nama_produk]" id="nama-produk-${produkIndex}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Nama produk..." required />
          </div>
          <div class="mb-4 ml-3">
            <label for="produk_umkm[${produkIndex}][harga_terendah]" class="block text-sm font-medium text-gray-700">Harga Terendah</label>
            <input type="number" name="produk_umkm[${produkIndex}][harga_terendah]" id="harga-terendah-${produkIndex}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Harga terendah..." required />
          </div>
          <div class="mb-4">
            <label for="produk_umkm[${produkIndex}][harga_tertinggi]" class="block text-sm font-medium text-gray-700">Harga Tertinggi</label>
            <input type="number" name="produk_umkm[${produkIndex}][harga_tertinggi]" id="harga-tertinggi-${produkIndex}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Harga tertinggi..." required />
          </div>
          <div class="mb-4 col-span-2 ml-3">
            <label for="produk_umkm[${produkIndex}][deskripsi_produk]" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="produk_umkm[${produkIndex}][deskripsi_produk]" id="deskripsi-produk-${produkIndex}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Deskripsi produk..." required></textarea>
          </div>
          <div class="mb-4 col-span-2">
            <label for="produk_umkm[${produkIndex}][foto_produk]" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
            <input type="file" name="produk_umkm[${produkIndex}][foto_produk]" id="gambar-produk-${produkIndex}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" accept="image/*" required />
          </div>
        </div>
      `;

            produkContainer.appendChild(produkItem);
            produkIndex++;
        });
    </script>

@endsection
