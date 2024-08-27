<footer class="bg-indigo-900 h-auto" id="contact">
    <section class="w-full h-auto mx-auto py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <!-- Kontak -->
            @if (!$kontakExists)
                <div class="bg-transparent p-6 rounded-lg ml-10">
                    <h3 class="text-lg font-bold text-white mb-3">Kontak</h3>
                    <p class="text-white mb-3 font-roboto">Alamat: Jl. Jambi – Muara Bulian No.KM. 15, Mendalo Darat,
                        Kec.
                        Jambi Luar Kota, Kabupaten Muaro Jambi, Jambi</p>
                    <p class="text-white mb-3 font-roboto">Telepon: - </p>
                    <p class="text-white mb-3 font-roboto">Email: - </p>
                </div>

                <!-- Media Sosial -->
                <div class="bg-transparent p-6 rounded-lg">
                    <h3 class="text-lg font-bold text-white mb-3">Media Sosial</h3>
                    <div class="flex items-center space-x-4">
                        <a href="#contact" class="text-white hover:text-indigo-600">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#contact" class="text-white hover:text-indigo-600">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#contact" class="text-white hover:text-indigo-600">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#contact" class="text-white hover:text-indigo-600">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#contact" class="text-white hover:text-indigo-600">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-transparent p-6 rounded-lg ml-10">
                    <h3 class="text-lg font-bold text-white mb-3">Kontak</h3>
                    <p class="text-white mb-3 font-roboto">Alamat: {{ $kontak->alamat }}</p>
                    <p class="text-white mb-3 font-roboto">Telepon: {{ $kontak->telepon }} </p>
                    <p class="text-white mb-3 font-roboto">Email: <a
                            href="mailto:{{ $kontak->email }}">{{ $kontak->email }}</a> </p>
                </div>

                <!-- Media Sosial -->
                <div class="bg-transparent p-6 rounded-lg">
                    <h3 class="text-lg font-bold text-white mb-3">Media Sosial</h3>
                    <div class="flex items-center space-x-4">
                        <a href="{{ $kontak->facebook }}" class="text-white hover:text-indigo-600">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="{{ $kontak->twitter }}" class="text-white hover:text-indigo-600">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="{{ $kontak->instagram }}" class="text-white hover:text-indigo-600">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="{{ $kontak->youtube }}" class="text-white hover:text-indigo-600">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="{{ $kontak->tiktok }}" class="text-white hover:text-indigo-600">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
</footer>
