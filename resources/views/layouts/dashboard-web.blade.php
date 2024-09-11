<!--konten pertama-->
<div class="content">
    <div class="container mx-auto py-24">
        <div class="flex flex-col md:flex-row items-center">
            <!-- Penjelasan gambar -->
            <div class="w-full md:w-1/2 bg-cream p-6 rounded-lg animate-slide-in-bottom">
                <h2 class="text-indigo-900 text-2xl font-semibold mb-4 font-poppins ml-10 text-center md:text-left">
                    PUI GEMAR
                </h2>
                <p class="text-indigo-900 font-poppins ml-10 text-center md:text-left">
                    PUI-GEMAR UNJA merupakan salah satu PUI yang ada di Universitas
                    Jambi. PUI GEMAR didirikan pada tanggal 13 Mei 2020 berdasarkan SK Rektor
                    Universitas Jambi yang memiliki lingkup di bidang penelitian dan
                    pembelajaran pada kawasan Geowisata Merangin Jambi.
                    Geopark Merangin resmi didirikan pada tahun 2012, menyandang
                    status Geopark Nasional pada tahun 2013, dan pada 24 Mei 2023 diterima
                    menjadi UNESCO Global Geopark (UGGp) sekaligus menjadi Geopark Global
                    UNESCO yang pertama di provinsi Jambi. Geopark Merangin memiliki potensi alam berupa keragaman
                    geologi
                    yang tersebar di sepanjang Sungai Merangin. Fosil flora dan fauna di
                    kawasan ini diperkirakan berumur sekitar 250-290 juta tahun lalu yang
                    terdapat pada batuan gunung api bersisipan sedimen laut berupa batu
                    gamping dan serpih gamping. Kawasan Geopark Merangin tersebar di sepanjang aliran Sungai Batang
                    Merangin dan Sungai
                    Mengkarang. Secara geologi, Sungai Mengkarang tersusun dari batuan dari
                    Formasi Mengkarang (Pm), ranit Tantan (TJRgr), dan Formasi Kasai (QTK). Geopark memiliki peranan
                    penting untuk membuka peluang
                    penelitian, pendidikan serta pengembangan ekonomi masyarakat setempat.
                    Geopark dapat dikembangkan menjadi objek daya tarik wisata (geotourism),
                    kegiatan perdagangan barang kerajinan (geoproducts) dan makanan khas
                    daerah atau UMKM.
                </p>
            </div>
            <!-- Gambar -->
            <div class="w-full md:w-2/5 mb-6 md:mb-0 animate-slide-in-right">
                <img src="{{ asset('img/logo.png') }}" alt="Gambar" class="w-full rounded-lg" />
            </div>
        </div>
    </div>

    <!-- Konten TIM -->
    <div class="overflow-x-auto whitespace-nowrap bg-indigo-900 py-4 px-8 shadow-md">
        <h2 class="text-3xl text-center font-Roboto font-bold text-white mb-5 relative mt-2">
            TEAM
            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2">
                <div class="w-20 h-1 bg-white"></div>
            </div>
        </h2>

        <div class="overflow-x-auto whitespace-nowrap bg-indigo-900 py-4 px-8 shadow-md">
            <div class="flex">
                <a href="{{ route('tim') }}">
                    <!-- Anggota TIM -->
                    @foreach ($dataTimPui as $tim)
                        <a href="{{ route('tim-detail', $tim->id) }}"
                            class="team-member flex-none w-50 mr-4 bg-white rounded-lg shadow-md overflow-hidden transform transition-transform hover:scale-105">
                            <img src="{{ asset('storage/' . $tim->foto) }}" alt="foto {{ $tim->nama }}"
                                class="w-64 h-64 object-cover object-center" />
                            <div class="p-4">
                                <h3 class="text-lg text-center mb-2">{{ $tim->nama }}</h3>
                                <p class="text-sm text-center">{{ $tim->jabatan->nama_jabatan }}</p>
                            </div>
                        </a>
                    @endforeach
            </div>
            {{-- <div
                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                <div
                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <h3 class="text-lg font-semibold text-indigo-600">
                        Lihat Semua
                    </h3>
                </div>
            </div> --}}
        </div>
    </div>

    <!--konten Artikel-->
    <div class="container mx-auto py-8 bg-indigo-900 text-white shadow-md p-6 mt-32">
        <h2 class="text-3xl font-bold text-center font-poppins text-white mb-5 relative mt-2">
            ARTIKEL
            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2">
                <div class="w-32 h-1 bg-white"></div>
            </div>
        </h2>
        <!-- Daftar Artikel -->
        @foreach ($articles as $article)
            <div class="mb-8 hover:shadow-lg transition duration-300">
                <div class="p-6">
                    <h3 class="text-lg font-semibold font-poppins mb-0">
                        {{ $article->judul }}
                    </h3>
                    <p class="text-sm text-gray-200 mb-4">{{ $article->formatted_created_at }}</p>
                    <p class="text-sm text-gray-200 mb-4">Ditulis oleh: {{ $article->penulis }}</p>
                    <p class="text-sm font-poppins">
                        {{ implode("\n", array_slice(explode("\n", wordwrap(strip_tags($article->deskripsi), 150, "\n")), 0, 4)) }}
                        ........
                    </p>
                    <a href="{{ route('artikel-detail', $article->id) }}"
                        class="detail-artikel block text-blue-400 font-semibold py-2 hover:text-blue-300 transition duration-300">Baca
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
            </div>
            <hr class="border-white my-1" />
        @endforeach

        <!-- Link Lihat Semua -->
        <div class="text-center">
            <a href="{{ route('artikel') }}"
                class="all-artikel block text-blue-400 font-semibold mt-4 hover:text-blue-600 transition duration-300 border border-blue-200 rounded-md py-2 px-4 inline-block">Lihat
                Semua</a>
        </div>
    </div>

    <!--konten keempat-->
    <div class="container mx-auto py-8">
        <h2 class="text-3xl font-bold text-center font-poppins text-indigo-900 mt-5 mb-8">
            Kegiatan
        </h2>
        <div class="container mx-auto py-8 w-full relative mb-10">
            <div class="carousel-container flex items-center justify-center">
                @foreach ($kegiatans as $kegiatan)
                    <!-- Slide 1 -->
                    <div class="slide h-96 w-3/4 pb-10">
                        <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}"
                            alt="{{ $kegiatan->nama_kegiatan }}" class="w-full h-full object-cover" />
                        <div class="bg-gray-100 text-center mb-2 pb-3">
                            <h3 class="text-lg font-semibold mb-1 mt-2">{{ $kegiatan->nama_kegiatan }}</h3>
                            <p class="text-gray-600 leading-relaxed mt-2">
                                {{ implode("\n", array_slice(explode("\n", wordwrap(strip_tags($kegiatan->deskripsi_kegiatan), 150, "\n")), 0, 3)) }}
                                ...........
                            </p>
                            <a href="{{ route('detail-kegiatan', $kegiatan->id) }}"
                                class="detail-kegiatan block text-blue-500 font-semibold mt-2 hover:text-blue-300 transition duration-300">Baca
                                Selengkapnya</a>
                        </div>
                    </div>
                @endforeach

                <div class="dots absolute bottom-0 left-1/2 transform -translate-x-1/2 flex space-x-2 mt-4 my-16">
                    <span class="dot bg-gray-300 w-2 h-2 rounded-full cursor-pointer selected"></span>
                    <span class="dot bg-gray-300 w-2 h-2 rounded-full cursor-pointer"></span>
                    <span class="dot bg-gray-300 w-2 h-2 rounded-full cursor-pointer"></span>
                    <span class="dot bg-gray-300 w-2 h-2 rounded-full cursor-pointer"></span>
                    <!-- dot sesuai jumlah slide -->
                </div>
            </div>
        </div>
        <div class="text-center mt-32">
            <a href="{{ route('kegiatan') }}"
                class="all-kegiatan block text-blue-400 font-semibold mt-4 hover:text-blue-600 transition duration-300 border border-blue-200 rounded-md py-2 px-4 inline-block">Lihat
                Semua</a>
        </div>
    </div>


    <!-- Konten kelima: Persebaran Sumber Daya -->
    <div class="container mx-auto py-8">
        <h2 class="text-3xl font-bold text-center font-poppins text-indigo-900 mt-5 mb-8">
            Persebaran Sumber Daya
        </h2>
        <div class="bg-gray-100 p-10">
            <div id="map"></div>

            <!-- Modal -->
            <div id="commentModal"
                class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center z-50">
                <div class="bg-white p-6 rounded-lg w-full max-w-md">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Tulis Komentar</h2>
                        <button id="closeModal" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                    </div>
                    <div id="modalContent">
                        <!-- Komentar akan ditambahkan di sini -->
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

                //control zoom
                L.control.zoom({
                    position: 'topright'
                }).addTo(map);

                // Load GeoJSON data
                fetch('/geojson/geopark_merangin.json')
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
                    iconUrl: '../icon-marker/markergreen.png',
                    iconSize: [22, 34],
                    iconAnchor: [16, 32],
                    popupAnchor: [0, -32],
                    className: 'marker-green',
                });
                // Data lokasi desa dari controller
                var desas = @json($desas);

                // Tambahkan marker dengan ikon hijau untuk setiap desa
                desas.forEach(function(desa) {
                    var popupContent =
                        '<div class="detail-potensi-desa"> <a href="persebaran/detail-desa/' + desa.id + '">' +
                        '<strong> <center>Data Potensi </center>' + desa
                        .nama_desa + '</strong> </a> </div>';

                    var marker = L.marker([desa.latitude, desa.longitude], {
                            icon: desaIcon,
                            className: 'marker-green',
                        })
                        .addTo(map)
                        .bindPopup(popupContent);
                });

                // Buat ikon khusus UMKM
                var customIcon = L.icon({
                    iconUrl: '../icon-marker/markerblue.png', // Ganti dengan path ikon Anda
                    iconSize: [22, 34], // Ukuran ikon
                    iconAnchor: [16, 32], // Titik anchor (bagian bawah tengah ikon)
                    popupAnchor: [0, -32], // Titik anchor popup
                    className: 'marker-blue',

                });

                //Data UMKM dari controller
                var umkms = @json($umkms);

                // Tambahkan marker untuk setiap lokasi UMKM
                umkms.forEach(function(umkm) {
                    var popupContent =
                        '<div class="detail-persebaran-umkm"> <a href="persebaran/detail-umkm/' + umkm.id + '">' + umkm
                        .nama_umkm + '</a> <br>' + umkm
                        .alamat_umkm + '<br><br>' + umkm.deskripsi_umkm + '</div>'

                    var marker = L.marker([umkm.latitude, umkm.longitude], {
                            icon: customIcon,
                            className: 'marker-blue',
                        })
                        .addTo(map)
                        .bindPopup(popupContent);
                });

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
        </div>
    </div>
</div>
</div>
