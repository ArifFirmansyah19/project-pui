<div class="mx-auto">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between w-full p-6 bg-cream rounded-lg">
        <!-- Teks -->
        <div class="w-full sm:w-1/2 bg-cream sm:p-6 rounded-lg animate-slide-in-bottom mb-6 sm:mb-0">
            <h2 class="text-indigo-900 text-2xl font-semibold mb-4 font-poppins ml-10">
                PUI GEMAR
            </h2>
            <p class="text-indigo-900 font-poppins ml-10">
                PUI-GEMAR UNJA merupakan salah satu PUI yang ada di Universitas
                Jambi. PUI GEMAR didirikan pada tanggal 13 Mei 2020 berdasarkan SK Rektor
                Universitas Jambi yang memiliki lingkup di bidang penelitian dan
                pembelajaran pada kawasan Geowisata Merangin Jambi. Geopark Merangin resmi didirikan pada tahun 2012,
                menyandang
                status Geopark Nasional pada tahun 2013, dan pada 24 Mei 2023 diterima
                menjadi UNESCO Global Geopark (UGGp) sekaligus menjadi Geopark Global
                UNESCO yang pertama di provinsi Jambi.
            </p>

            <!-- Tautan -->
            <a href="{{ route('sejarah') }}"
                class="bg-yellow-600 text-white hover:bg-gray-700 py-2 px-4 rounded-lg ml-10 mt-2 inline-block">Lihat
                Sejarah</a>
        </div>
        <!-- Gambar -->
        <div class="w-full sm:w-2/5 sm:ml-10 animate-slide-in-right sm:order-last mr-10">
            <img src="{{ asset('img/logo.png') }}" alt="Gambar" class="w-full rounded-lg" />
        </div>
    </div>
</div>

<div class="relative w-full py-8 px-4 bg-gray-100" id="carousel-container">
    <h2 class="text-4xl font-bold text-center text-indigo-800 py-4 mb-6">
        Kegiatan
    </h2>

    <!-- Carousel Container -->
    <div class="relative max-w-7xl mx-auto overflow-x-auto scroll-smooth scrollbar-hide" id="carousel-wrapper"
        style="scroll-padding-left: 2rem;">
        <!-- Wrapper for carousel items -->
        <div class="flex gap-x-4 whitespace-nowrap">
            <!-- Slide 1 -->
            @foreach ($kegiatans as $key => $item)
                <div
                    class="w-1/3 flex-shrink-0 h-64 md:h-80 relative group transform transition-all duration-300 hover:scale-95">
                    <a href="{{ route('detail-kegiatan', $item->id) }}"
                        class="block w-full h-full relative overflow-hidden rounded-lg">

                        @if (Str::endsWith($item->foto_kegiatan, ['jpg', 'jpeg', 'png', 'webp']))
                            <!-- Menampilkan Gambar -->
                            <img src="{{ asset('storage/' . $item->foto_kegiatan) }}" alt="{{ $item->nama_kegiatan }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                        @elseif (Str::endsWith($item->foto_kegiatan, ['mp4', 'avi', 'mov']))
                            <!-- Menampilkan Video -->
                            <video controls autoplay muted loop
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                <source src="{{ asset('storage/' . $item->foto_kegiatan) }}"
                                    type="video/{{ pathinfo($item->foto_kegiatan, PATHINFO_EXTENSION) }}">
                                Browser Anda tidak mendukung pemutar video.
                            </video>
                        @endif

                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex flex-col justify-center items-center text-center text-white transition-opacity duration-300">
                            <h3 class="text-lg font-bold">{{ $item->nama_kegiatan }}</h3>
                            <p class="text-sm mt-2">{!! $item->deskripsi_kegiatan !!}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!--konten ketiga-->
<div class="mx-auto py-8 bg-indigo-900 text-white shadow-md p-6 mt-32">
    <h2 class="text-3xl font-bold text-center font-poppins text-white mb-5 relative mt-2">
        ARTIKEL
        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2">
            <div class="w-32 h-1 bg-white"></div>
        </div>
    </h2>

    <!-- Artikel 1 -->
    @foreach ($articles as $article)
        <div class="mb-8 hover:shadow-lg transition duration-300">
            <div class="p-6">
                <h3 class="text-lg font-semibold font-poppins mb-0">
                    {{ $article->judul }}
                </h3>
                <p class="text-sm text-gray-200 mb-4">{{ $article->formatted_created_at }}</p>
                <p class="text-sm font-poppins">
                    {{ implode("\n", array_slice(explode("\n", wordwrap(strip_tags($article->abstract), 150, "\n")), 0, 4)) }}
                    ........
                </p>
                <a href="{{ $article->file_path }}"
                    class="block text-blue-500 font-semibold mt-2 hover:text-blue-300 transition duration-300">Baca
                    Selengkapnya</a>
                <div class="flex items-center mt-4 space-x-4">
                    <button
                        class="flex items-center text-gray-400 hover:text-blue-400 transition duration-300 commentBtn"
                        data-article-id="{{ $article->id }}">
                        <i class="far fa-comment mr-1"></i>
                        <span class="commentCount">{{ $article->totalComments }}</span>
                    </button>
                </div>
            </div>
            <hr class="border-white my-1" />
        </div>
    @endforeach

    <div class="text-center">
        <a href="{{ route('artikel') }}"
            class="text-blue-400 font-semibold mt-4 hover:text-blue-600 transition duration-300 border border-blue-200 rounded-md py-2 px-4 inline-block">Lihat
            Semua</a>
    </div>
</div>

<!-- Konten keempat: Persebaran Sumber Daya -->
<div class="mx-auto py-8">
    <h2 class="text-3xl font-bold text-center font-poppins text-indigo-900 mt-5 mb-8">
        Persebaran Sumber Daya
    </h2>
    <div class="bg-gray-100 p-10">
        <div id="map" class="h-80"></div>
    </div>
</div>

<!--konten kelima-->
<div class="overflow-x-auto whitespace-nowrap bg-indigo-900 py-4 px-8 shadow-md mb-16">
    <h2 class="text-3xl text-center font-bold text-white mb-5 relative mt-2">
        TEAM
        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2">
            <div class="w-20 h-1 bg-white"></div>
        </div>
    </h2>
    <div class="overflow-x-auto whitespace-nowrap bg-indigo-900 py-4 px-8 shadow-md">
        <div class="flex">
            @foreach ($dataTimPui as $tim)
                <a href="{{ route('tim-detail', $tim->id) }}"
                    class="team-member flex-none w-56 mr-4 bg-white rounded-lg shadow-md overflow-hidden transform transition-transform hover:scale-105">
                    <img src="{{ asset('storage/' . $tim->foto) }}" alt="Team Member {{ $tim->nama }}"
                        class=" w-full h-40 object-cover object-top" />
                    <div class="py-1 px-4 flex flex-col items-center h-auto">
                        <h3 class="text-lg text-center mb-2 break-words whitespace-normal">{{ $tim->nama }}</h3>
                        <p class="text-sm text-center text-gray-600 break-words whitespace-normal">
                            {{ $tim->bidang_keahlian }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal -->
<div id="commentModal"
    class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center z-50 transition-opacity duration-300">
    <div class="modal-content bg-white p-6 rounded-lg w-1/2 mx-auto shadow-lg">
        <div class="modal-header flex justify-between items-center mb-4">
            <h2 id="modalTitle" class="text-xl font-bold">Komentar</h2>
            <button id="closeModal" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
        </div>
        <div id="modalContent" class="modal-body">
            <form id="commentForm" method="POST" class="mt-2">
                @csrf
                <input type="hidden" name="article_id" id="article_id" />
                <textarea class="w-full p-2 mb-1 text-gray-800 border border-gray-300 rounded-md" rows="3" name="isi_komentar"
                    placeholder="Tulis komentar anda..."></textarea>
                <div class="mb-2">
                    <input name="nama" class="w-full p-2 border border-gray-400 rounded" placeholder="Nama" />
                </div>
                <button type="submit"
                    class="text-white hover:bg-blue-700 px-4 py-2 mt-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50"
                    style="background-color: #1D4ED8 !important;">
                    Submit
                </button>
            </form>
            <div id="commentContainer" class="comments mt-4 text-sm text-gray-700 overflow-y-auto"
                style="max-height: 300px;">
                <p id="loadingText" class="hidden">Memuat komentar...</p>
            </div>
        </div>
    </div>
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

    // Tambahkan marker dengan ikon hijau untuk setiap potensi
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
</script>


<script>
    // dokumentasi
    document.addEventListener("DOMContentLoaded", function() {
        const slides = document.querySelectorAll(".slide");
        const dots = document.querySelectorAll(".dot");
        let currentSlide = 0;

        function showSlide(n) {
            slides.forEach((slide) => slide.classList.add("hidden"));
            dots.forEach((dot) => dot.classList.remove("bg-indigo-600"));
            slides[n].classList.remove("hidden");
            dots[n].classList.add("bg-indigo-600");
            currentSlide = n;
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
            setActiveDot(currentSlide);
        }

        setInterval(nextSlide, 4000); // Ganti slide setiap 20 detik

        dots.forEach((dot, index) => {
            dot.addEventListener("click", () => {
                showSlide(index);
                setActiveDot(index);
            });
        });

        function setActiveDot(index) {
            dots.forEach((dot) => dot.classList.remove("bg-indigo-600"));
            dots[index].classList.add("bg-indigo-600");
        }

        showSlide(0); // Tampilkan slide pertama saat halaman dimuat
    });
</script>
