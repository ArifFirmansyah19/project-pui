// Toggle sidebar
document
    .getElementById("menu-button")
    .addEventListener("click", function() {
        var sidebar = document.getElementById("sidebar");
        var mainContent = document.getElementById("main-content");

        sidebar.classList.toggle("-translate-x-full");

        // Tambahkan atau hilangkan margin pada main content sesuai dengan keadaan sidebar
        if (sidebar.classList.contains("-translate-x-full")) {
            mainContent.classList.remove("ml-64");
        } else {
            mainContent.classList.add("ml-64");
        }
    });

// Toggle submenu profil
document.getElementById("profilSubMenuToggle").onclick = function() {
    var submenu = document.getElementById("profilSubMenu");
    var otherSubmenus = document.querySelectorAll(
        "[id$='SubMenu']:not(#profilSubMenu)"
    );

    // Sembunyikan submenu lainnya
    otherSubmenus.forEach(function(item) {
        item.classList.add("hidden");
    });

    submenu.classList.toggle("hidden");
};

// Toggle submenu sumberdaya
document.getElementById("sumberdayaSubMenuToggle").onclick = function() {
    var submenu = document.getElementById("sumberdayaSubMenu");
    var otherSubmenus = document.querySelectorAll(
        "[id$='SubMenu']:not(#sumberdayaSubMenu)"
    );

    // Sembunyikan submenu lainnya
    otherSubmenus.forEach(function(item) {
        item.classList.add("hidden");
    });

    submenu.classList.toggle("hidden");
};

// Toggle submenu kontak
document.getElementById("kontakSubMenuToggle").onclick = function() {
    var submenu = document.getElementById("kontakSubMenu");
    var otherSubmenus = document.querySelectorAll(
        "[id$='SubMenu']:not(#kontakSubMenu)"
    );

    // Sembunyikan submenu lainnya
    otherSubmenus.forEach(function(item) {
        item.classList.add("hidden");
    });

    submenu.classList.toggle("hidden");
};


// Toggle submenu sumberdaya
document.getElementById("museumSubMenuToggle").onclick = function() {
    var submenu = document.getElementById("museumSubMenu");
    var otherSubmenus = document.querySelectorAll(
        "[id$='SubMenu']:not(#museumSubMenu)"
    );

    // Sembunyikan submenu lainnya
    otherSubmenus.forEach(function(item) {
        item.classList.add("hidden");
    });

    submenu.classList.toggle("hidden");
};

// Toggle profile menu
document.getElementById("profile-menu-button").onclick = function(
    event
) {
    var menu = document.getElementById("profile-menu");
    var otherSubmenus = document.querySelectorAll(
        "[id$='SubMenu']:not(#profile-menu)"
    );

    // Sembunyikan submenu lainnya
    otherSubmenus.forEach(function(item) {
        item.classList.add("hidden");
    });

    menu.classList.toggle("hidden");
    event.stopPropagation(); // Mencegah event berbubungan dengan event klik window
};

// Tutup menu profil jika di-klik di luar area menu
window.onclick = function(event) {
    var menu = document.getElementById("profile-menu");
    if (!event.target.closest("#profile-menu") &&
        !event.target.closest("#profile-menu-button")
    ) {
        if (!menu.classList.contains("hidden")) {
            menu.classList.add("hidden");
        }
    }
};