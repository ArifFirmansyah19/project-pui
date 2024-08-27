document.addEventListener('DOMContentLoaded', function() {
    // Kode untuk menu bar



    const hamburgerButton = document.getElementById('hamburgerButton');
    const menuDropdown = document.getElementById('menuDropdown');

    // Toggle the dropdown menu when hamburger button is clicked
    hamburgerButton.addEventListener('click', function() {
        menuDropdown.classList.toggle('hidden');
    });

    // Optional: Close the menu if clicking outside of it
    window.addEventListener('click', function(e) {
        if (!hamburgerButton.contains(e.target) && !menuDropdown.contains(e.target)) {
            menuDropdown.classList.add('hidden');
        }
    });





    // Menu dengan submenu di menu bar
    const menuItemsWithSubmenusMobile = document.querySelectorAll("#menuDropdown .relative");

    menuItemsWithSubmenusMobile.forEach((item) => {
        const button = item.querySelector("button");
        const submenu = item.querySelector(".submenu");

        if (button && submenu) {
            button.addEventListener("click", function(event) {
                event.stopPropagation(); // Prevent click event from bubbling up

                const isHidden = submenu.classList.contains("hidden");

                // Close all submenus di menu dropdown
                menuItemsWithSubmenusMobile.forEach((otherItem) => {
                    if (otherItem !== item) {
                        otherItem.querySelector(".submenu").classList.add("hidden");
                    }
                });

                // Toggle visibility of the clicked submenu
                submenu.classList.toggle("hidden", !isHidden);
            });
        } else {
            console.log('Button or submenu not found.');
        }
    });

    document.addEventListener("click", function(event) {
        if (!event.target.closest("#menuDropdown") && !event.target.closest(".hamburger-icon")) {
            menuItemsWithSubmenusMobile.forEach((item) => {
                item.querySelector(".submenu").classList.add("hidden");
            });
        }
    });

    // Kode untuk submenu dengan hover dan timeout
    const menuItems = document.querySelectorAll('.relative');

    menuItems.forEach(menuItem => {
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
            console.log('Menu button or submenu not found.');
        }
    });

    function hideAllSubmenus() {
        const allSubmenus = document.querySelectorAll('.submenu');
        allSubmenus.forEach(submenu => {
            submenu.classList.add('hidden');
        });
    }
    const searchButton = document.getElementById("searchButton");
    const searchBox = document.getElementById("searchBox");
    const searchInput = searchBox.querySelector("input");

    const searchButtonMobile =
        document.getElementById("searchButtonMobile");
    const searchBoxMobile = document.getElementById("searchBoxMobile");
    const searchInputMobile = searchBoxMobile.querySelector("input");

    // Fungsi untuk menampilkan kotak pencarian dan menangani pencarian
    function handleSearch(button, searchBox, searchInput) {
        button.addEventListener("click", function() {
            searchBox.classList.toggle("hidden");
            searchInput.focus();
        });

        searchInput.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                clearHighlights();
                const firstMatchElement = highlightText(
                    document.body,
                    searchInput.value
                );
                if (firstMatchElement) {
                    scrollToElement(firstMatchElement);
                }
            }
        });
    }

    // Panggil fungsi untuk kedua ikon search
    handleSearch(searchButton, searchBox, searchInput);
    handleSearch(searchButtonMobile, searchBoxMobile, searchInputMobile);

    // Fungsi untuk menyorot teks yang dicari
    function highlightText(element, searchTerm) {
        if (!searchTerm) return null;

        const regex = new RegExp(`(${searchTerm})`, "gi");
        const walker = document.createTreeWalker(
            element,
            NodeFilter.SHOW_TEXT,
            null,
            false
        );

        const nodesToReplace = [];

        while (walker.nextNode()) {
            const currentNode = walker.currentNode;

            if (regex.test(currentNode.textContent)) {
                nodesToReplace.push(currentNode);
            }
        }

        let firstMatchElement = null;

        nodesToReplace.forEach((node) => {
            const parent = node.parentNode;
            const highlightedSpan = document.createElement("span");
            highlightedSpan.innerHTML = node.textContent.replace(
                regex,
                "<mark>$1</mark>"
            );
            parent.replaceChild(highlightedSpan, node);

            if (!firstMatchElement) {
                firstMatchElement = highlightedSpan;
            }
        });

        return firstMatchElement;
    }

    // Fungsi untuk menghapus semua sorotan teks
    function clearHighlights() {
        const highlightedElements = document.querySelectorAll("mark");
        highlightedElements.forEach((mark) => {
            const parent = mark.parentNode;
            parent.replaceChild(
                document.createTextNode(mark.textContent),
                mark
            );
            parent.normalize(); // Gabungkan kembali node teks jika perlu
        });
    }

    // Fungsi untuk scroll ke elemen yang di-highlight
    function scrollToElement(element) {
        element.scrollIntoView({
            behavior: "smooth",
            block: "center",
        });
    }






    // Event listener untuk menghapus sorotan ketika klik di luar kotak pencarian
    document.addEventListener("click", function(event) {
        if (!searchBox.contains(event.target) &&
            !searchButton.contains(event.target) &&
            !searchBoxMobile.contains(event.target) &&
            !searchButtonMobile.contains(event.target)
        ) {
            clearHighlights();
        }
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

// dokumentasi
document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelectorAll(".slide");
    const dots = document.querySelectorAll(".dot");
    let currentSlide = 0;

    function showSlide(n) {
        // Validasi indeks n
        if (n >= slides.length || n < 0) return;

        slides.forEach((slide) => slide.classList.add("hidden"));
        dots.forEach((dot) => dot.classList.remove("bg-indigo-600"));
        slides[n].classList.remove("hidden");
        dots[n].classList.add("bg-indigo-600");
        currentSlide = n;
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    setInterval(nextSlide, 4000); // Ganti slide setiap 4 detik

    dots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            showSlide(index);
        });
    });

    showSlide(0); // Tampilkan slide pertama saat halaman dimuat
});

//komen
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("commentModal");
    const closeModalBtn = document.getElementById("closeModal");
    let currentArticleId = null;

    // Object to store comments in session memory
    const sessionComments = {};

    document.querySelectorAll(".commentBtn").forEach(function(btn) {
        btn.addEventListener("click", function() {
            currentArticleId = btn.getAttribute("data-article-id");
            const modalContent = document.getElementById("modalContent");

            // Fetch comments for the current article from session memory
            fetchComments(currentArticleId, modalContent);

            modal.classList.remove("hidden");

            // Handle comment submission
            modalContent.querySelector(".submitComment").addEventListener("click", function() {
                const commentText = modalContent.querySelector("textarea").value;
                const commentName = modalContent.querySelector("input").value;
                const commentsContainer = modalContent.querySelector(".comments");

                if (commentText && commentName) {
                    const commentId = Date.now().toString(); // Generate unique ID
                    const commentItem = createCommentItem(commentId, commentName, commentText, currentArticleId);
                    commentsContainer.appendChild(commentItem);

                    // Clear input fields
                    modalContent.querySelector("textarea").value = "";
                    modalContent.querySelector("input").value = "";

                    // Save comment in session memory
                    saveCommentInSession(currentArticleId, commentId, commentName, commentText);

                    handleReplyButtonClick(commentItem);
                    updateCommentCount(currentArticleId);
                }
            });
        });
    });

    function createCommentItem(commentId, name, text, articleId, parentId = null) {
        const commentItem = document.createElement("div");
        commentItem.classList.add("comment-item", "border-t", "border-gray-300", "mt-2", "pt-2");
        if (parentId) {
            commentItem.classList.add("ml-8"); // Indent for replies
        }
        commentItem.setAttribute("data-comment-id", commentId);
        commentItem.setAttribute("data-article-id", articleId);
        commentItem.innerHTML = `
                <strong>${name}</strong>: ${text}
                <button class="replyBtn text-blue-400 hover:underline text-sm ml-2">Reply</button>
                <div class="replies mt-2"></div>
            `;
        return commentItem;
    }

    function fetchComments(articleId, container) {
        // Clear previous comments
        container.innerHTML = `
                <textarea class="w-full p-2 mb-2 text-gray-800 border border-gray-300 rounded-md" rows="3" placeholder="Tulis komentar anda..."></textarea>
                <input type="text" class="w-full p-2 mb-2 text-gray-800 border border-gray-300 rounded-md" placeholder="Nama">
                <button class="submitComment text-white bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-700">Submit</button>
                <div class="comments mt-4 text-sm text-gray-700"></div>
            `;

        // Load comments from session memory
        const comments = sessionComments[articleId] || [];
        const commentsContainer = container.querySelector(".comments");
        const commentItems = {};

        comments.forEach(comment => {
            const commentItem = createCommentItem(comment.id, comment.name, comment.text, articleId, comment.parentId);
            commentItems[comment.id] = commentItem;

            if (comment.parentId) {
                const parentComment = commentItems[comment.parentId];
                parentComment.querySelector(".replies").appendChild(commentItem);
            } else {
                commentsContainer.appendChild(commentItem);
            }

            handleReplyButtonClick(commentItem);
        });
    }

    function saveCommentInSession(articleId, commentId, name, text, parentId = null) {
        // Initialize comments array for the article if not exists
        if (!sessionComments[articleId]) {
            sessionComments[articleId] = [];
        }
        // Add the new comment to session memory
        sessionComments[articleId].push({ id: commentId, name, text, parentId });
    }

    function handleReplyButtonClick(commentItem) {
        commentItem.querySelector(".replyBtn").addEventListener("click", function() {
            const replyForm = document.createElement("div");
            replyForm.classList.add("mt-4", "bg-gray-200", "p-4", "rounded-md", "ml-8");
            replyForm.innerHTML = `
                    <textarea class="w-full p-2 mb-2 text-gray-800 border border-gray-300 rounded-md" rows="2" placeholder="tulis balasan..."></textarea>
                    <input type="text" class="w-full p-2 mb-2 text-gray-800 border border-gray-300 rounded-md" placeholder="Nama">
                    <button class="submitReply text-white bg-green-600 px-4 py-2 rounded-md hover:bg-green-700">Submit</button>
                `;

            commentItem.querySelector(".replies").appendChild(replyForm);

            replyForm.querySelector(".submitReply").addEventListener("click", function() {
                const replyText = replyForm.querySelector("textarea").value;
                const replyName = replyForm.querySelector("input").value;

                if (replyText && replyName) {
                    const replyId = Date.now().toString(); // Generate unique ID
                    const replyItem = createCommentItem(replyId, replyName, replyText, commentItem.getAttribute("data-article-id"), commentItem.getAttribute("data-comment-id"));
                    commentItem.querySelector(".replies").appendChild(replyItem);

                    replyForm.querySelector("textarea").value = "";
                    replyForm.querySelector("input").value = "";
                    replyForm.remove();

                    // Save reply in session memory
                    saveCommentInSession(commentItem.getAttribute("data-article-id"), replyId, replyName, replyText, commentItem.getAttribute("data-comment-id"));
                    updateCommentCount(commentItem.getAttribute("data-article-id"));
                    handleReplyButtonClick(replyItem);
                }
            });
        });
    }

    function updateCommentCount(articleId) {
        const commentCountElement = document.querySelector(`.commentCount[data-article-id="${articleId}"]`);
        if (commentCountElement) {
            const comments = sessionComments[articleId] || [];
            commentCountElement.textContent = comments.length;
        }
    }

    closeModalBtn.addEventListener("click", function() {
        modal.classList.add("hidden");
    });
});

modal.classList.remove("hidden");
modal.classList.add("flex");

//komen detailartikel
document.addEventListener("DOMContentLoaded", function() {
    const addCommentBtn = document.getElementById("addCommentBtn");
    const commentSection = document.getElementById("commentSection");
    let comments = [];

    addCommentBtn.addEventListener("click", function(event) {
        event.preventDefault();

        const namaInput = document.getElementById("nama").value.trim();
        const commentInput = document.getElementById("newComment").value.trim();

        if (namaInput === "" || commentInput === "") {
            alert("Nama dan komentar harus diisi.");
            return;
        }

        const newComment = {
            id: generateId(),
            nama: namaInput,
            comment: commentInput,
            replies: []
        };

        comments.push(newComment);
        displayComments();
        document.getElementById("nama").value = "";
        document.getElementById("newComment").value = "";
    });

    function displayComments() {
        commentSection.innerHTML = "";
        comments.forEach(comment => {
            const commentHTML = createCommentHTML(comment);
            commentSection.appendChild(commentHTML);
        });
    }

    function createCommentHTML(comment) {
        const commentElement = document.createElement("div");
        commentElement.classList.add("bg-gray-200", "rounded-lg", "p-3", "mb-2");

        const namaParagraph = document.createElement("p");
        namaParagraph.classList.add("text-sm", "font-medium", "text-gray-700");
        namaParagraph.textContent = comment.nama;
        commentElement.appendChild(namaParagraph);

        const commentParagraph = document.createElement("p");
        commentParagraph.classList.add("text-sm", "text-gray-800");
        commentParagraph.textContent = comment.comment;
        commentElement.appendChild(commentParagraph);

        const replyBtn = document.createElement("button");
        replyBtn.classList.add("replyBtn", "text-sm", "text-indigo-600", "hover:underline");
        replyBtn.textContent = "Balas";
        commentElement.appendChild(replyBtn);

        const replyForm = document.createElement("div");
        replyForm.classList.add("replyForm", "hidden", "mt-2");

        const nameLabel = document.createElement("label");
        nameLabel.classList.add("block", "text-sm", "font-medium", "text-gray-700");
        nameLabel.textContent = "Nama:";
        replyForm.appendChild(nameLabel);

        const replyNameInput = document.createElement("input");
        replyNameInput.classList.add("replyNama", "w-full", "p-2", "border", "border-gray-300", "rounded", "mb-2");
        replyNameInput.setAttribute("type", "text");
        replyForm.appendChild(replyNameInput);

        const commentLabel = document.createElement("label");
        commentLabel.classList.add("block", "text-sm", "font-medium", "text-gray-700");
        commentLabel.textContent = "Balasan:";
        replyForm.appendChild(commentLabel);

        const replyTextInput = document.createElement("textarea");
        replyTextInput.classList.add("replyText", "w-full", "p-2", "border", "border-gray-300", "rounded", "mb-2");
        replyForm.appendChild(replyTextInput);

        const submitReplyBtn = document.createElement("button");
        submitReplyBtn.classList.add("bg-indigo-800", "text-white", "px-4", "py-2", "rounded", "hover:bg-indigo-500", "reply-submit-btn");
        submitReplyBtn.textContent = "Kirim Balasan";
        replyForm.appendChild(submitReplyBtn);

        commentElement.appendChild(replyForm);

        const repliesContainer = document.createElement("div");
        repliesContainer.classList.add("replies-container");
        comment.replies.forEach(reply => {
            const replyHTML = createCommentHTML(reply);
            repliesContainer.appendChild(replyHTML);
        });
        commentElement.appendChild(repliesContainer);

        replyBtn.addEventListener("click", function() {
            replyForm.classList.toggle("hidden");
        });

        submitReplyBtn.addEventListener("click", function() {
            const replyName = replyNameInput.value.trim();
            const replyText = replyTextInput.value.trim();



            const newReply = {
                nama: replyName,
                comment: replyText,
                replies: []
            };

            comment.replies.push(newReply);
            displayComments();
            replyNameInput.value = "";
            replyTextInput.value = "";
        });

        return commentElement;
    }

    function generateId() {
        return Math.random().toString(36).substr(2, 9);
    }
});


/*menubar*/



/*komen di kegiatan*/