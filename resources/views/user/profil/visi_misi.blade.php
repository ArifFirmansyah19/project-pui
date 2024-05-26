@extends('layouts.app-user');
@section('title', 'Visi Misi PUI GEMAR')

@section('content')

    <div class="flex">
      <!-- Konten  -->
      <div class="max-w-full p-12 bg-white shadow-md rounded-lg w-2/3">
        <div class="max-w-full p-12 bg-white shadow-md rounded-lg">
          <h1 class="text-4xl font-bold text-indigo-900 mb-15 mt-8">Visi</h1>
          <!--konten visi -->

          <p class="text-gray-800 mt-6 leading-relaxed">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
            imperdiet dolor ac nisl condimentum, ac faucibus nunc vestibulum.
            Maecenas efficitur turpis eget malesuada ultrices. Vivamus sodales
            purus non leo fermentum, at hendrerit nisi vestibulum. Lorem ipsum
            dolor sit amet, consectetur adipiscing elit. Sed imperdiet dolor ac
            nisl condimentum, ac faucibus nunc vestibulum. Maecenas efficitur
            turpis eget malesuada ultrices. Vivamus sodales purus non leo
            fermentum, at hendrerit nisi vestibulum. Lorem ipsum dolor sit amet,
            consectetur adipiscing elit.
          </p>
        </div>
        <div class="max-w-full p-12 bg-white shadow-md rounded-lg">
          <h1 class="text-4xl font-bold text-indigo-900 mb-15">Misi</h1>
          <!--konten misi-->

          <p class="text-gray-800 mt-6 leading-relaxed">
            <li>
              Pellentesque habitant morbi tristique senectus et netus et
              malesuada fames ac turpis egestas. Nam accumsan non lorem vel
              eleifend. Proin viverra nisi id diam eleifend, quis rutrum libero
              sollicitudin. Duis in pulvinar ipsum, eu suscipit arcu.
            </li>
            <li>
              Pellentesque habitant morbi tristique senectus et netus et
              malesuada fames ac turpis egestas. Nam accumsan non lorem vel
              eleifend. Proin viverra nisi id diam eleifend, quis rutrum libero
              sollicitudin. Duis in pulvinar ipsum, eu suscipit arcu.
            </li>
            <li>
              Pellentesque habitant morbi tristique senectus et netus et
              malesuada fames ac turpis egestas. Nam accumsan non lorem vel
              eleifend. Proin viverra nisi id diam eleifend, quis rutrum libero
              sollicitudin. Duis in pulvinar ipsum, eu suscipit arcu.
            </li>
            <li>
              Pellentesque habitant morbi tristique senectus et netus et
              malesuada fames ac turpis egestas. Nam accumsan non lorem vel
              eleifend. Proin viverra nisi id diam eleifend, quis rutrum libero
              sollicitudin. Duis in pulvinar ipsum, eu suscipit arcu.
            </li>
          </p>
        </div>
      </div>
      <!--artikel-->
      <div class="max-w-full p-8 bg-gray-600 w-1/3">
        <h2 class="text-3xl font-semibold text-white mb-5 mt-24">Article</h2>

        <!-- Artikel 1 -->
        <div class="mb-4">
          <h3 class="text-lg font-semibold text-white mb-0">Judul Artikel 1</h3>
          <p class="text-sm text-gray-300 mb-2">01 April 2024</p>
          <p class="text-sm text-white">
            Penjelasan singkat tentang artikel ini.
          </p>
          <a
            href="#"
            class="block text-blue-500 font-semibold mt-2 hover:text-blue-300 transition duration-300"
            >Baca Selengkapnya</a
          >
        </div>
        <hr class="border-gray-800 my-1" />

        <!-- Artikel 2 -->
        <div class="mb-4">
          <h3 class="text-lg font-semibold text-white mb-0">Judul Artikel 2</h3>
          <p class="text-sm text-gray-300 mb-2">01 April 2024</p>
          <p class="text-sm text-white">
            Penjelasan singkat tentang artikel ini.
          </p>
          <a
            href="#"
            class="block text-blue-500 font-semibold mt-2 hover:text-blue-300 transition duration-300"
            >Baca Selengkapnya</a
          >
        </div>
        <hr class="border-gray-800 my-1" />

        <!-- Artikel 3 -->
        <div class="mb-4">
          <h3 class="text-lg font-semibold text-white mb-0">Judul Artikel 3</h3>
          <p class="text-sm text-gray-300 mb-2">01 April 2024</p>
          <p class="text-sm text-white">
            Penjelasan singkat tentang artikel ini.
          </p>
          <a
            href="#"
            class="block text-blue-500 font-semibold mt-2 hover:text-blue-300 transition duration-300"
            >Baca Selengkapnya</a
          >
        </div>
        <hr class="border-gray-800 my-1" />

        <!-- Artikel lainnya ... -->
      </div>
    </div>

@endsection
