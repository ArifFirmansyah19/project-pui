<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> @yield('title') </title>
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
  </head>
  <body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
      @include('layouts.menu-admin')
      @yield('content-admin')
     </div>
    </div>
    <script>
      // Toggle sidebar
        document
          .getElementById("menu-button")
          .addEventListener("click", function () {
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
        document.getElementById("profilSubMenuToggle").onclick = function () {
          var submenu = document.getElementById("profilSubMenu");
          var otherSubmenus = document.querySelectorAll(
            "[id$='SubMenu']:not(#profilSubMenu)"
          );
      
          // Sembunyikan submenu lainnya
          otherSubmenus.forEach(function (item) {
            item.classList.add("hidden");
          });
      
          submenu.classList.toggle("hidden");
        };
      
        // Toggle submenu sumberdaya
        document.getElementById("sumberdayaSubMenuToggle").onclick = function () {
          var submenu = document.getElementById("sumberdayaSubMenu");
          var otherSubmenus = document.querySelectorAll(
            "[id$='SubMenu']:not(#sumberdayaSubMenu)"
          );
      
          // Sembunyikan submenu lainnya
          otherSubmenus.forEach(function (item) {
            item.classList.add("hidden");
          });
      
          submenu.classList.toggle("hidden");
        };
      
        // Toggle submenu kontak
        document.getElementById("kontakSubMenuToggle").onclick = function () {
          var submenu = document.getElementById("kontakSubMenu");
          var otherSubmenus = document.querySelectorAll(
            "[id$='SubMenu']:not(#kontakSubMenu)"
          );
      
          // Sembunyikan submenu lainnya
          otherSubmenus.forEach(function (item) {
            item.classList.add("hidden");
          });
      
          submenu.classList.toggle("hidden");
        };
      
        // Toggle profile menu
        document.getElementById("profile-menu-button").onclick = function (
          event
        ) {
          var menu = document.getElementById("profile-menu");
          var otherSubmenus = document.querySelectorAll(
            "[id$='SubMenu']:not(#profile-menu)"
          );
      
          // Sembunyikan submenu lainnya
          otherSubmenus.forEach(function (item) {
            item.classList.add("hidden");
          });
      
          menu.classList.toggle("hidden");
          event.stopPropagation(); // Mencegah event berbubungan dengan event klik window
        };
      
        // Tutup menu profil jika di-klik di luar area menu
        window.onclick = function (event) {
          var menu = document.getElementById("profile-menu");
          if (
            !event.target.closest("#profile-menu") &&
            !event.target.closest("#profile-menu-button")
          ) {
            if (!menu.classList.contains("hidden")) {
              menu.classList.add("hidden");
            }
          }
        };
      </script>
      {{-- <script src="../js/jsadmin.js"></script> --}}
  </body>
</html>