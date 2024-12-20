<!-- Sidebar -->
<div id="sidebar"
    class="fixed inset-y-0 left-0 z-30 w-64 bg-indigo-900 shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out">
    <div class="flex items-center justify-center px-4 py-4">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-24 w-auto object-contain mt-4" />
    </div>
    <nav class="mt-8 ml-2">
        <a href="{{ route('dashboard.admin') }}"
            class="block px-4 py-2 text-md text-white hover:bg-gray-600">Dashboard</a>
        <div class="relative">
            <a href="#" id="profilSubMenuToggle"
                class="block px-4 py-2 text-md text-white hover:bg-gray-600 items-center">
                Profil <i class="fas fa-caret-down ml-2"></i>
            </a>
            <div id="profilSubMenu" class="ml-4 hidden">
                <a href="{{ route('admin.sejarah') }}"
                    class="block px-4 py-2 text-sm text-white hover:bg-gray-600">Sejarah</a>
                <a href="{{ route('admin.visimisi') }}"
                    class="block px-4 py-2 text-sm text-white hover:bg-gray-600">Visi Misi</a>
                <a href="{{ route('admin.SO') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-600">Struktur
                    Organisasi</a>
                <a href="{{ route('admin.tim') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-600">Tim</a>
            </div>
        </div>
        <div class="relative">
            <a href="#" id="sumberdayaSubMenuToggle"
                class="block px-4 py-2 text-md text-white hover:bg-gray-600 items-center">
                Sumber Daya <i class="fas fa-caret-down ml-2"></i>
            </a>
            <div id="sumberdayaSubMenu" class="ml-4 hidden">
                <a href="{{ route('admin.artikel') }}"
                    class="block px-4 py-2 text-sm text-white hover:bg-gray-600">Artikel</a>
                <a href="{{ route('admin.HKI') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-600">HKI</a>

                <a href="{{ route('admin.kegiatan') }}"
                    class="block px-4 py-2 text-sm text-white hover:bg-gray-600">Kegiatan</a>
                <a href="{{ route('admin.persebaran') }}"
                    class="block px-4 py-2 text-sm text-white hover:bg-gray-600">Persebaran UMKM</a>
            </div>
        </div>

        <a href="{{ route('admin.museum') }}"
            class="block px-4 py-2 text-md text-white hover:bg-gray-600 items-center">
            Museum
        </a>

        <div class="relative">
            <a href="#" id="kontakSubMenuToggle"
                class="block px-4 py-2 text-md text-white hover:bg-gray-600 items-center">
                Kontak <i class="fas fa-caret-down ml-2"></i>
            </a>
            <div id="kontakSubMenu" class="ml-4 hidden">
                <a href="{{ route('admin.kontak') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-600">Edit
                    Kontak</a>
            </div>
        </div>

    </nav>
</div>

<!-- Main content -->
<div id="main-content" class="flex-1 flex flex-col overflow-hidden transition-all duration-300 ease-in-out bg-gray-100">
    <!-- Header -->
    <nav class="bg-indigo-50 border-b border-gray-200 shadow-2xl">
        <div class="w-full sm:px-10 lg:px-4">
            <div class="flex justify-between h-16 px-4">
                <!-- Tombol toggle sidebar di sebelah kiri -->
                <div class="flex items-center">
                    <button id="menu-button" class="text-indigo-900 hover:text-gray-400 focus:outline-none"
                        aria-label="Toggle Sidebar">
                        <i class="fas fa-bars fa-lg"></i>
                        <span class="sr-only">Toggle Sidebar</span>
                    </button>
                </div>
                <div class="flex items-center ml-3">
                    <div class="relative">
                        <!-- Profile Button -->
                        <button id="profile-menu-button">
                            <div class="relative mt-4">
                                @if (Auth::user()->foto)
                                    <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                                        alt="{{ Auth::user()->name }}"
                                        class="h-10 w-10 object-cover rounded-full mx-auto mb-4" />
                                @else
                                    <div
                                        class="h-10 w-10 flex items-center justify-center bg-indigo-500 text-white rounded-full mx-auto mb-4 text-3xl">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                @endif
                                <span
                                    class="top-0 left-7 absolute  w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                            </div>
                        </button>

                        <!-- Profile Menu -->
                        <div id="profile-menu"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-gray-700 ring-1 ring-black ring-opacity-5 hidden"
                            role="menu" aria-orientation="vertical" aria-labelledby="profile-menu-button">
                            <a href="{{ route('dashboard.editprofil') }}"
                                class="block px-4 py-2 text-sm text-white hover:bg-gray-400" role="menuitem">Edit</a>
                            <form action="{{ route('logout') }}" method="POST" id="logoutForm"
                                class="block px-4 py-2 text-sm text-white hover:bg-gray-400" role="menuitem">
                                @csrf
                                <button id="logoutButton" type="submit">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>



    <script>
        document.getElementById('logoutButton').addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Anda akan keluar dari akses sebagai admin!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yakin!',
                cancelButtonText: 'Batalkan',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logoutForm').submit();
                }
            });
        });
    </script>
