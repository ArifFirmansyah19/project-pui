  @extends('layouts.app-admin')
  @section('title', 'halaman Edit Potensi Alam admin')
  @section('content-admin')


      <main class="flex-1 overflow-y-auto">
          <div id="content" class="transition-transform duration-500 ease-in-out">
              <!--konten detail artikel -->
              <div class="max-w-full p-6 bg-white shadow-md rounded-lg">
                  <h1 class="text-4xl font-bold text-indigo-900 mt-2">
                      Edit Potensi Alam
                  </h1>
                  <div class="px-4 py-1 bg-gray-100">
                      <div id="map" class="h-96 p-2 z-0 mt-10"></div>
                      <p class="text-sm text-indigo-900">
                          *ketuk di peta untuk memasukkan langitude, latitude, dan
                          alamat secara otomatis
                      </p>
                  </div>
                  <div class="form-container mt-10">
                      <form id="updateForm"
                          action="{{ route('admin.update-potensi', ['kecamatan_id' => $kecamatan->id, 'potensi_id' => $potensi->id]) }}"
                          method="POST" enctype="multipart/form-data" class="bg-gray-100 p-6 rounded-lg shadow-lg mb-4">
                          @csrf
                          <h4 class="text-2xl font-bold text-indigo-900 mb-4">
                              Marker
                          </h4>

                          <!--mengambil data kecamatan_id -->
                          <input type="hidden" id="kecamatan_id" name="kecamatan_id" value="{{ $kecamatan->id }}" />

                          <!--lat -->
                          <div class="mb-4 ml-4">
                              <label for="latitude" class="block text-gray-700 text-lg font-semibold mb-2">Latitude</label>
                              <!--readonly untuk tidak dapat mauskkan data manual-->
                              <input type="text" id="latitude" name="latitude"
                                  placeholder="klik lokasi pada peta untuk melihat latitude dari titik lokasi" required
                                  readonly value="{{ old('latitude', $potensi->latitude) }}"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                          </div>
                          <!--lang-->
                          <div class="mb-4 ml-4">
                              <label for="longitude"
                                  class="block text-gray-700 text-lg font-semibold mb-2">Longitude</label>
                              <input type="text" id="longitude" name="longitude"
                                  placeholder="klik lokasi pada peta untuk melihat longitude dari titik lokasi" required
                                  readonly value="{{ old('latitude', $potensi->longitude) }}"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                          </div>



                          <div class="bg-gray-100 p-6 rounded-lg shadow-lg mb-4">
                              <h4 class="text-2xl font-bold text-indigo-900 mb-4 mt-2">
                                  POTENSI
                              </h4>
                              <div class="mb-4 ml-4">
                                  <label for="nama_potensi" class="block text-gray-700 text-lg font-semibold mb-2">Nama
                                      Potensi</label>
                                  <input type="text" id="nama_potensi" name="nama_potensi"
                                      placeholder="Masukkan Nama Potensi" required
                                      value="{{ old('nama_potensi', $potensi->nama_potensi) }}"
                                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                              </div>

                              <!--Deskripsi Singkat Potensi-->
                              <div class="mb-4 ml-4">
                                  <label for="deskripsi_potensi"
                                      class="block text-gray-700 text-lg font-semibold mb-2">Deskripsi
                                      Potensi</label>
                                  <textarea name="deskripsi_potensi" id="deskripsi_potensi" class="summernote"
                                      class="bg-white border border-gray-300 rounded-lg p-4 ml-4">{!! $potensi->deskripsi_potensi !!}</textarea>
                              </div>
                          </div>

                          <!-- Form untuk Tambah Foto -->
                          <div class="bg-gray-100 rounded-lg shadow-lg p-6 mb-8" id="form-tambah-foto">
                              <h4 class="text-2xl font-bold text-indigo-900 mb-4 mt-2">
                                  Tambah Galeri
                              </h4>
                              <div id="foto-container">
                                  <!-- Foto pertama -->
                                  <div class="foto-item mb-6 ml-4" id="form-foto-container">
                                      @if ($potensi->fotoPotensi->isEmpty())
                                          <h5 class="text-lg font-semibold mb-2">Potensi Kosong</h5>
                                      @else
                                          @foreach ($potensi->fotoPotensi as $index => $item)
                                              <h5 class="text-lg font-semibold mb-2">Gambar Potensi {{ $index + 1 }}</h5>
                                              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                                  <div class="mb-4 col-span-2">
                                                      <label for="gambar-potensi-{{ $index }}"
                                                          class="block text-sm font-medium text-gray-700">Gambar Potensi
                                                          Alam</label>

                                                      @if ($item->foto_potensi)
                                                          <input type="hidden"
                                                              name="foto_potensis[{{ $index }}][old_foto_potensi]"
                                                              value="{{ $oldFotos[$item->id] ?? '' }}">
                                                          <img src="{{ asset('storage/' . $item->foto_potensi) }}"
                                                              alt="Foto Potensi {{ $index }}" class="mt-2"
                                                              style="width: 100px; height: 100px;">
                                                      @endif

                                                      <input type="file"
                                                          name="foto_potensis[{{ $index }}][foto_potensi]"
                                                          accept="image/*"
                                                          class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                                                  </div>
                                                  <div class="mb-4 col-span-2 ml-3">
                                                      <label for="deskripsi-foto-{{ $index }}"
                                                          class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                                      <textarea name="foto_potensis[{{ $index }}][deskripsi_foto]" id="deskripsi-foto-{{ $index }}"
                                                          class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Deskripsi potensi..." required>{!! $item->deskripsi_foto !!}</textarea>
                                                  </div>
                                              </div>
                                          @endforeach
                                      @endif
                                  </div>
                              </div>
                              <button type="button" id="tambah-foto" class="bg-green-600 text-white px-4 py-2 rounded-md">
                                  Tambah Foto Lain
                              </button>
                          </div>

                          <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                              <h2 class="text-2xl font-semibold text-indigo-900 mb-6 mt-2">
                                  Lokasi
                              </h2>

                              <div class="mb-4 ml-4">
                                  <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                                  <input type="text" id="alamat" name="alamat"
                                      class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                                      value="{{ old('alamat', $potensi->alamat) }}" placeholder="Masukkan alamat"
                                      required />
                              </div>
                          </div>

                          <div class="flex justify-end mt-6">
                              <button type="submit" id="updateButton"
                                  class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                  Simpan
                              </button>
                          </div>
                      </form>
                  </div>
              </div>
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

              // Tentukan lokasi awal marker dari data latitude dan longitude yang tersimpan
              var initialLat = {{ $potensi->latitude }};
              var initialLng = {{ $potensi->longitude }};

              // Tambahkan marker awal berdasarkan koordinat yang tersimpan dan set view peta ke lokasi marker
              let marker = L.marker([initialLat, initialLng], {
                  draggable: true,
                  // icon: customIcon
              }).addTo(map);

              map.setView([initialLat, initialLng], 14); // Fokuskan peta pada lokasi marker awal

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
                  getAddress(lat, lng);
              });

              function getAddress(lat, lng) {
                  var url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`;

                  fetch(url)
                      .then(response => response.json())
                      .then(data => {
                          var address = data.display_name || "Alamat tidak ditemukan";
                          document.getElementById("alamat").value = address;
                      })
                      .catch(error => console.error('Error:', error));
              }
          });
      </script>
      <script>
          document.getElementById('updateButton').addEventListener('click', function(event) {
              event.preventDefault(); // Mencegah pengiriman form secara otomatis
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
          let fotoPotensiIndex = {{ $potensi->fotoPotensi->count() }}; // Indeks untuk foto

          document.getElementById('form-tambah-foto').addEventListener('click', function(e) {
              if (e.target.id === 'tambah-foto') {
                  const container = document.getElementById('foto-container');
                  const newFoto = `
            <div class="foto-item mb-6 ml-4">
                <h5 class="text-lg font-semibold mb-2">Gambar Potensi ${fotoPotensiIndex + 1}</h5>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="mb-4 col-span-2">
                        <label for="gambar-potensi-${fotoPotensiIndex}" class="block text-sm font-medium text-gray-700">Gambar Potensi</label>
                        <input type="file" name="foto_potensis[${fotoPotensiIndex}][foto_potensi]" accept="image/*"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required />
                    </div>
                    <div class="mb-4 col-span-2 ml-3">
                        <label for="deskripsi-foto-${fotoPotensiIndex}" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="foto_potensis[${fotoPotensiIndex}][deskripsi_foto]" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Deskripsi potensi..." required></textarea>
                    </div>
                    
                </div>
            </div>
        `;
                  container.insertAdjacentHTML('beforeend', newFoto);
                  fotoPotensiIndex++; // Increment index for the next photo
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
