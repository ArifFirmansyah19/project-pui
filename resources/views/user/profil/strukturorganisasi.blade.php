@extends('layouts.app-user');
@section('title', 'Struktur Organisasi PUI GEMAR')

@section('content')

    <div class="flex">
      <!-- Konten -->
      <div class="max-w-full p-12 bg-white shadow-md rounded-lg w-2/3">
        <div class="max-w-full p-12 bg-white shadow-md rounded-lg">
          <h1 class="text-4xl font-bold text-indigo-900 mb-16 mt-12">
            Struktur Organisasi
          </h1>
          <!--konten strurktur organisasi-->

          <div class="items-center mt-6">
            <img src="../img/strukturorganisasi.jpg" />
          </div>
        </div>
        <div class="max-w-full p-12 bg-white shadow-md rounded-lg">
          <h1 class="text-4xl font-bold text-indigo-900 mb-15">Divisi</h1>
          <

          <p class="text-gray-800 mt-6 leading-relaxed">
            <li>
              1. Pellentesque habitant morbi tristique senectus et netus et
              malesuada fames ac turpis egestas. Nam accumsan non lorem vel
              eleifend. Proin viverra nisi id diam eleifend, quis rutrum libero
              sollicitudin. Duis in pulvinar ipsum, eu suscipit arcu.
            </li>
            <li>
              2. Pellentesque habitant morbi tristique senectus et netus et
              malesuada fames ac turpis egestas. Nam accumsan non lorem vel
              eleifend. Proin viverra nisi id diam eleifend, quis rutrum libero
              sollicitudin. Duis in pulvinar ipsum, eu suscipit arcu.
            </li>
          </p>
        </div>
      </div>
     
      @include('layouts.session-article')
    </div>

@endsection
