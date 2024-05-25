<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Website PUI GEMAR</title>
    <!--  link CSS Tailwind -->
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <!--  link CSS Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
      rel="stylesheet"
    />
    <!-- Font Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto&display=swap"
    />

    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet" />

    <link href="https://fonts.cdnfonts.com/css/amoera" rel="stylesheet" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <link href="css/style.css" rel="stylesheet" />
  </head>
  <body class="font-roboto">
    <nav class="bg-indigo-900 py-4 fixed-navbar w-full top-0 z-50">
      <div class="container mx-auto flex justify-between items-center">
        <!-- Logo  -->
        <div class="flex items-center">
          <img src="img/logo.png" alt="Logo" class="h-12 w-16 h-auto ml-8" />
        </div>
        <!-- Menu -->
        <div class="flex justify-center space-x-6">
          <!-- Menu 1 -->
          <a
            href="#"
            class="menu-item text-white hover:text-gray-300 font-medium border-b-2"
          >
            Beranda
          </a>
          <!-- Menu 2 -->
          <div class="relative">
            <button
              class="menu-item text-white hover:text-gray-300 focus:outline-none font-medium">
              Profil <i class="fas fa-caret-down ml-1" style="color: white"></i>
            </button>
            <!-- Submenu Menu 2 -->
            <div
              class="submenu absolute left-0 mt-2 w-48 bg-indigo-900 shadow-lg rounded-lg py-2 hidden">
              <a href="/sejarah" class="block px-4 py-2 text-white hover:bg-gray-700">
                Sejarah</a>
              <a href="/visimisi" class="block px-4 py-2 text-white hover:bg-gray-700">
                Visi Misi</a>
              <a href="#" class="block px-4 py-2 text-white hover:bg-gray-700"
                >Struktur Organisasi</a>
              <a href="/tim" class="block px-4 py-2 text-white hover:bg-gray-700">
                Tim</a>
            </div>
          </div>
          <!-- Menu 3 -->
          <div class="relative">
            <button
              class="menu-item text-white hover:text-gray-300 focus:outline-none font-medium">
              Sumber Daya
              <i class="fas fa-caret-down ml-1" style="color: white"></i>
            </button>
            <!-- Submenu Menu 3 -->
            <div
              class="submenu absolute left-0 mt-2 w-48 bg-indigo-900 shadow-lg rounded-lg py-2 hidden"
            >
              <a href="#" class="block px-4 py-2 text-white hover:bg-gray-700"
                >Artikel</a
              >
              <a href="#" class="block px-4 py-2 text-white hover:bg-gray-700"
                >Kegiatan</a
              >
              <a href="/peta" class="block px-4 py-2 text-white hover:bg-gray-700"
                >Persebaran UMKM</a
              >
            </div>
          </div>
          <!-- Menu 4 -->
          <a
            href="#"
            class="menu-item text-white hover:text-gray-300 font-medium"
          >
            Kontak
          </a>
        </div>
        <!-- Ikon search  -->
        <div class="search-icon mr-10">
          <button
            class="text-white hover:text-gray-300 focus:outline-none"
            id="searchButton"
          >
            <i class="fas fa-search text-lg"></i>
          </button>
          <!-- Kotak penelusuran -->
          <div
            id="searchBox"
            class="absolute top-5 right-1 mt-10 bg-white rounded-lg shadow-md px-4 py-2 hidden"
          >
            <input
              type="text"
              class="border border-gray-300 px-2 py-1 rounded-lg focus:outline-none focus:border-blue-500"
              placeholder="Cari..."
            />
          </div>
        </div>
      </div>
    </nav>

    <!--konten pertama-->
    <div class="container mx-auto py-24">
      <div class="flex items-center">
        <!-- Penjelasan gambar -->
        <div class="w-1/2 bg-cream p-6 rounded-lg animate-slide-in-bottom">
          <h2
            class="text-indigo-900 text-2xl font-semibold mb-4 font-poppins ml-10"
          >
            PUI GEMAR
          </h2>
          <p class="text-indigo-900 font-poppins ml-10">
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of type
            and scrambled it to make a type specimen book.
          </p>
          <!-- Tautan -->
          <a
            href="link_ke_halaman_lain"
            class="text-blue-500 hover:underline ml-10 mt-2 block"
            >Sejarah PUI GEMAR</a
          >
        </div>
        <!-- Gambar -->
        <div class="w-2/5 ml-10 animate-slide-in-right">
          <img src="img/logo.png" alt="Gambar" class="w-full rounded-lg" />
        </div>
      </div>
    </div>

    <!--konten kedua-->
    <div
      class="overflow-x-auto whitespace-nowrap bg-indigo-900 py-4 px-8 shadow-md"
    >
      <h2
        class="text-3xl text-center font-Roboto font-bold text-white mb-5 relative mt-2"
      >
        TEAM

        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2">
          <div class="w-20 h-1 bg-white"></div>
        </div>
      </h2>
      <div
        class="overflow-x-auto whitespace-nowrap bg-indigo-900 py-4 px-8 shadow-md"
      >
        <div class="flex">
          <!-- Kartu 1 -->
          <a
            href="#"
            class="team-member flex-none w-50 mr-4 bg-white rounded-lg shadow-md overflow-hidden transform transition-transform hover:scale-105"
          >
            <img
              src="{{ asset('img/pas1.jpg') }}"
              alt="Team Member 1"
              class="w-full h-40 object-cover object-center"
            />
            <div class="p-4">
              <h3 class="text-lg text-center mb-2">Jenny</h3>
              <p class="text-sm text-center">Ketua</p>
            </div>
          </a>
          <!-- Kartu 2 -->
          <a
            href="#"
            class="team-member flex-none w-50 mr-4 bg-white rounded-lg shadow-md overflow-hidden transform transition-transform hover:scale-105"
          >
            <img
              src="{{ asset('img/pas1.jpg') }}"
              alt="Team Member 1"
              class="w-full h-40 object-cover object-center"
            />
            <div class="p-4">
              <h3 class="text-lg text-center font-semibold mb-2">Jenny</h3>
              <p class="text-sm text-center text-gray-600">Ketua</p>
            </div>
          </a>

          <!--kartu 3-->
          <a
            href="#"
            class="team-member flex-none w-50 mr-4 bg-white rounded-lg shadow-md overflow-hidden transform transition-transform hover:scale-105"
          >
            <img
              src="{{ asset('img/pas1.jpg') }}"
              alt="Team Member 1"
              class="w-full h-40 object-cover object-center"
            />
            <div class="p-4">
              <h3 class="text-lg text-center font-semibold mb-2">Jenny</h3>
              <p class="text-sm text-center text-gray-600">Ketua</p>
            </div>
          </a>

          <!--kartu 4-->
          <a
            href="#"
            class="team-member flex-none w-50 mr-4 bg-white rounded-lg shadow-md overflow-hidden transform transition-transform hover:scale-105"
          >
            <img
              src="{{ asset('img/pas1.jpg') }}"
              alt="Team Member 1"
              class="w-full h-40 object-cover object-center"
            />
            <div class="p-4">
              <h3 class="text-lg text-center font-semibold mb-2">Jenny</h3>
              <p class="text-sm text-center text-gray-600">Ketua</p>
            </div>
          </a>

          <!--kartu 5-->
          <a
            href="#"
            class="team-member flex-none w-50 mr-4 bg-white rounded-lg shadow-md overflow-hidden transform transition-transform hover:scale-105"
          >
            <img
              src="img/pas1.jpg"
              alt="Team Member 1"
              class="w-full h-40 object-cover object-center"
            />
            <div class="p-4">
              <h3 class="text-lg text-center font-semibold mb-2">Jenny</h3>
              <p class="text-sm text-center text-gray-600">Ketua</p>
            </div>
          </a>

          <!--kartu 6-->
          <a
            href="#"
            class="team-member flex-none w-50 mr-4 bg-white rounded-lg shadow-md overflow-hidden transform transition-transform hover:scale-105"
          >
            <img
              src="img/pas1.jpg"
              alt="Team Member 1"
              class="w-full h-40 object-cover object-center"
            />
            <div class="p-4">
              <h3 class="text-lg text-center font-semibold mb-2">Jenny</h3>
              <p class="text-sm text-center text-gray-600">Ketua</p>
            </div>
          </a>

          <!--kartu 7-->
          <a
            href="#"
            class="team-member flex-none w-50 mr-4 bg-white rounded-lg shadow-md overflow-hidden transform transition-transform hover:scale-105"
          >
            <img
              src="img/pas1.jpg"
              alt="Team Member 1"
              class="w-full h-40 object-cover object-center"
            />
            <div class="p-4">
              <h3 class="text-lg text-center font-semibold mb-2">Jenny</h3>
              <p class="text-sm text-center text-gray-600">Ketua</p>
            </div>
          </a>

          <!--kartu 8-->
          <a
            href="#"
            class="team-member flex-none w-50 mr-4 bg-white rounded-lg shadow-md overflow-hidden transform transition-transform hover:scale-105"
          >
            <img
              src="img/pas1.jpg"
              alt="Team Member 1"
              class="w-full h-40 object-cover object-center"
            />
            <div class="p-4">
              <h3 class="text-lg text-center font-semibold mb-2">Jenny</h3>
              <p class="text-sm text-center text-gray-600">Ketua</p>
            </div>
          </a>

          <!--kartu 9-->
          <a
            href="#"
            class="team-member flex-none w-50 mr-4 bg-white rounded-lg shadow-md overflow-hidden transform transition-transform hover:scale-105"
          >
            <img
              src="img/pas1.jpg"
              alt="Team Member 1"
              class="w-full h-40 object-cover object-center"
            />
            <div class="p-4">
              <h3 class="text-lg text-center font-semibold mb-2">Jenny</h3>
              <p class="text-sm text-center text-gray-600">Ketua</p>
            </div>
          </a>

          <!-- Kartu Terakhir  -->
          <a
            href="/team"
            class="team-member flex-none w-50 mr-8 bg-white rounded-lg shadow-md overflow-hidden relative group transform transition-transform hover:scale-105"
          >
            <img
              src="img/pas1.jpg"
              alt="Team Member 1"
              class="w-full h-40 object-cover object-center filter grayscale opacity-90"
            />
            <div class="p-4">
              <h3 class="text-lg text-center font-semibold mb-2">Jenny</h3>
              <p class="text-sm text-center">Ketua</p>
            </div>
            <div
              class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
            >
              <div
                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
              >
                <h3 class="text-lg font-semibold text-indigo-600">
                  Lihat Semua
                </h3>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
    <!--konten ketiga-->

    <div
      class="container mx-auto py-8 bg-indigo-900 text-white shadow-md p-6 mt-32"
    >
      <h2
        class="text-3xl font-bold text-center font-poppins text-white mb-5 relative mt-2"
      >
        ARTIKEL

        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2">
          <div class="w-32 h-1 bg-white"></div>
        </div>
      </h2>
      <!-- Artikel 1 -->
      <div class="mb-8 hover:shadow-lg transition duration-300">
        <div class="p-6">
          <h3 class="text-lg font-semibold font-poppins mb-0">
            Judul Artikel 1
          </h3>
          <p class="text-sm text-gray-200 mb-4">01 April 2024</p>
          <p class="text-sm font-poppins">
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's
          </p>
          <a
            href="#"
            class="block text-blue-400 font-semibold py-2 hover:text-blue-300 transition duration-300"
            >Baca Selengkapnya</a
          >
        </div>
      </div>
      <hr class="border-white my-1" />
      <!-- Artikel 2 -->
      <div class="mb-8 hover:shadow-lg transition duration-300">
        <div class="p-6">
          <h3 class="text-lg font-semibold font-poppins mb-0">
            Judul Artikel 2
          </h3>
          <p class="text-sm text-gray-200 mb-4">01 April 2024</p>
          <p class="text-sm font-poppins">
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's
          </p>
          <a
            href="#"
            class="block text-blue-400 font-semibold py-2 hover:text-blue-300 transition duration-300"
            >Baca Selengkapnya</a
          >
        </div>
      </div>
      <hr class="border-white my-1" />
      <!-- Artikel 3 -->
      <div class="mb-8 hover:shadow-lg transition duration-300">
        <div class="p-6">
          <h3 class="text-lg font-semibold font-poppins mb-0">
            Judul Artikel 3
          </h3>
          <p class="text-sm text-gray-200 mb-4">01 April 2024</p>
          <p class="text-sm font-poppins">
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's
          </p>
          <a
            href="#"
            class="block text-blue-400 font-semibold py-2 hover:text-blue-300 transition duration-300"
            >Baca Selengkapnya</a
          >
        </div>
      </div>
      <!-- Link Lihat Semua -->
      <div class="text-center">
        <a
          href="#"
          class="block text-blue-400 font-semibold mt-4 hover:text-blue-600 transition duration-300 border border-blue-200 rounded-md py-2 px-4 inline-block"
          >Lihat Semua</a
        >
      </div>
    </div>
    <!--konten keempat-->
    <div class="container mx-auto py-8">
      <h2
        class="text-3xl font-bold text-center font-poppins text-indigo-900 mt-5 mb-8"
      >
        Kegiatan
      </h2>
      <div class="container mx-auto py-8 w-full relative">
        <div class="carousel-container flex items-center justify-center">
          <!-- Slide 1 -->
          <div class="slide h-96 w-3/4">
            <img
              src="img/dok1.jpg"
              alt="Documentation 1"
              class="w-full h-full object-cover"
            />
            <div class="bg-gray-100 text-center mb-4">
              <h3 class="text-lg font-semibold mb-2">Documentation Title 1</h3>
              <p class="text-sm text-gray-600">
                Short description of documentation 1
              </p>
            </div>
          </div>
          <!-- Slide 2 -->
          <div class="slide h-96 w-3/4 hidden">
            <img
              src="img/dok2.jpg"
              alt="Documentation 2"
              class="w-full h-full object-cover"
            />
            <div class="bg-gray-100 text-center mb-4">
              <h3 class="text-lg font-semibold mb-2">Documentation Title 2</h3>
              <p class="text-sm text-gray-600">
                Short description of documentation 2
              </p>
            </div>
          </div>
          <!-- Slide 3 -->
          <div class="slide h-96 w-3/4 hidden">
            <img
              src="img/dok3.jpg"
              alt="Documentation 3"
              class="w-full h-full object-cover"
            />
            <div class="bg-gray-100 text-center mb-4">
              <h3 class="text-lg font-semibold mb-2">Documentation Title 3</h3>
              <p class="text-sm text-gray-600">
                Short description of documentation 3
              </p>
            </div>
          </div>
          <!-- Slide 4 -->
          <div class="slide h-96 w-3/4 relative hidden">
            <img
              src="img/dok4.jpg"
              alt="Documentation 4"
              class="w-full h-full object-cover"
            />

            <div
              class="absolute inset-0 flex flex-col justify-center items-center bg-black bg-opacity-75"
            >
              <div class="text-center text-white">
                <h3 class="text-lg font-semibold mb-2">
                  Documentation Title 4
                </h3>
                <p class="text-sm text-gray-300 mb-4">
                  Short description of documentation 4
                </p>
                <a
                  href="#"
                  class="text-indigo-800 hover:text-blue-200 transition duration-300"
                  >Lihat Semua</a
                >
              </div>
            </div>
          </div>
        </div>
        <div
          class="dots absolute bottom-0 left-1/2 transform -translate-x-1/2 flex space-x-2 mt-4 my-16"
        >
          <span
            class="dot bg-gray-300 w-2 h-2 rounded-full cursor-pointer selected"
          ></span>
          <span
            class="dot bg-gray-300 w-2 h-2 rounded-full cursor-pointer"
          ></span>
          <span
            class="dot bg-gray-300 w-2 h-2 rounded-full cursor-pointer"
          ></span>
          <span
            class="dot bg-gray-300 w-2 h-2 rounded-full cursor-pointer"
          ></span>

          <!-- dot sesuai jumlah slide -->
        </div>
      </div>
    </div>

    <!-- Konten kelima: Persebaran Sumber Daya -->
    <div class="container mx-auto py-8">
      <h2
        class="text-3xl font-bold text-center font-poppins text-indigo-900 mt-5 mb-8"
      >
        Persebaran Sumber Daya
      </h2>
      <div class="bg-gray-100 p-10">
        <div id="map" class="h-80"></div>
      </div>
    </div>
    <!--penutup-->
    <div class="container bg-indigo-900 h-80">
      <section class="container mx-auto py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
          <!-- Kontak -->
          <div class="bg-trasparant p-6 rounded-lg ml-10">
            <h3 class="text-lg font-bold text-white mb-3">Kontak</h3>
            <p class="text-white mb-3 font-roboto">Alamat: Jalan ABC No. 123</p>
            <p class="text-white mb-3 font-roboto">Telepon: (123) 456-7890</p>
            <p class="text-white mb-3 font-roboto">Email: info@example.com</p>
          </div>

          <!-- Media Sosial -->
          <div class="bg-transparant p-6 rounded-lg">
            <h3 class="text-lg font-bold text-white mb-3">Media Sosial</h3>
            <div class="flex items-center space-x-4">
              <a href="#" class="text-white hover:text-indigo-600"
                ><i class="fab fa-facebook-f"></i
              ></a>
              <a href="#" class="text-white hover:text-indigo-600"
                ><i class="fab fa-twitter"></i
              ></a>
              <a href="#" class="text-white hover:text-indigo-600"
                ><i class="fab fa-instagram"></i
              ></a>
              <a href="#" class="text-white hover:text-indigo-600"
                ><i class="fab fa-linkedin-in"></i
              ></a>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!--  link JavaScript Font Awesome -->
    <script
      src="https://kit.fontawesome.com/a076d05399.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!--  link JavaScript tambahan -->
    <script src="js/javascript.js"></script>
  </body>
</html>
