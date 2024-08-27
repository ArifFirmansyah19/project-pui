document.addEventListener('DOMContentLoaded', function() {
    // Ambil semua elemen menu dan submenu
    const menuItems = document.querySelectorAll('.relative');

    // Loop melalui setiap elemen menu
    menuItems.forEach(menuItem => {
        const menuButton = menuItem.querySelector('button');
        const submenu = menuItem.querySelector('.submenu');
        let timeoutId;

        // Tambahkan event listener untuk menampilkan submenu saat tombol menu dihover
        menuButton.addEventListener('mouseenter', function() {
            // Sembunyikan semua submenu terlebih dahulu
            hideAllSubmenus();
            // Tampilkan submenu yang sesuai
            submenu.classList.remove('hidden');
        });

        // Tambahkan event listener untuk menyembunyikan submenu saat kursor meninggalkan area menu
        menuItem.addEventListener('mouseleave', function() {
            // Tetapkan penundaan sebelum menyembunyikan submenu
            timeoutId = setTimeout(function() {
                // Sembunyikan submenu setelah penundaan
                submenu.classList.add('hidden');
            }, 300); // Ubah angka ini untuk menyesuaikan dengan kebutuhan Anda
        });

        // Batalkan penundaan jika kursor kembali ke menu sebelum submenu disembunyikan
        submenu.addEventListener('mouseenter', function() {
            clearTimeout(timeoutId);
        });
    });

    // Fungsi untuk menyembunyikan semua submenu
    function hideAllSubmenus() {
        const allSubmenus = document.querySelectorAll('.submenu');
        allSubmenus.forEach(submenu => {
            submenu.classList.add('hidden');
        });
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const searchButton = document.getElementById('searchButton');
    const searchBox = document.getElementById('searchBox');
    let searchTimeout;

    searchButton.addEventListener('mouseenter', function() {
        clearTimeout(searchTimeout);
        searchBox.classList.remove('hidden');
    });

    searchButton.addEventListener('mouseleave', function() {
        // Jeda sebelum menyembunyikan kotak penelusuran
        searchTimeout = setTimeout(function() {
            searchBox.classList.add('hidden');
        }, 500); // Ubah angka ini sesuai dengan kebutuhan Anda
    });

    searchBox.addEventListener('mouseenter', function() {
        clearTimeout(searchTimeout);
    });

    searchBox.addEventListener('mouseleave', function() {
        searchBox.classList.add('hidden');
    });
});

// Ambil semua elemen menu
const menuItems = document.querySelectorAll('.menu-item');

// Tambahkan event listener untuk setiap menu item
menuItems.forEach(item => {
    item.addEventListener('click', function() {
        // Hapus kelas 'selected' dari semua menu item
        menuItems.forEach(menuItem => {
            menuItem.classList.remove('selected');
        });

        // Tambahkan kelas 'selected' ke menu item yang dipilih
        this.classList.add('selected');
    });
});