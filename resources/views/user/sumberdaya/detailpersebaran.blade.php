@extends('layouts.app-user');
@section('title', 'Detail Persebaran PUI GEMAR')

@section('content')
    <div class="container mx-auto py-8 px-8">
      <!-- Nama UMKM dan Penjelasan Singkat -->
      <h1 class="text-3xl font-bold text-gray-800 mb-4 mt-24">UMKM XYZ</h1>
      <p class="text-lg text-gray-700 mb-8">
        Kami adalah UMKM yang berfokus pada pembuatan produk kerajinan tangan
        berkualitas tinggi. Produk kami terbuat dari bahan-bahan alami dan ramah
        lingkungan.
      </p>

      <!-- produk produk -->
      <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Produk</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-8">
          <div class="bg-white rounded-md shadow-md overflow-hidden">
            <img
              src="../img/prdk1.jpg"
              alt="Produk 1"
              class="w-full h-60 object-cover"
            />
            <div class="p-4">
              <h3 class="text-lg font-semibold text-gray-800 mb-2">Produk 1</h3>
              <p class="text-gray-600">Deskripsi singkat produk 1.</p>
            </div>
          </div>
          <div class="bg-white rounded-md shadow-md overflow-hidden">
            <img
              src="../img/prdk2.jpg"
              alt="Produk 2"
              class="w-full h-60 object-cover"
            />
            <div class="p-4">
              <h3 class="text-lg font-semibold text-gray-800 mb-2">Produk 2</h3>
              <p class="text-gray-600">Deskripsi singkat produk 2.</p>
            </div>
          </div>
          <div class="bg-white rounded-md shadow-md overflow-hidden">
            <img
              src="../img/prdk3.jpg"
              alt="Produk 3"
              class="w-full h-60 object-cover"
            />
            <div class="p-4">
              <h3 class="text-lg font-semibold text-gray-800 mb-2">Produk 3</h3>
              <p class="text-gray-600">Deskripsi singkat produk 3.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

 @endsection