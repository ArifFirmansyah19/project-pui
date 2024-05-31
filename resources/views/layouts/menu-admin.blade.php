      <!-- Sidebar -->
      <div
        id="sidebar"
        class="fixed inset-y-0 left-0 z-30 w-64 bg-indigo-900 shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out"
      >
        <div class="flex items-center justify-center px-4 py-4">
          <img
            src="../img/logo.png"
            alt="Logo"
            class="h-16 w-auto object-contain mt-4"
          />
        </div>
        <nav class="mt-5 ml-2">
          <a
            href="{{ route('dashboard.admin') }}"
            class="block px-4 py-2 text-sm text-white hover:bg-gray-600"
            >Dashboard</a
          >
          <div class="relative">
            <a
              href="#"
              id="profilSubMenuToggle"
              class="block px-4 py-2 text-sm text-white hover:bg-gray-600 flex items-center"
            >
              Profil <i class="fas fa-caret-down ml-2"></i>
            </a>
            <div id="profilSubMenu" class="ml-4 hidden">
              <a
                href="{{ route('profiladmin.sejarah') }}"
                class="block px-4 py-2 text-sm text-white hover:bg-gray-600"
                >Sejarah</a
              >
              <a
                href="{{ route('profiladmin.visimisi') }}"
                class="block px-4 py-2 text-sm text-white hover:bg-gray-600"
                >Visi Misi</a
              >
              <a
                href="{{ route('profiladmin.struktur-organisasi') }}"
                class="block px-4 py-2 text-sm text-white hover:bg-gray-600"
                >Struktur Organisasi</a
              >
              <a
                href="{{ route('profiladmin.tim') }}"
                class="block px-4 py-2 text-sm text-white hover:bg-gray-600"
                >Tim</a
              >
            </div>
          </div>
          <div class="relative">
            <a
              href="#"
              id="sumberdayaSubMenuToggle"
              class="block px-4 py-2 text-sm text-white hover:bg-gray-600 flex items-center"
            >
              Sumber Daya <i class="fas fa-caret-down ml-2"></i>
            </a>
            <div id="sumberdayaSubMenu" class="ml-4 hidden">
              <a
                href="sdadmin/kegiatan.html"
                class="block px-4 py-2 text-sm text-white hover:bg-gray-600"
                >Artikel</a
              >
              <a
                href="sdadmin/persebaranumkm.html"
                class="block px-4 py-2 text-sm text-white hover:bg-gray-600"
                >Kegiatan</a
              >
              <a
                href="editkontak.html"
                class="block px-4 py-2 text-sm text-white hover:bg-gray-600"
                >Persebaran UMKM</a
              >
            </div>
          </div>
          <div class="relative">
            <a
              href="#"
              id="kontakSubMenuToggle"
              class="block px-4 py-2 text-sm text-white hover:bg-gray-600 flex items-center"
            >
              Kontak <i class="fas fa-caret-down ml-2"></i>
            </a>
            <div id="kontakSubMenu" class="ml-4 hidden">
              <a
                href="#"
                class="block px-4 py-2 text-sm text-white hover:bg-gray-600"
                >Edit Kontak</a
              >
            </div>
          </div>
        </nav>
      </div>

      <!-- Main content -->
      <div
        id="main-content"
        class="flex-1 flex flex-col overflow-hidden transition-transform duration-300 ease-in-out"
      >
        <!-- Header -->
        <nav class="bg-indigo-900 border-b border-gray-200">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
              <div class="flex items-center">
                <button
                  id="menu-button"
                  class="text-white hover:text-gray-400 focus:outline-none"
                  aria-label="Toggle Sidebar"
                >
                  <i class="fas fa-bars fa-lg"></i>
                  <span class="sr-only">Toggle Sidebar</span>
                </button>
              </div>
              <div class="flex items-center ml-3">
                <div class="relative">
                  <!-- Profile Button -->
                  <button
                    id="profile-menu-button"
                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-transparent hover:text-gray-400"
                  >
                    <i
                      class="fas fa-user-circle fa-lg text-white hover:text-gray-400"
                    ></i>
                  </button>
                  <!-- Profile Menu -->
                  <div
                    id="profile-menu"
                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-gray-700 ring-1 ring-black ring-opacity-5 hidden"
                    role="menu"
                    aria-orientation="vertical"
                    aria-labelledby="profile-menu-button"
                  >
                    <a
                      href="#"
                      class="block px-4 py-2 text-sm text-white hover:bg-gray-400"
                      role="menuitem"
                      >Edit</a
                    >
                    <form action="/logout" method="POST" class="block px-4 py-2 text-sm text-white hover:bg-gray-400" role="menuitem">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </nav>
    