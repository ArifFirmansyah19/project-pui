document.addEventListener('DOMContentLoaded', function() {
    // Kode untuk menu bar

    const hamburgerButton = document.getElementById('hamburgerButton');
    const menuDropdown = document.getElementById('menuDropdown');

    // Toggle dropdown menu ketika tombol hamburger diklik
    if (hamburgerButton && menuDropdown) {
        hamburgerButton.addEventListener('click', function() {
            menuDropdown.classList.toggle('hidden');
        });

        // Tutup menu jika klik di luar
        window.addEventListener('click', function(e) {
            if (!hamburgerButton.contains(e.target) && !menuDropdown.contains(e.target)) {
                menuDropdown.classList.add('hidden');
            }
        });
    } else {
        console.error('Hamburger button or menu dropdown not found.');
    }

    // Menu dengan submenu di menu bar untuk mobile
    const menuItemsWithSubmenusMobile = document.querySelectorAll("#menuDropdown .relative");

    menuItemsWithSubmenusMobile.forEach((item) => {
        const button = item.querySelector("button");
        const submenu = item.querySelector(".submenu");

        if (button && submenu) {
            button.addEventListener("click", function(event) {
                event.stopPropagation(); // Prevent click event from bubbling up

                const isHidden = submenu.classList.contains("hidden");

                // Tutup semua submenu di menu dropdown
                menuItemsWithSubmenusMobile.forEach((otherItem) => {
                    if (otherItem !== item) {
                        otherItem.querySelector(".submenu").classList.add("hidden");
                    }
                });

                // Toggle visibility of the clicked submenu
                submenu.classList.toggle("hidden", !isHidden);
            });
        } else {
            console.error('Button or submenu not found in mobile menu.');
        }
    });


    // Kode untuk submenu dengan hover dan timeout (untuk desktop)
    const menuItemsHover = document.querySelectorAll('.relative');

    menuItemsHover.forEach(menuItem => {
        const menuButton = menuItem.querySelector('button');
        const submenu = menuItem.querySelector('.submenu');
        let timeoutId;

        if (menuButton && submenu) {
            menuButton.addEventListener('mouseenter', function() {
                hideAllSubmenus();
                submenu.classList.remove('hidden');
            });

            menuItem.addEventListener('mouseleave', function() {
                timeoutId = setTimeout(function() {
                    submenu.classList.add('hidden');
                }, 300);
            });

            submenu.addEventListener('mouseenter', function() {
                clearTimeout(timeoutId);
            });
        } else {
            console.error('Menu button or submenu not found in hover menu.');
        }
    });

    function hideAllSubmenus() {
        const allSubmenus = document.querySelectorAll('.submenu');
        allSubmenus.forEach(submenu => {
            submenu.classList.add('hidden');
        });
    }


});