<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil (Nama)</title>
    <!-- link CSS Tailwind -->
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <!-- link CSS Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
      rel="stylesheet"
    />
    <!-- Font Roboto -->
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link href="../css/style.css" rel="stylesheet" />
  </head>
  <body class="font-roboto">
    <nav class="bg-indigo-900 py-4 fixed-navbar w-full top-0 z-50">
      <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center">
          <img src="../img/logo.png" alt="Logo" class="h-12 w-16 h-auto ml-8" />
        </div>
        <!-- Menu -->
        <div class="flex justify-center space-x-6">
          <!-- Menu 1 -->
          <a
            href="#"
            class="menu-item text-white hover:text-gray-300 font-medium"
          >
            Beranda
          </a>
          <!-- Menu 2 -->
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
              class="menu-item text-white hover:text-gray-300 focus:outline-none font-medium"
            >
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
              <a href="#" class="block px-4 py-2 text-white hover:bg-gray-700"
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
    <div class="flex">
      <!--konten profil-->
      <div class="max-w-full p-12 bg-white shadow-md rounded-lg w-2/3">
        <h1 class="text-4xl font-bold text-indigo-900 mb-10 mt-24">Profil</h1>
        <!-- Judul "Profil" di atas -->

        <!-- Container gambar  dan penjelasan -->
        <div class="flex items-center">
          <!-- Gambar  -->
          <img
            src="../img/pas1.jpg"
            alt="Foto Dosen"
            class="w-64 h-64 rounded-full mr-8 border-4 border-indigo-600 shadow-lg"
          />

          <!-- Teks penjelasan -->
          <div class="text-gray-800 leading-relaxed mx-8 mt-6">
            <p class="mb-1">
              <span class="font-bold">Nama:</span> [Nama Dosen]
            </p>
            <p class="mb-1"><span class="font-bold">NIP:</span> [NIP]</p>
            <p class="mb-1">
              <span class="font-bold">Keanggotaan:</span> [Keanggotaan]
            </p>
            <p class="mb-1">
              <span class="font-bold">Riwayat Pendidikan:</span> [Riwayat
              Pendidikan Dosen]
            </p>
            <p class="mb-1">
              <span class="font-bold">Pengalaman Kerja:</span> [Pengalaman Kerja
              Dosen]
            </p>
            <p class="mb-1">
              <span class="font-bold">Bidang Keahlian:</span> [Bidang Keahlian]
            </p>
          </div>
        </div>
      </div>

      <!--artikel-->
      <div class="max-w-full p-8 bg-gray-600 w-1/3">
        <h2 class="text-3xl font-semibold text-white mb-5 mt-24">Article</h2>

        <!-- Artikel 1 -->
        <div class="mb-4">
          <h3 class="text-lg font-semibold text-white mb-0">Judul Artikel 1</h3>
          <p class="text-sm text-gray-300 mb-2">01 April 2024</p>
          <p class="text-sm text-white">
            Penjelasan singkat tentang artikel ini.
          </p>
          <a
            href="#"
            class="block text-blue-500 font-semibold mt-2 hover:text-blue-300 transition duration-300"
            >Baca Selengkapnya</a
          >
        </div>
        <hr class="border-gray-800 my-1" />

        <!-- Artikel 2 -->
        <div class="mb-4">
          <h3 class="text-lg font-semibold text-white mb-0">Judul Artikel 2</h3>
          <p class="text-sm text-gray-300 mb-2">01 April 2024</p>
          <p class="text-sm text-white">
            Penjelasan singkat tentang artikel ini.
          </p>
          <a
            href="#"
            class="block text-blue-500 font-semibold mt-2 hover:text-blue-300 transition duration-300"
            >Baca Selengkapnya</a
          >
        </div>
        <hr class="border-gray-800 my-1" />

        <!-- Artikel 3 -->
        <div class="mb-4">
          <h3 class="text-lg font-semibold text-white mb-0">Judul Artikel 3</h3>
          <p class="text-sm text-gray-300 mb-2">01 April 2024</p>
          <p class="text-sm text-white">
            Penjelasan singkat tentang artikel ini.
          </p>
          <a
            href="#"
            class="block text-blue-500 font-semibold mt-2 hover:text-blue-300 transition duration-300"
            >Baca Selengkapnya</a
          >
        </div>
        <hr class="border-gray-800 my-1" />
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
    <!-- link JavaScript Font Awesome -->
    <script
      src="https://kit.fontawesome.com/a076d05399.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

    <!-- link JavaScript  -->
    <script src="../js/javascript.js"></script>
  </body>
</html>
