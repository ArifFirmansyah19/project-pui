@extends('layouts.app-user')
@section('title', 'Detail Kegiatan PUI GEMAR')

@section('content')

    <div class="mx-auto p-12">
        <!-- Nama UMKM dan Penjelasan Singkat -->
        <h1 class="text-5xl font-bold text-indigo-900 inline-block border-b-4 border-gray-300">
            Museum Digital
        </h1>


        <div class="bg-gray-200 mt-12">
            <div class="max-w-6xl mx-auto p-2">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="../img/geoprk/exgeopark1.jpg" alt="Geopark Merangin" class="w-full h-64 object-cover" />
                    <div class="p-6">
                        <h2 class="text-2xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900">
                            Sejarah Geopark Merangin
                        </h2>
                        <p class="mt-4 text-gray-600">
                            Geopark Merangin merupakan salah satu situs warisan dunia yang
                            menyimpan sejarah geologi yang luar biasa. Terletak di Provinsi
                            Jambi, geopark ini memiliki formasi batuan purba dan fosil-fosil
                            yang unik, memberikan pandangan tentang sejarah bumi jutaan
                            tahun yang lalu.
                        </p>
                        <a href="sejarahgeprkmrgn.html"
                            class="inline-block mt-6 px-4 py-2 bg-amber-600 text-white font-semibold rounded hover:bg-gray-700">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="mb-6 mt-20">
            <h1 class="text-4xl font-bold text-center text-indigo-900 border-b-2 mb-8">
                Stratigraphy
            </h1>
            <div class="flex justify-center mb-8">
                <div class="relative w-full h-[30rem] bg-gray-200 rounded-lg overflow-hidden">
                    <img id="selectedImage" src="../img/stphy/s1.jpg" alt="Selected Image"
                        class="w-full h-full object-cover" />
                    <div class="absolute bottom-0 left-0 text-white p-4 bg-transparant">
                        <h2 id="selectedImageTitle" class="text-lg font-bold font-caladea">
                            Nama stratigraphy 1
                        </h2>
                        <p id="selectedImageDescription" class="text-sm">
                            deskripsi mengenai stratigraphy 1.
                        </p>
                        <p id="selectedImagealamat" class="text-sm">
                            lokasi stratigraphy 1
                        </p>
                        <p id="selectedImagealamat" class="text-sm">usia</p>
                    </div>
                </div>
            </div>
            <div class="bottom-4 right-4 bg-white bg-opacity-75 rounded-lg p-2 shadow-md sm: overflow-x-auto">
                <div class="flex space-x-4">
                    <div class="text-center">
                        <img src="../img/stphy/s1.jpg " alt="Image 1" class="w-20 h-20 object-cover cursor-pointer mb-2"
                            onclick="selectImage('../img/stphy/s1.jpg ', 'deskripsi gambar1.', 'Image 1','alamat dari gambar1.')" />
                        <p class="text-sm text-gray-800">Image 1</p>
                    </div>
                    <div class="text-center">
                        <img src="../img/stphy/s2.jpg" alt="Image 2" class="w-20 h-20 object-cover cursor-pointer mb-2"
                            onclick="selectImage('../img/stphy/s2.jpg', 'deskripsi gambar2.', 'Image 2','alamat dari gambar2.')" />
                        <p class="text-sm text-gray-800">Image 2</p>
                    </div>
                    <div class="text-center">
                        <img src=" ../img/stphy/s3.jpg" alt="Image 3" class="w-20 h-20 object-cover cursor-pointer mb-2"
                            onclick="selectImage('../img/stphy/s3.jpg', 'deskripsi gambar3.', 'Image 3','alamat dari gambar 3.')" />
                        <p class="text-sm text-gray-800">Image 3</p>
                    </div>
                    <div class="text-center">
                        <img src="../img/stphy/s4.jpg" alt="Image 4" class="w-20 h-20 object-cover cursor-pointer mb-2"
                            onclick="selectImage('../img/stphy/s4.jpg', 'deskripsi gambar4.', 'Image 4','alamat gambar4.')" />
                        <p class="text-sm text-gray-800">Image 4</p>
                    </div>
                    <div class="text-center">
                        <img src="../img/stphy/s5.jpg" alt="Image 1" class="w-20 h-20 object-cover cursor-pointer mb-2"
                            onclick="selectImage('../img/stphy/s5.jpg', 'deskripsi gambar5.', 'Image 5','alamat gambar5.')" />
                        <p class="text-sm text-gray-800">Image 5</p>
                    </div>
                    <div class="text-center">
                        <img src="../img/stphy/s6.jpg" alt="Image 2" class="w-20 h-20 object-cover cursor-pointer mb-2"
                            onclick="selectImage('../img/stphy/s6.jpg', 'deskripsi gambar6.', 'Image 6','alamat gambar6.')" />
                        <p class="text-sm text-gray-800">Image 6</p>
                    </div>
                    <div class="text-center">
                        <img src="../img/stphy/s7.jpg" alt="Image 3" class="w-20 h-20 object-cover cursor-pointer mb-2"
                            onclick="selectImage('../img/stphy/s7.jpg', 'deskripsi gambar no 7.', 'Image 7','alamat gambar7.')" />
                        <p class="text-sm text-gray-800">Image 7</p>
                    </div>
                    <div class="text-center">
                        <img src="../img/stphy/s8.jpg" alt="Image 4" class="w-20 h-20 object-cover cursor-pointer mb-2"
                            onclick="selectImage('../img/stphy/s8.jpg', 'Deskripsi dari gambar.', 'Image 8','alamat untuk gambar.')" />
                        <p class="text-sm text-gray-800">Image 8</p>
                    </div>
                </div>
            </div>
        </div>
        <!--konten 2-->
        <div class="mb-8 mt-20">
            <!-- galery 2-->
            <h1 class="text-4xl font-bold text-center text-indigo-900 border-b-2 mb-8">
                Fosil Flora
            </h1>
            <!-- Galeri Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <figure class="relative">
                    <img src="../img/fosil flora/fslflr.jpg" alt="Gambar 1"
                        class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
                        onclick="openModal3(this.src)" />

                    <p class="font-bold">Nama Gambar 1</p>
                    <p class="text-sm">Deskripsi :</p>
                    <p class="text-sm">Lokasi :</p>
                    <p class="text-sm">Usia:</p>
                </figure>
                <figure class="relative">
                    <img src="../img/fosil flora/fslflr.jpg" alt="Gambar 2"
                        class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
                        onclick="openModal3(this.src)" />

                    <p class="font-bold">Nama Gambar 2</p>
                    <p class="text-sm">Deskripsi :</p>
                    <p class="text-sm">Lokasi :</p>
                    <p class="text-sm">Usia:</p>
                </figure>
                <figure class="relative">
                    <img src="../img/fosil flora/fslflr.jpg" alt="Gambar 3"
                        class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
                        onclick="openModal3(this.src)" />

                    <p class="font-bold">Nama Gambar 3</p>
                    <p class="text-sm">Deskripsi :</p>
                    <p class="text-sm">Lokasi :</p>
                    <p class="text-sm">Usia:</p>
                </figure>
                <figure class="relative">
                    <img src="../img/fosil flora/fslflr.jpg" alt="Gambar 4"
                        class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
                        onclick="openModal3(this.src)" />

                    <p class="font-bold">Nama Gambar 4</p>
                    <p class="text-sm">Deskripsi :</p>
                    <p class="text-sm">Lokasi :</p>
                    <p class="text-sm">Usia:</p>
                </figure>
                <figure class="relative">
                    <img src="../img/fosil flora/fslflr.jpg" alt="Gambar 5"
                        class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
                        onclick="openModal3(this.src)" />

                    <p class="font-bold">Nama Gambar 5</p>
                    <p class="text-sm">Deskripsi :</p>
                    <p class="text-sm">Lokasi :</p>
                    <p class="text-sm">Usia:</p>
                </figure>
                <figure class="relative">
                    <img src="../img/fosil flora/fslflr.jpg" alt="Gambar 6"
                        class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
                        onclick="openModal3(this.src)" />

                    <p class="font-bold">Nama Gambar 6</p>
                    <p class="text-sm">Deskripsi :</p>
                    <p class="text-sm">Lokasi :</p>
                    <p class="text-sm">Usia:</p>
                </figure>
                <figure class="relative">
                    <img src="../img/fosil flora/fslflr.jpg" alt="Gambar 6"
                        class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
                        onclick="openModal3(this.src)" />

                    <p class="font-bold">Nama Gambar 7</p>
                    <p class="text-sm">Deskripsi :</p>
                    <p class="text-sm">Lokasi :</p>
                    <p class="text-sm">Usia:</p>
                </figure>
                <figure>
                    <img src="../img/fosil flora/fslflr.jpg" alt="Gambar 6"
                        class="w-full h-48 object-cover rounded-lg cursor-pointer hover:opacity-75 transition"
                        onclick="openModal3(this.src)" />

                    <p class="font-bold">Nama Gambar 8</p>
                    <p class="text-sm">Deskripsi :</p>
                    <p class="text-sm">Lokasi :</p>
                    <p class="text-sm">Usia:</p>
                </figure>
            </div>

            <!--konten 3-->
            <div class="relative overflow-hidden w-full max-w-4xl mx-auto mt-20">
                <h1 class="text-4xl font-bold text-center text-indigo-900 border-b-2 mb-8">
                    Situs Geologi
                </h1>
                <!-- Carousel Wrapper -->
                <div id="carouselWrapper" class="flex transition-transform duration-500 ease-in-out">
                    <!-- Image 1 -->
                    <div class="relative w-full flex-shrink-0">
                        <img src="../img/kegiatan/dok3.jpg" alt="Gambar 1" class="w-full h-96 object-cover rounded-lg"
                            onclick="openModal(this.src, 'Nama Gambar 1', 'Deskripsi Gambar 1', 'Lokasi 1', 'Usia 1')" />
                        <div class="absolute bottom-0 left-0 w-full bg-gray-900 bg-opacity-60 text-white text-center p-2">
                            <p>Nama Gambar 1</p>
                            <p>Deskripsi</p>
                            <p>Lokasi</p>
                            <p>Usia</p>
                        </div>
                    </div>

                    <!-- Image 2 -->
                    <div class="relative w-full flex-shrink-0">
                        <img src="../img/kegiatan/dok2.jpg" alt="Gambar 2" class="w-full h-96 object-cover rounded-lg"
                            onclick="openModal(this.src, 'Nama Gambar 2', 'Deskripsi Gambar 2', 'Lokasi 2', 'Usia 2')" />
                        <div class="absolute bottom-0 left-0 w-full bg-gray-900 bg-opacity-60 text-white text-center p-2">
                            <p>Nama Gambar 2</p>
                            <p>Deskripsi</p>
                            <p>Lokasi</p>
                            <p>Usia</p>
                        </div>
                    </div>

                    <!-- Image 3 -->
                    <div class="relative w-full flex-shrink-0">
                        <img src="../img/kegiatan/dok1.jpg" alt="Gambar 3" class="w-full h-96 object-cover rounded-lg"
                            onclick="openModal(this.src, 'Nama Gambar 3', 'Deskripsi Gambar 3', 'Lokasi 3', 'Usia 3')" />
                        <div class="absolute bottom-0 left-0 w-full bg-gray-900 bg-opacity-60 text-white text-center p-2">
                            <p>Nama Gambar 3</p>
                            <p>Deskripsi</p>
                            <p>Lokasi</p>
                            <p>Usia</p>
                        </div>
                    </div>
                </div>

                <!-- Prev/Next Buttons -->
                <button id="prevBtn"
                    class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-70 text-white px-4 py-2 rounded-full hover:bg-opacity-90">
                    ‹
                </button>
                <button id="nextBtn"
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-70 text-white px-4 py-2 rounded-full hover:bg-opacity-90">
                    ›
                </button>
            </div>

            <!--konten 4-->
            <!-- Gallery Section -->
            <div class="mb-8 mt-20">
                <h1 class="text-4xl font-bold text-center text-indigo-900 border-b-2 mb-8">
                    Flora Diversity
                </h1>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
                    <!-- Card Example -->
                    <div class="relative group">
                        <img src="../img/flora/flr1.png" alt="Sample Image"
                            class="w-full h-60 object-cover rounded-lg cursor-pointer transition-transform transform group-hover:scale-110"
                            onclick="openModal(this.src, 'Sample Title', 'Sample Description', 'Sample Location', 'Sample Age')" />
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="text-white text-center">
                                <h3 class="text-lg font-semibold mb-2">Sample Title</h3>
                                <p class="mb-1">Description: Sample Description</p>
                                <p class="mb-1">Location: Sample Location</p>
                                <p>Age: Sample Age</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative group">
                        <img src="../img/flora/flr2.png" alt="Sample Image"
                            class="w-full h-60 object-cover rounded-lg cursor-pointer transition-transform transform group-hover:scale-110"
                            onclick="openModal(this.src, 'Sample Title', 'Sample Description', 'Sample Location', 'Sample Age')" />
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="text-white text-center">
                                <h3 class="text-lg font-semibold mb-2">Sample Title</h3>
                                <p class="mb-1">Description: Sample Description</p>
                                <p class="mb-1">Location: Sample Location</p>
                                <p>Age: Sample Age</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative group">
                        <img src="../img/flora/flr3.png" alt="Sample Image"
                            class="w-full h-60 object-cover rounded-lg cursor-pointer transition-transform transform group-hover:scale-110"
                            onclick="openModal(this.src, 'Sample Title', 'Sample Description', 'Sample Location', 'Sample Age')" />
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="text-white text-center">
                                <h3 class="text-lg font-semibold mb-2">Sample Title</h3>
                                <p class="mb-1">Description: Sample Description</p>
                                <p class="mb-1">Location: Sample Location</p>
                                <p>Age: Sample Age</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative group">
                        <img src="../img/flora/flr2.png" alt="Sample Image"
                            class="w-full h-60 object-cover rounded-lg cursor-pointer transition-transform transform group-hover:scale-110"
                            onclick="openModal(this.src, 'Sample Title', 'Sample Description', 'Sample Location', 'Sample Age')" />
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="text-white text-center">
                                <h3 class="text-lg font-semibold mb-2">Sample Title</h3>
                                <p class="mb-1">Description: Sample Description</p>
                                <p class="mb-1">Location: Sample Location</p>
                                <p>Age: Sample Age</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative group">
                        <img src="../img/flora/flr1.png" alt="Sample Image"
                            class="w-full h-60 object-cover rounded-lg cursor-pointer transition-transform transform group-hover:scale-110"
                            onclick="openModal(this.src, 'Sample Title', 'Sample Description', 'Sample Location', 'Sample Age')" />
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="text-white text-center">
                                <h3 class="text-lg font-semibold mb-2">Sample Title</h3>
                                <p class="mb-1">Description: Sample Description</p>
                                <p class="mb-1">Location: Sample Location</p>
                                <p>Age: Sample Age</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative group">
                        <img src="../img/flora/flr3.png" alt="Sample Image"
                            class="w-full h-60 object-cover rounded-lg cursor-pointer transition-transform transform group-hover:scale-110"
                            onclick="openModal(this.src, 'Sample Title', 'Sample Description', 'Sample Location', 'Sample Age')" />
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="text-white text-center">
                                <h3 class="text-lg font-semibold mb-2">Sample Title</h3>
                                <p class="mb-1">Description: Sample Description</p>
                                <p class="mb-1">Location: Sample Location</p>
                                <p>Age: Sample Age</p>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat above block for more cards -->
                </div>
            </div>
            <!--konten 6-->
            <!-- Gallery Section -->
            <div class="mb-8 mt-20">
                <h1 class="text-4xl font-bold text-center text-indigo-900 border-b-2 mb-8">
                    Fauna Diversity
                </h1>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
                    <!-- Card Example -->
                    <div class="relative group">
                        <img src="../img/fauna/fauna1.jpg" alt="Sample Image"
                            class="w-full h-60 object-cover rounded-lg cursor-pointer transition-transform transform group-hover:scale-110"
                            onclick="openModal(this.src, 'Sample Title', 'Sample Description', 'Sample Location', 'Sample Age')" />
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="text-white text-center">
                                <h3 class="text-lg font-semibold mb-2">Sample Title</h3>
                                <p class="mb-1">Description: Sample Description</p>
                                <p class="mb-1">Location: Sample Location</p>
                                <p>Age: Sample Age</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative group">
                        <img src="../img/fauna/fauna2.jpg" alt="Sample Image"
                            class="w-full h-60 object-cover rounded-lg cursor-pointer transition-transform transform group-hover:scale-110"
                            onclick="openModal(this.src, 'Sample Title', 'Sample Description', 'Sample Location', 'Sample Age')" />
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="text-white text-center">
                                <h3 class="text-lg font-semibold mb-2">Sample Title</h3>
                                <p class="mb-1">Description: Sample Description</p>
                                <p class="mb-1">Location: Sample Location</p>
                                <p>Age: Sample Age</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative group">
                        <img src="../img/fauna/fauna3.jpg" alt="Sample Image"
                            class="w-full h-60 object-cover rounded-lg cursor-pointer transition-transform transform group-hover:scale-110"
                            onclick="openModal(this.src, 'Sample Title', 'Sample Description', 'Sample Location', 'Sample Age')" />
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="text-white text-center">
                                <h3 class="text-lg font-semibold mb-2">Sample Title</h3>
                                <p class="mb-1">Description: Sample Description</p>
                                <p class="mb-1">Location: Sample Location</p>
                                <p>Age: Sample Age</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative group">
                        <img src="../img/fauna/fauna4.jpg" alt="Sample Image"
                            class="w-full h-60 object-cover rounded-lg cursor-pointer transition-transform transform group-hover:scale-110"
                            onclick="openModal(this.src, 'Sample Title', 'Sample Description', 'Sample Location', 'Sample Age')" />
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="text-white text-center">
                                <h3 class="text-lg font-semibold mb-2">Sample Title</h3>
                                <p class="mb-1">Description: Sample Description</p>
                                <p class="mb-1">Location: Sample Location</p>
                                <p>Age: Sample Age</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative group">
                        <img src="../img/fauna/fauna5.jpg" alt="Sample Image"
                            class="w-full h-60 object-cover rounded-lg cursor-pointer transition-transform transform group-hover:scale-110"
                            onclick="openModal(this.src, 'Sample Title', 'Sample Description', 'Sample Location', 'Sample Age')" />
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="text-white text-center">
                                <h3 class="text-lg font-semibold mb-2">Sample Title</h3>
                                <p class="mb-1">Description: Sample Description</p>
                                <p class="mb-1">Location: Sample Location</p>
                                <p>Age: Sample Age</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative group">
                        <img src="../img/fauna/fauna6.jpg" alt="Sample Image"
                            class="w-full h-60 object-cover rounded-lg cursor-pointer transition-transform transform group-hover:scale-110"
                            onclick="openModal(this.src, 'Sample Title', 'Sample Description', 'Sample Location', 'Sample Age')" />
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="text-white text-center">
                                <h3 class="text-lg font-semibold mb-2">Sample Title</h3>
                                <p class="mb-1">Description: Sample Description</p>
                                <p class="mb-1">Location: Sample Location</p>
                                <p>Age: Sample Age</p>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat above block for more cards -->
                </div>
            </div>

            <!-- Kontak Orang Kedua -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-indigo-900 mt-12 inline-block border-b-2 border-indigo-900">
                    Kontak
                </h2>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-indigo-900 mb-4 border-b-2">
                        Kontak Pihak Pengelola Museum Geopark Merangin
                    </h3>
                    <p class="text-gray-700 mb-3">
                        Untuk informasi lebih lanjut, Anda dapat menghubungi:
                    </p>
                    <div class="flex items-center mb-1">
                        <i class="fas fa-user-circle text-indigo-700 text-xl mr-4"></i>
                        <p class="text-gray-800 text-lg">Nama Kontak: Budi Santoso</p>
                    </div>
                    <div class="flex items-center mb-1">
                        <i class="fas fa-phone-alt text-indigo-700 text-xl mr-4"></i>
                        <p class="text-gray-800 text-lg cursor-pointer" onclick="copyPhoneNumber()">
                            Telepon: (098) 765-4321
                        </p>
                    </div>
                    <div class="flex items-center mb-1">
                        <i class="fas fa-envelope text-indigo-700 text-xl mr-4"></i>
                        <p class="text-gray-800 text-lg">
                            Whatsapp:
                            <a href="mailto:budi.santoso@example.com"
                                class="text-indigo-600 hover:underline">089787654779</a>
                        </p>
                    </div>
                    <div class="flex items-center mb-1">
                        <i class="fas fa-envelope text-indigo-700 text-xl mr-4"></i>
                        <p class="text-gray-800 text-lg">
                            Email:
                            <a href="mailto:budi.santoso@example.com"
                                class="text-indigo-600 hover:underline">budi.santoso@example.com</a>
                        </p>
                    </div>
                    <div class="flex items-center mb-1">
                        <i class="fab fa-instagram text-indigo-700 text-xl mr-4"></i>
                        <p class="text-gray-800 text-lg">
                            Instagram:
                            <a href="https://www.instagram.com/budisantoso" class="text-indigo-600 hover:underline"
                                target="_blank">budi_santoso</a>
                        </p>
                    </div>
                    <div class="flex items-center mb-2">
                        <i class="fas fa-map-marker-alt text-indigo-700 text-xl mr-4"></i>
                        <p class="text-gray-800 text-lg">Alamat: Jalan DEF No. 456</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="modalimagek2" class="fixed inset-0 bg-black bg-opacity-75 items-center justify-center hidden">
            <div class="relative">
                <img id="modal-image" src="" alt="Gambar besar" class="max-w-full max-h-full rounded-lg" />
                <button onclick="closeModal()" class="absolute top-2 right-2 text-white text-3xl font-bold">
                    &times;
                </button>
            </div>
        </div>
        <!-- Modal 2 -->
        <div id="modalimage3" class="fixed inset-0 items-center justify-center bg-black bg-opacity-75 hidden z-50">
            <div class="relative">
                <span class="absolute top-0 right-0 text-white text-2xl cursor-pointer p-4"
                    onclick="closeModal()">&times;</span>
                <img id="modalImageContent" src="" class="max-w-full max-h-[84vh]" />
            </div>
        </div>

        <!-- Modal 3-->
        <div id="imageModal4" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 justify-center items-center z-50">
            <div class="bg-white rounded-lg p-4 max-w-lg mx-auto">
                <button id="closeModal" class="text-gray-500 hover:text-gray-700 text-xl float-right">
                    &times;
                </button>
                <img id="modalImage4" class="w-full h-64 object-cover rounded-lg" src="" alt="Selected Image" />
                <div class="p-4 text-center">
                    <h2 id="modalTitle" class="text-lg font-bold"></h2>
                    <p id="modalDescription" class="text-sm text-gray-600 mt-2"></p>
                    <p id="modalLocation" class="text-sm text-gray-600 mt-2"></p>
                    <p id="modalAge" class="text-sm text-gray-600 mt-2"></p>
                </div>
            </div>
        </div>
        <!--modal 4-->
        <!-- Modal -->
        <div id="imageModal5"
            class="modal fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center z-50 opacity-0 invisible">
            <div class="bg-white p-4 rounded-lg max-w-lg mx-auto relative">
                <button id="closeModal5" class="absolute top-0 right-0 p-2 text-gray-500 hover:text-gray-700 text-xl">
                    &times;
                </button>
                <img id="modalImage5" src="" alt="Modal Image" class="w-full h-auto mb-4" />
                <h2 id="modalTitle5" class="text-xl font-semibold mb-2">Title</h2>
                <p id="modalDescription5" class="mb-1">Description:</p>
                <p id="modalLocation5" class="mb-1">Location:</p>
                <p id="modalAge5" class="mb-1">Age:</p>
            </div>
        </div>
    </div>

    <!--penutup-->
    <footer class="bg-indigo-900 py-2" id="contact">
        <section class="w-full max-w-6xl mx-auto py-8">
            <div class="flex flex-col md:flex-row md:justify-between">
                <!-- Kontak -->
                <div class="bg-transparent p-2 rounded-lg text-center md:text-left mb-4 md:mb-0">
                    <h3 class="text-lg md:text-xl font-bold text-white mb-3">Kontak</h3>
                    <p class="text-sm md:text-base text-white mb-3">
                        Alamat: Jl. Jambi – Muara Bulian No.KM. 15, Mendalo Darat, Kec.
                        Jambi Luar Kota, Kabupaten Muaro Jambi, Jambi
                    </p>
                    <p class="text-sm md:text-base text-white mb-3">
                        Telepon: (123) 456-7890
                    </p>
                    <p class="text-sm md:text-base text-white mb-3">
                        Email: info@example.com
                    </p>
                </div>

                <!-- Media Sosial -->
                <div class="bg-transparent p-6 rounded-lg text-center md:text-left">
                    <h3 class="text-lg md:text-xl font-bold text-white mb-3">
                        Follow Us
                    </h3>
                    <div class="flex flex-wrap justify-center md:justify-start gap-4">
                        <!-- Facebook -->
                        <a href="#" class="text-white hover:text-indigo-600 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6 md:w-8 md:h-8">
                                <path fill="currentColor"
                                    d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z" />
                            </svg>
                            <span class="text-xs md:text-sm">puigemarfacebook</span>
                        </a>
                        <!-- Instagram -->
                        <a href="#" class="text-white hover:text-indigo-600 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-6 md:w-8 md:h-8">
                                <path fill="currentColor"
                                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9 26.2 26.2 58 34.4 93.9 36.2 37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                            </svg>
                            <span class="text-xs md:text-sm">puigemarinstagram</span>
                        </a>
                        <!-- X -->
                        <a href="#" class="text-white hover:text-indigo-600 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6 md:w-8 md:h-8">
                                <path fill="currentColor"
                                    d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                            </svg>
                            <span class="text-xs md:text-sm">puigemarX</span>
                        </a>
                        <!-- TikTok -->
                        <a href="#" class="text-white hover:text-indigo-600 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-6 md:w-8 md:h-8">
                                <path fill="white"
                                    d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z" />
                            </svg>
                            <span class="text-xs md:text-sm">puigemartiktok</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full bg-gray-300 py-4 text-center">
            <p class="text-indigo-900 text-sm">
                &copy; 2024 PUI GEMAR |All Rights Reserved
            </p>
        </section>
    </footer>
    <!--  link JavaScript Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!--  link JavaScript tambahan -->
    <script src="javascript.js"></script>
    <script>
        function copyPhoneNumber() {
            const phoneNumber = "(098) 765-4321";
            navigator.clipboard
                .writeText(phoneNumber)
                .then(() => {
                    alert("Nomor telepon telah disalin ke clipboard!");
                })
                .catch((err) => {
                    console.error("Gagal menyalin nomor telepon: ", err);
                });
        }
    </script>

    <script>
        function selectImage(imageUrl, description, title, address) {
            document.getElementById("selectedImage").src = imageUrl;
            document.getElementById("selectedImageDescription").innerText =
                description;
            document.getElementById("selectedImageTitle").innerText = title;
            document.getElementById("selectedImagealamat").innerText = address;
        }

        // Memilih gambar pertama secara otomatis saat halaman dimuat
        window.onload = function() {
            selectImage(
                "../img/stphy/s1.jpg",
                "This is the description for image 1.",
                "Image 1",
                "Alamat 1"
            );
        };
    </script>
    <script>
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
    </script>
    <script>
        <!-- Modal 
        -->
    < div id="imageModal3" class="fixed inset-0 z-50 items-center justify-center hidden">
        < div class="bg-white p-4 rounded-lg shadow-lg max-w-lg w-full relative">
            < button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closeModal()">
                &
                times; < /button>
                    < img id="modalImage3" class="w-full h-64 object-cover rounded-lg" src="" alt="" />
                    < h2 id="modalTitle" class="mt-4 text-xl font-semibold">
                        < /h2>
                            < p id="modalDescription" class="text-gray-700 mt-2">
                                < /p>
                                    < p id="modalLocation" class="text-gray-500 mt-2">
                                        < /p>
                                            < p id="modalAge" class="text-gray-500 mt-1">
                                                < /p>
                                                    < / div>
                                                        < div class="fixed inset-0 bg-black opacity-50"
                                                            onclick="closeModal()">
                                                            < /div>
                                                                < / div> ;
    </script>
    <script>
        function openModal3(src) {
            const modal = document.getElementById("modalimage3");
            const modalImg = document.getElementById("modalImageContent");

            // Atur sumber gambar pada modal sesuai dengan gambar yang diklik
            modalImg.src = src;

            // Tampilkan modal
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        }

        function closeModal() {
            const modal = document.getElementById("modalimage3");
            modal.classList.remove("flex");
            modal.classList.add("hidden");
        }
    </script>
    <!--konten3-->
    <script>
        const carouselWrapper = document.getElementById("carouselWrapper");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");
        let currentSlide = 0;

        // Fungsi untuk berpindah slide
        function moveToSlide(index) {
            const slideWidth = carouselWrapper.children[0].offsetWidth;
            carouselWrapper.style.transform = `translateX(${
          -slideWidth * index
        }px)`;
            currentSlide = index;
        }

        // Tombol Prev
        prevBtn.addEventListener("click", () => {
            if (currentSlide > 0) {
                moveToSlide(currentSlide - 1);
            }
        });

        // Tombol Next
        nextBtn.addEventListener("click", () => {
            if (currentSlide < carouselWrapper.children.length - 1) {
                moveToSlide(currentSlide + 1);
            }
        });

        // Modal Function
        function openModal4(imageSrc, title, description, location, age) {
            const modal = document.getElementById("imageModal4");
            document.getElementById("modalImage").src = imageSrc;
            document.getElementById("modalTitle").innerText = title;
            document.getElementById("modalDescription").innerText =
                "Deskripsi: " + description;
            document.getElementById("modalLocation").innerText =
                "Lokasi: " + location;
            document.getElementById("modalAge").innerText = "Usia: " + age;

            modal.classList.remove("hidden");
            setTimeout(() => {
                modal.classList.add("opacity-100");
            }, 10); // delay to allow transition to work
        }

        // Close Modal
        document
            .getElementById("closeModal")
            .addEventListener("click", function() {
                const modal = document.getElementById("imageModal4");
                modal.classList.remove("opacity-100");
                setTimeout(() => {
                    modal.classList.add("hidden");
                }, 300); // match transition duration
            });
    </script>
    <!--konten 4-->
    <script>
        // Fungsi untuk membuka modal
        function openModal(imageSrc, title, description, location, age) {
            const modal = document.getElementById("imageModal5");
            document.getElementById("modalImage5").src = imageSrc;
            document.getElementById("modalTitle5").innerText = title;
            document.getElementById("modalDescription5").innerText =
                "Description: " + description;
            document.getElementById("modalLocation5").innerText =
                "Location: " + location;
            document.getElementById("modalAge5").innerText = "Age: " + age;

            modal.classList.remove("opacity-0", "invisible");
            modal.classList.add("opacity-100", "visible");
        }

        // Fungsi untuk menutup modal
        document
            .getElementById("closeModal5")
            .addEventListener("click", function() {
                const modal = document.getElementById("imageModal5");
                modal.classList.remove("opacity-100", "visible");
                modal.classList.add("opacity-0", "invisible");
            });
    </script>
@endsection
