@extends('layouts.app-user');
@section('title', 'Team PUI GEMAR')

@section('content')

    <div class="flex">
      <div class="container mx-auto py-14 w-2/3">
        <div class="max-w-full p-12 bg-white shadow-md rounded-lg">
          <h1 class="text-4xl font-bold text-indigo-900 mb-14">Team</h1>
          <!-- Konten 1 -->
          <div class="team-section">
            <h2 class="text-2xl font-bold text-indigo-900 mb-5 ml-4">Team 1</h2>
            <div
              class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-10 ml-4"
            >
              <!-- Team member 1 -->
              <div
                class="team-member bg-white rounded-lg overflow-hidden shadow-md transform transition duration-300 hover:scale-105"
              >
                <!-- Gambar -->
                <img
                  src="../img/pas1.jpg"
                  alt="Team Member 1"
                  class="w-auto h-52"
                />
                <!-- Konten -->
                <div class="p-4">
                  <h3
                    class="text-xl text-center font-semibold text-gray-800 mb-2"
                  >
                    John Doe
                  </h3>
                  <p class="text-gray-600 text-center">CEO</p>
                </div>
              </div>
              <!-- Tim lainnya -->
              <!-- Team member 2 -->
              <div
                class="team-member bg-white rounded-lg overflow-hidden shadow-md transform transition duration-300 hover:scale-105"
              >
                <!-- Gambar -->
                <img
                  src="../img/pas1.jpg"
                  alt="Team Member 1"
                  class="w-auto h-52"
                />
                <!-- Konten -->
                <div class="p-4">
                  <h3
                    class="text-xl text-center font-semibold text-gray-800 mb-2"
                  >
                    Jony
                  </h3>
                  <p class="text-gray-600 text-center">Leader</p>
                </div>
              </div>

              <!-- Team member 3 -->
              <div
                class="team-member bg-white rounded-lg overflow-hidden shadow-md transform transition duration-300 hover:scale-105"
              >
                <!-- Gambar -->
                <img
                  src="../img/pas1.jpg"
                  alt="Team Member 1"
                  class="w-auto h-52"
                />

                <div class="p-4">
                  <h3
                    class="text-xl text-center font-semibold text-gray-800 mb-2"
                  >
                    John Doe
                  </h3>
                  <p class="text-gray-600 text-center">CEO</p>
                </div>
              </div>
              <!-- Team member 4 -->
              <div
                class="team-member bg-white rounded-lg overflow-hidden shadow-md transform transition duration-300 hover:scale-105"
              >
                <!-- Gambar -->
                <img
                  src="../img/pas1.jpg"
                  alt="Team Member 1"
                  class="w-auto h-52"
                />

                <div class="p-4">
                  <h3
                    class="text-xl text-center font-semibold text-gray-800 mb-2"
                  >
                    John Doe
                  </h3>
                  <p class="text-gray-600 text-center">CEO</p>
                </div>
              </div>
              <!-- ... -->
            </div>
          </div>

          <!-- Konten 2 -->
          <div class="team-section mt-12">
            <h2 class="text-2xl font-bold text-indigo-900 mb-5 ml-4">Team 2</h2>
            <div
              class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-10 ml-4"
            >
              <!-- Team member 1 -->
              <div
                class="team-member bg-white rounded-lg overflow-hidden shadow-md transform transition duration-300 hover:scale-105"
              >
                <!-- Gambar -->
                <img
                  src="../img/pas1.jpg"
                  alt="Team Member 1"
                  class="w-full h-56"
                />
                <!-- Konten -->
                <div class="p-4">
                  <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    John Doe
                  </h3>
                  <p class="text-gray-600">CEO</p>
                </div>
              </div>
              <!-- Tim lainnya -->
              <div
                class="team-member bg-white rounded-lg overflow-hidden shadow-md transform transition duration-300 hover:scale-105"
              >
                <!-- Gambar -->
                <img
                  src="../img/pas1.jpg"
                  alt="Team Member 1"
                  class="w-full h-56"
                />
                <!-- Konten -->
                <div class="p-4">
                  <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    John Doe
                  </h3>
                  <p class="text-gray-600">CEO</p>
                </div>
              </div>

              <div
                class="team-member bg-white rounded-lg overflow-hidden shadow-md transform transition duration-300 hover:scale-105"
              >
                <!-- Gambar -->
                <img
                  src="../img/pas1.jpg"
                  alt="Team Member 1"
                  class="w-full h-56"
                />
                <!-- Konten -->
                <div class="p-4">
                  <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    John Doe
                  </h3>
                  <p class="text-gray-600">CEO</p>
                </div>
              </div>

              <div
                class="team-member bg-white rounded-lg overflow-hidden shadow-md transform transition duration-300 hover:scale-105"
              >
                <!-- Gambar -->
                <img
                  src="../img/pas1.jpg"
                  alt="Team Member 1"
                  class="w-full h-56"
                />
                <!-- Konten -->
                <div class="p-4">
                  <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    John Doe
                  </h3>
                  <p class="text-gray-600">CEO</p>
                </div>
              </div>
              <!-- ... -->
            </div>
          </div>

          <!-- Konten 3 -->
          <div class="team-section mt-12">
            <h2 class="text-2xl font-bold text-indigo-900 mb-5 ml-4">Team 3</h2>
            <div
              class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-10 ml-4"
            >
              <!-- Team member 1 -->
              <div
                class="team-member bg-white rounded-lg overflow-hidden shadow-md transform transition duration-300 hover:scale-105"
              >
                <!-- Gambar -->
                <img
                  src="../img/pas1.jpg"
                  alt="Team Member 1"
                  class="w-full h-56"
                />
                <!-- Konten -->
                <div class="p-4">
                  <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    John Doe
                  </h3>
                  <p class="text-gray-600">CEO</p>
                </div>
              </div>
              <!-- Tim lainnya -->
              <div
                class="team-member bg-white rounded-lg overflow-hidden shadow-md transform transition duration-300 hover:scale-105"
              >
                <!-- Gambar -->
                <img
                  src="../img/pas1.jpg"
                  alt="Team Member 1"
                  class="w-full h-56"
                />
                <!-- Konten -->
                <div class="p-4">
                  <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    John Doe
                  </h3>
                  <p class="text-gray-600">CEO</p>
                </div>
              </div>

              <div
                class="team-member bg-white rounded-lg overflow-hidden shadow-md transform transition duration-300 hover:scale-105"
              >
                <!-- Gambar -->
                <img
                  src="../img/pas1.jpg"
                  alt="Team Member 1"
                  class="w-full h-56"
                />
                <!-- Konten -->
                <div class="p-4">
                  <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    John Doe
                  </h3>
                  <p class="text-gray-600">CEO</p>
                </div>
              </div>
              <!-- ... -->
            </div>
          </div>
        </div>
      </div>
      
      @include('layouts.session-article')
    </div>

@endsection