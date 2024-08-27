<nav class="bg-indigo-900 py-4 fixed-navbar w-full top-0 z-50">
    <div class="mx-auto flex justify-between items-center">
        <!-- Logo di sebelah kiri -->
        <div class="flex items-center">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-16 h-auto ml-8" />
        </div>

        <!-- Menu untuk layar besar -->
        <div class="hidden lg:flex flex-col lg:flex-row justify-center items-center space-x-6" id="menu">
            <!-- Menu 1 -->
            <a href="/" class="menu-item text-white hover:text-gray-300 font-medium">
                Beranda
            </a>
            <!-- Menu 2 -->
            <div class="relative">
                <button class="menu-item text-white hover:text-gray-300 focus:outline-none font-medium">
                    Profil
                    <i class="fas fa-caret-down ml-1" style="color: white"></i>
                </button>
                <!-- Submenu Menu 2 -->
                <div class="submenu absolute left-0 mt-2 w-48 bg-indigo-900 shadow-lg rounded-lg py-2 hidden">
                    <a href="{{ route('sejarah') }}" class="block px-4 py-2 text-white hover:bg-gray-700">Sejarah</a>
                    <a href="{{ route('visimisi') }}" class="block px-4 py-2 text-white hover:bg-gray-700">Visi
                        Misi</a>
                    <a href="{{ route('struktur-organisasi') }}"
                        class="block px-4 py-2 text-white hover:bg-gray-700">Struktur Organisasi</a>
                    <a href="{{ route('tim') }}" class="block px-4 py-2 text-white hover:bg-gray-700">Tim</a>
                </div>
            </div>
            <!-- Menu 3 -->
            <div class="relative">
                <button class="menu-item text-white hover:text-gray-300 focus:outline-none font-medium border-b-2">
                    Sumber Daya
                    <i class="fas fa-caret-down ml-1" style="color: white"></i>
                </button>
                <!-- Submenu Menu 3 -->
                <div class="submenu absolute left-0 mt-2 w-48 bg-indigo-900 shadow-lg rounded-lg py-2 hidden">
                    <a href="{{ route('artikel') }}" class="block px-4 py-2 text-white hover:bg-gray-700">Artikel</a>
                    <a href="{{ route('kegiatan') }}" class="block px-4 py-2 text-white hover:bg-gray-700">Kegiatan</a>
                    <a href="{{ route('peta-persebaran') }}"
                        class="block px-4 py-2 text-white hover:bg-gray-700">Persebaran UMKM</a>
                </div>
            </div>
            <!-- Menu 4 -->
            <a href="{{ route('museum') }}" class="menu-item text-white hover:text-gray-300 font-medium">
                Museum Digital
            </a>
            <a href="#contact" class="menu-item text-white hover:text-gray-300 font-medium">
                Kontak
            </a>
        </div>

        <!-- Ikon search untuk layar besar -->
        <div class="search-icon mr-10 hidden lg:flex">
            <button class="text-white hover:text-gray-300 focus:outline-none" id="searchButton">
                <i class="fas fa-search text-lg"></i>
            </button>
            <!-- Kotak penelusuran -->
            <div id="searchBox" class="absolute top-5 right-1 mt-10 bg-white rounded-lg shadow-md px-4 py-2 hidden">
                <input type="text"
                    class="border border-gray-300 px-2 py-1 rounded-lg focus:outline-none focus:border-blue-500"
                    placeholder="Cari..." />
            </div>
        </div>

        <!-- Ikon menu hamburger -->
        <div class="hamburger-icon mr-10 lg:hidden">
            <button class="text-white hover:text-gray-300 focus:outline-none" id="hamburgerButton">
                <i class="fas fa-bars text-lg"></i>
            </button>
        </div>
    </div>

    <!-- Menu dropdown untuk layar kecil -->
    <div id="menuDropdown" class="hidden lg:hidden flex-col mt-4 space-y-2">
        <!-- Menu Items -->
        <a href="/" class="menu-item text-white hover:text-gray-300 font-medium pl-4">
            Beranda
        </a>
        <div class="relative pl-4">
            <button class="menu-item text-white hover:text-gray-300 focus:outline-none font-medium">
                Profil
                <i class="fas fa-caret-down ml-1" style="color: white"></i>
            </button>
            <div class="submenu mt-2 bg-indigo-900 shadow-lg rounded-lg py-2 hidden">
                <a href="{{ route('sejarah') }}" class="block px-4 py-2 text-white hover:bg-gray-700">
                    Sejarah
                </a>
                <a href="{{ route('visimisi') }}" class="block px-4 py-2 text-white hover:bg-gray-700">
                    Visi Misi
                </a>
                <a href="{{ route('struktur-organisasi') }}" class="block px-4 py-2 text-white hover:bg-gray-700">
                    Struktur Organisasi
                </a>
                <a href="{{ route('tim') }}" class="block px-4 py-2 text-white hover:bg-gray-700">Tim</a>
            </div>
        </div>
        <div class="relative pl-4">
            <button class="menu-item text-white hover:text-gray-300 focus:outline-none font-medium">
                Sumber Daya
                <i class="fas fa-caret-down ml-1" style="color: white"></i>
            </button>
            <div class="submenu mt-2 bg-indigo-900 shadow-lg rounded-lg py-2 hidden">
                <a href="{{ route('artikel') }}" class="block px-4 py-2 text-white hover:bg-gray-700">
                    Artikel
                </a>
                <a href="{{ route('kegiatan') }}" class="block px-4 py-2 text-white hover:bg-gray-700">
                    Kegiatan
                </a>
                <a href="{{ route('peta-persebaran') }}" class="block px-4 py-2 text-white hover:bg-gray-700">
                    Persebaran UMKM
                </a>
            </div>
        </div>
        <div class="relative pl-4">
            <a href="{{ route('museum') }}" class="menu-item text-white hover:text-gray-300 font-medium">
                Museum Digital
            </a>
        </div>
        <div class="relative pl-4">
            <a href="#contact" class="menu-item text-white hover:text-gray-300 font-medium">
                Kontak
            </a>
        </div>

        <!-- Ikon search di menu hamburger -->
        <div class="search-icon mt-4 pl-4">
            <button class="text-white hover:text-gray-300 focus:outline-none" id="searchButtonMobile">
                <i class="fas fa-search text-lg"></i>
            </button>
            <!-- Kotak penelusuran -->
            <div id="searchBoxMobile" class="bg-white rounded-lg shadow-md px-4 py-2 hidden">
                <input type="text"
                    class="border border-gray-300 px-2 py-1 rounded-lg focus:outline-none focus:border-blue-500"
                    placeholder="Cari..." />
            </div>
        </div>
    </div>
</nav>
