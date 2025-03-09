<footer class="bg-indigo-900 py-2" id="contact">
    <section class="w-full max-w-6xl mx-auto py-8">
        <div class="grid grid-cols-2 md:grid-cols-1 gap-4">
            <!-- Kontak -->
            <div class="bg-transparent p-2 rounded-lg text-left md:text-center">
                @if (!$kontakExists)
                    <h3 class="text-lg md:text-xl font-bold text-white mb-3">Kontak</h3>
                    <p class="text-sm md:text-base text-white mb-3">
                        Alamat: Jl. Jambi – Muara Bulian No.KM. 15, Mendalo Darat, Kec.
                        Jambi Luar Kota, Kabupaten Muaro Jambi, Jambi
                    </p>
                    <p class="text-sm md:text-base text-white mb-3">
                        Telepon: -
                    </p>
                    <p class="text-sm md:text-base text-white mb-3">
                        Email: -
                    </p>
                @else
                    <h3 class="text-lg md:text-xl font-bold text-white mb-3">Kontak</h3>
                    <p class="text-sm md:text-base text-white mb-3">
                        Alamat: {{ $kontak->alamat }}
                    </p>
                    <p class="text-sm md:text-base text-white mb-3">
                        Telepon: {{ $kontak->telepon }}
                    </p>
                    <p class="text-sm md:text-base text-white mb-3">
                        Email: <a href="mailto:{{ $kontak->email }}">{{ $kontak->email }}</a>
                    </p>
                @endif
            </div>

            <!-- Media Sosial -->
            <div class="bg-transparent p-6 rounded-lg text-left md:text-center">
                <h3 class="text-lg md:text-xl font-bold text-white mb-3">Follow Us</h3>
                <div class="flex flex-wrap justify-start md:justify-center gap-4">
                    @if (!$kontakExists)
                        <!-- Facebook -->
                        <a href="#" class="text-white hover:text-indigo-600 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6 md:w-8 md:h-8">
                                <path fill="currentColor"
                                    d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z" />
                            </svg>
                            <span class="text-xs md:text-sm">puigemarfacebook</span>
                        </a>
                        <!-- Instagram -->
                        <a href="#" class="text-white hover:text-indigo-600 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-6 md:w-8 md:h-8">
                                <path fill="currentColor"
                                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9 26.2 26.2 58 34.4 93.9 36.2 37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9-34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7 2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6z" />
                            </svg>
                            <span class="text-xs md:text-sm">puigemarinstagram</span>
                        </a>
                        <!-- X -->
                        <a href="#" class="text-white hover:text-indigo-600 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6 md:w-8 md:h-8">
                                <path fill="currentColor"
                                    d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                            </svg>
                            <span class="text-xs md:text-sm">puigemarX</span>
                        </a>
                        <!-- TikTok -->
                        <a href="#" class="text-white hover:text-indigo-600 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-6 md:w-8 md:h-8">
                                <path fill="white"
                                    d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z" />
                            </svg>
                            <span class="text-xs md:text-sm">puigemartiktok</span>
                        </a>
                    @else
                        <!-- Facebook -->
                        <a href="{{ $kontak->facebook }}"
                            class="text-white hover:text-indigo-600 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6 md:w-8 md:h-8">
                                <path fill="currentColor"
                                    d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z" />
                            </svg>
                            <span class="text-xs md:text-sm">puigemarfacebook</span>
                        </a>
                        <!-- Instagram -->
                        <a href="{{ $kontak->instagram }}"
                            class="text-white hover:text-indigo-600 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-6 md:w-8 md:h-8">
                                <path fill="currentColor"
                                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9 26.2 26.2 58 34.4 93.9 36.2 37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9-34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7 2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6z" />
                            </svg>
                            <span class="text-xs md:text-sm">puigemarinstagram</span>
                        </a>
                        <!-- X -->
                        <a href="{{ $kontak->twitter }}"
                            class="text-white hover:text-indigo-600 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6 md:w-8 md:h-8">
                                <path fill="currentColor"
                                    d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                            </svg>
                            <span class="text-xs md:text-sm">puigemarX</span>
                        </a>
                        <!-- TikTok -->
                        <a href="{{ $kontak->tiktok }}"
                            class="text-white hover:text-indigo-600 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-6 md:w-8 md:h-8">
                                <path fill="white"
                                    d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z" />
                            </svg>
                            <span class="text-xs md:text-sm">puigemartiktok</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="w-full bg-gray-300 py-4 text-center">
        <p class="text-indigo-900 text-sm">
            &copy; 2024 PUI GEMAR | All Rights Reserved
        </p>
    </section>
</footer>
