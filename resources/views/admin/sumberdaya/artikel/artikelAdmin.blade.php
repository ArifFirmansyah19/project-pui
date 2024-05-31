<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Artikel admin</title>
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
      <!-- Sidebar -->
      @include('layouts.sidebar-admin')

      <!-- Main content -->
      <div
        id="main-content"
        class="flex-1 flex flex-col overflow-y-auto transition-transform duration-100 ease-in-out"
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
                    <a
                      href="#"
                      class="block px-4 py-2 text-sm text-white hover:bg-gray-400"
                      role="menuitem"
                      >Logout</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </nav>
        <!-- Content -->
        <main class="flex-1 bg-gray-100 p-4 sm:p-6">
          <div
            id="content"
            class="transition-transform duration-500 ease-in-out"
          >
            <h1 class="text-4xl font-bold text-indigo-900 mb-8 mt-20">
              Artikel
            </h1>

            <!-- Artikel 1 -->
            <div class="mb-8">
              <a
                href="detail_artikel_1.html"
                class="block text-xl font-semibold text-indigo-900 mb-0"
                >Judul Artikel 1</a
              >
              <p class="text-sm text-gray-500 mb-2">01 April 2024</p>
              <p class="text-gray-800 leading-relaxed">
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy
                text ever since the 1500s, when an unknown printer took a galley
                of type and scrambled it to make a type specimen book..
              </p>

              <!-- Edit and Delete Buttons -->
              <div class="flex justify-end mt-4">
                <button class="mx-2 text-gray-600 hover:text-gray-900">
                  <i class="fas fa-edit"></i>
                </button>
                <button class="mx-2 text-gray-600 hover:text-gray-900">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </div>

            <hr class="border-gray-800 my-1" />

            <!-- Artikel 2 -->
            <div class="mb-8">
              <a
                href="detail_artikel_2.html"
                class="block text-xl font-semibold text-indigo-900 mb-2"
                >Judul Artikel 2</a
              >
              <p class="text-sm text-gray-500 mb-2">01 April 2024</p>
              <p class="text-gray-800 leading-relaxed">
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy
                text ever since the 1500s, when an unknown printer took a galley
                of type and scrambled it to make a type specimen book.
              </p>
              <!-- Edit and Delete Buttons -->
              <div class="flex justify-end mt-4">
                <button class="mx-2 text-gray-600 hover:text-gray-900">
                  <i class="fas fa-edit"></i>
                </button>
                <button class="mx-2 text-gray-600 hover:text-gray-900">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </div>
            <hr class="border-gray-800 my-1" />

            <!-- Artikel 3 -->
            <div class="mb-8">
              <a
                href="detail_artikel_3.html"
                class="block text-xl font-semibold text-indigo-900 mb-2"
                >Judul Artikel 3</a
              >
              <p class="text-sm text-gray-500 mb-2">01 April 2024</p>
              <p class="text-gray-800 leading-relaxed">
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy
                text ever since the 1500s, when an unknown printer took a galley
                of type and scrambled it to make a type specimen book.
              </p>

              <!-- Tombol Edit dan Delete -->
              <div class="flex justify-end mt-4">
                <button class="mx-2 text-gray-600 hover:text-gray-900">
                  <i class="fas fa-edit"></i>
                </button>
                <button class="mx-2 text-gray-600 hover:text-gray-900">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </div>
            <hr class="border-gray-800 my-1" />
            <!-- Artikel 4 -->
            <div class="mb-8">
              <a
                href="detail_artikel_4.html"
                class="block text-xl font-semibold text-indigo-900 mb-2"
                >Judul Artikel 4</a
              >
              <p class="text-sm text-gray-500 mb-2">01 April 2024</p>
              <p class="text-gray-800 leading-relaxed">
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy
                text ever since the 1500s, when an unknown printer took a galley
                of type and scrambled it to make a type specimen book.
              </p>
              <!-- Edit and Delete Buttons -->
              <div class="flex justify-end mt-4">
                <button class="mx-2 text-gray-600 hover:text-gray-900">
                  <i class="fas fa-edit"></i>
                </button>
                <button class="mx-2 text-gray-600 hover:text-gray-900">
                  <i class="fas fa-trash"></i>
                </button>
              </div>
            </div>
            <hr class="border-gray-800 my-1" />

            <!-- Floating Action Button -->
            <button
              class="fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
              aria-label="Tambah Tim"
            >
              <i class="fa-solid fa-plus"></i>
            </button>
          </div>
        </main>
      </div>
    </div>

    <script src="../jsadmin.js"></script>
  </body>
</html>
