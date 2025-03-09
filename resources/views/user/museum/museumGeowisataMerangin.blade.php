@extends('layouts.app-user')
@section('title', 'Museum Digital PUI GEMAR')

@section('content')
    <br><br>
    <div class="mx-auto pb-12 pl-12 pr-12">
        <h1 class="text-5xl font-bold text-indigo-900 inline-block border-b-4 border-gray-300">
            Museum Digital
        </h1>

        <div class="bg-gray-200 mt-12">
            <div class="max-w-6xl mx-auto p-2">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $museumGeopark->foto) }}" alt="Geopark Merangin"
                        class="w-full h-64 object-cover" />
                    <div class="p-6">
                        <h2 class="text-2xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900">
                            {{ $museumGeopark->judul }}
                        </h2>
                        <p class="mt-4 text-gray-600">
                            @php
                                // Pecah deskripsi menjadi array kalimat berdasarkan titik (.)
                                $sentences = explode('.', strip_tags($museumGeopark->thumbnail));
                                // Ambil 5 kalimat pertama
                                $limitedSentences = array_slice($sentences, 0, 5);
                                // Gabungkan kembali kalimat-kalimat dengan menambahkan titik di akhir
                                echo implode('. ', $limitedSentences) . (count($sentences) > 5 ? '...' : '');
                            @endphp
                        </p>
                        <a href="{{ route('detail-geopark') }}"
                            class="inline-block mt-6 px-4 py-2 bg-yellow-600 text-white font-semibold rounded hover:bg-gray-700">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>



        @foreach ($dataKeragamans as $jenisKeragaman => $items)
            <div class="mb-6 mt-20">
                <h1 class="text-4xl font-bold text-center text-indigo-900 border-b-2 mb-8">
                    {{ ucfirst($jenisKeragaman) }}
                </h1>

                @if (strpos(strtolower($jenisKeragaman), 'stratigraphy') !== false)
                    <div class="flex justify-center mb-8">
                        <div class="relative w-full h-[30rem] bg-gray-200 rounded-lg overflow-hidden">
                            <img id="selectedImage"
                                src="{{ asset('storage/' . $firstDataKeragamans[$jenisKeragaman]->foto_keragaman) }}"
                                alt="Selected Image" class="w-full object-cover" style="height: 450px;" />
                            <div class="absolute bottom-0 left-0 text-white p-4 bg-transparent bg-opacity-50">
                                <h2 id="selectedImageTitle" class="text-lg font-bold font-caladea">
                                    {{ $firstDataKeragamans[$jenisKeragaman]->nama }}
                                </h2>
                                <p id="selectedImageDescription" class="text-sm">
                                    {{ $firstDataKeragamans[$jenisKeragaman]->deskripsi }}
                                </p>
                                <p id="selectedImageAlamat" class="text-sm">
                                    {{ $firstDataKeragamans[$jenisKeragaman]->lokasi }}
                                </p>
                                <p id="selectedImageUmur" class="text-sm">
                                    {{ $firstDataKeragamans[$jenisKeragaman]->umur }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex overflow-x-auto space-x-4 whitespace-nowrap">
                        @foreach ($items as $data)
                            <div class="text-center flex-none w-24">
                                <img src="{{ asset('storage/' . $data->foto_keragaman) }}" alt="{{ $data->nama }}"
                                    class="w-20 h-20 object-cover cursor-pointer mb-2 rounded-lg"
                                    onclick="selectImage('{{ asset('storage/' . $data->foto_keragaman) }}', '{{ $data->nama }}', '{{ $data->deskripsi }}', '{{ $data->lokasi }}', '{{ $data->umur }}')" />
                                <p class="text-sm text-gray-800 truncate">{{ $data->nama }}</p>
                            </div>
                        @endforeach
                    </div>
                @elseif (strpos(strtolower($jenisKeragaman), 'fosil') !== false)
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($items as $data)
                            <figure>
                                <img src="{{ asset('storage/' . $data->foto_keragaman) }}" alt="{{ $data->nama }}"
                                    class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
                                    onclick="openModal3(this.src)" />
                                <p class="font-bold">{{ $data->nama }}</p>
                                <p class="text-sm">Deskripsi : {{ $data->deskripsi }} </p>
                                <p class="text-sm">Lokasi : {{ $data->lokasi }}</p>
                                <p class="text-sm">Usia: {{ $data->umur }}</p>
                            </figure>
                        @endforeach
                    </div>
                @elseif (strpos(strtolower($jenisKeragaman), 'geologi') !== false)
                    <div class="relative">
                        <div id="carouselWrapper" class="flex transition-transform duration-500 ease-in-out">
                            @foreach ($items as $data)
                                <div class="relative w-full flex-shrink-0">
                                    <!-- Gambar yang ukuran 50% lebar layar -->
                                    <img src="{{ asset('storage/' . $data->foto_keragaman) }}" alt="{{ $data->nama }}"
                                        class="w-1/2 h-96 object-cover rounded-lg mx-auto"
                                        onclick="openModal(this.src, '{{ $data->nama }}', '{{ $data->deskripsi }}', '{{ $data->lokasi }}', '{{ $data->umur }}')" />

                                    <!-- Teks dengan latar belakang transparan, hanya di bagian bawah gambar -->
                                    <div
                                        class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 bg-gray-900 bg-opacity-60 text-white text-center p-2 rounded-t-lg">
                                        <p class="text-xl font-bold">{{ $data->nama }}</p>
                                        <p>{{ $data->deskripsi }}</p>
                                        <p>{{ $data->lokasi }}</p>
                                        <p>{{ $data->umur }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Tombol navigasi -->
                        <button id="prevBtn"
                            class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-gray-800 bg-opacity-70 text-white px-4 py-2 rounded-full hover:bg-opacity-90 z-10">
                            ‹
                        </button>
                        <button id="nextBtn"
                            class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-gray-800 bg-opacity-70 text-white px-4 py-2 rounded-full hover:bg-opacity-90 z-10">
                            ›
                        </button>
                    </div>
                @elseif (strpos(strtolower($jenisKeragaman), 'fauna') !== false)
                    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
                        @foreach ($items as $data)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $data->foto_keragaman) }}" alt="{{ $data->nama }}"
                                    class="w-full h-60 object-cover rounded-lg cursor-pointer transition-transform transform group-hover:scale-105"
                                    onclick="openModal(this.src, '{{ $data->nama }}', '{{ $data->deskripsi }}', '{{ $data->lokasi }}', '{{ $data->umur }}')" />
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="text-white text-center">
                                        <h3 class="text-lg font-semibold mb-2">{{ $data->nama }}</h3>
                                        <p class="mb-1">Description: {{ $data->deskripsi }}</p>
                                        <p>Age: {{ $data->umur }}</p>
                                        <p class="mb-1">Location: {{ $data->lokasi }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @elseif (strpos(strtolower($jenisKeragaman), 'flora') !== false)
                    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
                        @foreach ($items as $data)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $data->foto_keragaman) }}" alt="{{ $data->nama }}"
                                    class="w-full h-60 object-cover rounded-lg cursor-pointer transition-transform transform group-hover:scale-105"
                                    onclick="openModal(this.src, '{{ $data->nama }}', '{{ $data->deskripsi }}', '{{ $data->lokasi }}', '{{ $data->umur }}')" />
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="text-white text-center">
                                        <h3 class="text-lg font-semibold mb-2">{{ $data->nama }}</h3>
                                        <p class="mb-1">Description: {{ $data->deskripsi }}</p>
                                        <p>Age: {{ $data->umur }}</p>
                                        <p class="mb-1">Location: {{ $data->lokasi }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @elseif (strpos(strtolower($jenisKeragaman), 'kultur') !== false)
                    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
                        @foreach ($items as $data)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $data->foto_keragaman) }}" alt="{{ $data->nama }}"
                                    class="w-full h-60 object-cover rounded-lg cursor-pointer transition-transform transform group-hover:scale-105"
                                    onclick="openModal(this.src, '{{ $data->nama }}', '{{ $data->deskripsi }}', '{{ $data->lokasi }}', '{{ $data->umur }}')" />
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="text-white text-center">
                                        <h3 class="text-lg font-semibold mb-2">{{ $data->nama }}</h3>
                                        <p class="mb-1">Description: {{ $data->deskripsi }}</p>
                                        <p>Age: {{ $data->umur }}</p>
                                        <p class="mb-1">Location: {{ $data->lokasi }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach

        <div class="mb-8 px-6">
            <h2 class="text-2xl font-bold text-indigo-900 mt-12 inline-block border-b-2 border-indigo-900">
                Kontak Museum
            </h2>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-indigo-900 mb-4 border-b-2">
                    Kontak Pihak Museum
                </h3>
                <p class="text-gray-700 mb-3">
                    Untuk informasi lebih lanjut, Anda dapat menghubungi:
                </p>

                <div class="flex items-center mb-1">
                    <i class="fas fa-user-circle text-indigo-700 text-xl mr-4"></i>
                    <p class="text-gray-800 text-lg">Nama Kontak: {{ $kontakMuseum->nama_kontak }}</p>
                </div>

                <div class="flex items-center mb-1">
                    <i class="fas fa-phone-alt text-indigo-700 text-xl mr-4"></i>
                    <p class="text-gray-800 text-lg cursor-pointer">
                        Telepon: {{ $kontakMuseum->telepon }}
                    </p>
                </div>

                <div class="flex items-center mb-1">
                    <i class="fas fa-envelope text-indigo-700 text-xl mr-4"></i>
                    <p class="text-gray-800 text-lg">
                        Email:
                        <a href="mailto:{{ $kontakMuseum->email }}"
                            class="text-indigo-600 hover:underline word-break">{{ $kontakMuseum->email }}</a>
                    </p>
                </div>

                <div class="flex items-center mb-1">
                    <i class="fab fa-whatsapp text-indigo-700 text-xl mr-4"></i>
                    <p class="text-gray-800 text-lg">
                        Whatsapp:
                        <a href="https://wa.me/{{ $kontakMuseum->whatsapp }}?text=Halo%2C%20Admin%20Museum%20Geopark%20Merangin"
                            class="text-indigo-600 hover:underline">{{ $kontakMuseum->whatsapp }}</a>
                    </p>
                </div>


                <div class="flex items-center mb-1">
                    <i class="fab fa-instagram text-indigo-700 text-xl mr-4"></i>
                    <p class="text-gray-800 text-lg">
                        Instagram:
                        <a href="{{ $kontakMuseum->instagram }}"
                            class="text-indigo-600 hover:underline">{{ $username }}</a>
                    </p>
                </div>

                <div class="flex items-center mb-2">
                    <i class="fas fa-map-marker-alt text-indigo-700 text-xl mr-4"></i>
                    <p class="text-gray-800 text-lg">Alamat: {{ $kontakMuseum->alamat }}</p>
                </div>
            </div>
        </div>

        <!-- Modal
                                                                                                            -->
        <div id="imageModal3" class="fixed inset-0 z-50 items-center justify-center hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-lg w-full relative">
                <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closeModal()"> &times;
                </button>
                <img id="modalImage3" class="w-full h-64 object-cover rounded-lg" src="" alt="" />
                <h2 id="modalTitle" class="mt-4 text-xl font-semibold"></h2>
                <p id="modalDescription" class="text-gray-700 mt-2"></p>
                <p id="modalLocation" class="text-gray-500 mt-2"></p>
                <p id="modalAge" class="text-gray-500 mt-1"></p>
            </div>
            <div class="fixed inset-0 bg-black opacity-50" onclick="closeModal()">
            </div>
        </div>


        <!--  link JavaScript Font Awesome -->
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

        <!--  link JavaScript tambahan -->
        <script src="javascript.js"></script>

        <script>
            function openModal3(imageSrc) {
                const modal = document.getElementById('imageModal3');
                const modalImage = document.getElementById('modalImage3');
                modalImage.src = imageSrc;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function closeModal3() {
                const modal = document.getElementById('imageModal3');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            function selectImage(imageUrl, name, description, location, age) {
                document.getElementById("selectedImage").src = imageUrl;
                document.getElementById("selectedImage").alt = name;
                document.getElementById("selectedImageTitle").innerText = name;
                document.getElementById("selectedImageDescription").innerText = description;
                document.getElementById("selectedImageAlamat").innerText = location;
                document.getElementById("selectedImageUmur").innerText = age;
            }

            function openModal(imageUrl, title, description, location, age) {
                document.getElementById("modalImage3").src = imageUrl;
                document.getElementById("modalTitle").innerText = title;
                document.getElementById("modalDescription").innerText = description;
                document.getElementById("modalLocation").innerText = location;
                document.getElementById("modalAge").innerText = age;
                document.getElementById("imageModal3").classList.remove("hidden");
                document.getElementById("imageModal3").classList.add("flex");
            }

            function closeModal() {
                document.getElementById("imageModal3").classList.add("hidden");
                document.getElementById("imageModal3").classList.remove("flex");
            }

            function toggleFlexVisibility() {
                const element = document.getElementById("myElement");
                if (element.classList.contains("hidden")) {
                    element.classList.remove("hidden");
                    element.classList.add("flex");
                } else {
                    element.classList.remove("flex");
                    element.classList.add("hidden");
                }
            }

            const carouselWrapper = document.getElementById('carouselWrapper');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const carouselItems = Array.from(carouselWrapper.children);
            let currentIndex = 0;

            function updateCarousel() {
                const itemWidth = carouselItems[0].offsetWidth;
                const newTranslateX = -currentIndex * itemWidth;
                carouselWrapper.style.transform = `translateX(${newTranslateX}px)`;
            }

            prevBtn.addEventListener('click', () => {
                currentIndex = (currentIndex > 0) ? currentIndex - 1 : carouselItems.length - 1;
                updateCarousel();
            });

            nextBtn.addEventListener('click', () => {
                currentIndex = (currentIndex < carouselItems.length - 1) ? currentIndex + 1 : 0;
                updateCarousel();
            });

            function updateNavigationPosition() {
                const screenWidth = window.innerWidth;
                if (screenWidth <= 640) {
                    prevBtn.style.top = '10px';
                    nextBtn.style.top = '10px';
                } else {
                    prevBtn.style.top = '50%';
                    nextBtn.style.top = '50%';
                }
            }

            window.addEventListener('resize', () => {
                updateCarousel();
                updateNavigationPosition();
            });

            updateNavigationPosition();
        </script>

    @endsection
