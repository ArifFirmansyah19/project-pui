document
    .getElementById("menu-button")
    .addEventListener("click", function() {
        var sidebar = document.getElementById("sidebar");
        var mainContent = document.getElementById("main-content");

        // Toggle sidebar visibility
        sidebar.classList.toggle("-translate-x-full");

        // Check screen width
        if (window.innerWidth >= 1024) {
            // For screens larger than or equal to 1024px
            if (sidebar.classList.contains("-translate-x-full")) {
                mainContent.classList.remove("lg:ml-64");
            } else {
                mainContent.classList.add("lg:ml-64");
            }
        } else {
            // For screens smaller than 1024px
            if (sidebar.classList.contains("-translate-x-full")) {
                mainContent.style.marginLeft = "0"; // Remove margin for smaller screens
                sidebar.style.transform = "translateX(-100%)"; // Hide sidebar
            } else {
                sidebar.style.transform = "translateX(0)"; // Show sidebar
                mainContent.style.marginLeft = "16rem"; // Equivalent to 64 (rem)
            }
        }
    });




// Toggle submenu profil
document
    .getElementById("profile-menu-button")
    .addEventListener("click", function() {
        var profileMenu = document.getElementById("profile-menu");

        // Toggle kelas 'hidden' untuk menampilkan atau menyembunyikan submenu
        profileMenu.classList.toggle("hidden");
    });

// Tutup submenu saat klik di luar
document.addEventListener("click", function(event) {
    var profileMenu = document.getElementById("profile-menu");
    var profileButton = document.getElementById("profile-menu-button");

    // Cek apakah klik terjadi di luar area profile menu atau profile button
    if (!profileButton.contains(event.target) && !profileMenu.contains(event.target)) {
        // Tutup profile menu jika terbuka
        if (!profileMenu.classList.contains("hidden")) {
            profileMenu.classList.add("hidden");
        }
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

// Toggle submenu sumber daya
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

// Function to set profile image if available
function setProfileImage(imageSrc) {
    var profileImage = document.getElementById("profile-image");
    var profileIcon = document.getElementById("profile-icon");

    if (imageSrc && imageSrc.trim() !== "") {
        profileImage.src = imageSrc; // Set the image source
        profileImage.classList.remove("hidden"); // Show the image
        profileIcon.style.display = "none"; // Hide the icon completely
    } else {
        profileImage.classList.add("hidden"); // Ensure the image is hidden
        profileIcon.style.display = "block"; // Show the icon
    }
}

// Example usage: Set the image path or leave it empty
setProfileImage("../../img/angt/pas2.jpg"); // Replace with your image path or keep it empty


document.getElementById("delete-button").addEventListener("click", function() {
    // Tampilkan dialog konfirmasi
    var confirmed = confirm("Apakah Anda yakin ingin menghapus item ini?");

    if (confirmed) {
        // Jika pengguna mengonfirmasi, tampilkan notifikasi atau lakukan aksi hapus
        alert("Item telah dihapus.");
    } else {
        // Jika pengguna membatalkan, tidak lakukan apa-apa
        alert("Penghapusan dibatalkan.");
    }
});
// dokumentasi
document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelectorAll(".slide");
    const dots = document.querySelectorAll(".dot");
    let currentSlide = 0;

    function showSlide(n) {
        slides.forEach((slide) => slide.classList.add("hidden"));
        dots.forEach((dot) => dot.classList.remove("bg-indigo-600"));
        slides[n].classList.remove("hidden");
        dots[n].classList.add("bg-indigo-600");
        currentSlide = n;
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
        setActiveDot(currentSlide);
    }

    setInterval(nextSlide, 4000); // Ganti slide setiap 20 detik

    dots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            showSlide(index);
            setActiveDot(index);
        });
    });

    function setActiveDot(index) {
        dots.forEach((dot) => dot.classList.remove("bg-indigo-600"));
        dots[index].classList.add("bg-indigo-600");
    }

    showSlide(0); // Tampilkan slide pertama saat halaman dimuat
});