<nav class="bg-indigo-900 py-4 fixed-navbar w-full top-0 z-50">
  <div class="container mx-auto flex justify-between items-center">
    <!-- Logo  -->
    <div class="flex items-center">
      <img src="img/logo.png" alt="Logo" class="h-12 w-16 h-auto ml-8" />
    </div>
    <!-- Menu -->
    <div class="flex justify-center space-x-6">
      <!-- Menu 1 -->
      <a href="/" class="menu-item text-white hover:text-gray-300 font-medium border-b-2">
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
          <a href="{{ route('profil.sejarah') }}" class="block px-4 py-2 text-white hover:bg-gray-700">
            Sejarah</a>
          <a href="{{ route('profil.visimisi') }}" class="block px-4 py-2 text-white hover:bg-gray-700">
            Visi Misi</a>
          <a href="{{ route('profil.struktur-organisasi') }}" class="block px-4 py-2 text-white hover:bg-gray-700"
            >Struktur Organisasi</a>
          <a href="{{ route('profil.tim') }}" class="block px-4 py-2 text-white hover:bg-gray-700">
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
          <a href="{{ route('sumberdaya.artikel') }}" class="block px-4 py-2 text-white hover:bg-gray-700"
            >Artikel</a
          >
          <a href="{{ route('sumberdaya.kegiatan') }}" class="block px-4 py-2 text-white hover:bg-gray-700"
            >Kegiatan</a
          >
          <a href="{{ route('sumberdaya.petapersebaran') }}" class="block px-4 py-2 text-white hover:bg-gray-700"
            >Persebaran UMKM</a
          >
        </div>
      </div>
      <!-- Menu 4 -->
      <a
        href="{{ route('kontak.kontak') }}"
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