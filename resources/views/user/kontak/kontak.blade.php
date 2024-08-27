@extends('layouts.app-user')
@section('title', 'Kontak PUI GEMAR')

@section('content')

    <div class="container" style="padding:20px 100px 100px 100px";>

        <div class="footer-nav-widgets-wrapper header-footer-group">
            <div class="footer-inner section-inner">
                <div class="footer-top has-social-menu">
                    <nav aria-label="Social links" class="footer-social-wrapper">
                        <ul class="social-menu footer-social reset-list-style social-icons fill-children-current-color">
                        </ul><!-- .footer-social -->
                    </nav><!-- .footer-social-wrapper -->
                </div><!-- .footer-top -->
                <div class="container" style="padding:200px 100px 100px 100px">
                    @if (!$kontakExists)
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                            <div class=" p-6 rounded-lg ml-10">
                                <h3 class="text-lg font-bold text-black mb-3">Kontak</h3>
                                {{-- <p class="text-black mb-3 font-roboto">Telepon: (+62) 851-6255-4117 </p> --}}
                                <p class="text-black mb-3 font-roboto">Telepon: {{ $kontak->telepon }} </p>
                                <p class="text-black mb-3 font-roboto">Facebook: {{ $kontak->facebook }} </p>
                                <p class="text-black mb-3 font-roboto">Instagram: {{ $kontak->instagram }} </p>
                                <p class="text-black mb-3 font-roboto">Youtube: {{ $kontak->youtube }} </p>
                                <a href="mailto:wordpress@example.com">
                                    <p class="text-black mb-3 font-roboto">Email: {{ $kontak->email }}</p>
                                </a>
                                {{-- <a href="https://www.yelp.com"><p class="text-black mb-3 font-roboto">Yelp: yelp</p></a> --}}
                            </div>
                            <div class="p-6 rounded-lg">
                                <h3 class="text-lg font-bold text-black mb-3">Media Sosial</h3>
                                <div class="flex items-center space-x-4">
                                    <a href="{{ $kontak->facebook }}" class="text-black hover:text-indigo-600"><i
                                            class="fab fa-facebook-f"></i></a>
                                    {{-- <a href="https://twitter.com/wordpress" class="text-black hover:text-indigo-600"><i
                                        class="fab fa-twitter"></i></a> --}}
                                    <a href="{{ $kontak->instagram }}" class="text-black hover:text-indigo-600"><i
                                            class="fab fa-instagram"></i></a>
                                    <a href="{{ $kontak->youtube }}" class="text-black hover:text-indigo-600"><i
                                            class="fab fa-youtube"></i></a>
                                    {{-- <a href="#" class="text-black hover:text-indigo-600"><i
                                        class="fab fa-linkedin-in"></i></a> --}}
                                </div>
                            </div>
                    @endif
                </div>
            </div>


            <aside class="footer-widgets-outer-wrapper" role="complementary">
                <div class="footer-widgets-wrapper">
                    <div class="footer-widgets column-one grid-item">
                        <div class="widget widget_text">
                            <div class="widget-content">
                                <h2 class="widget-title subheading"><strong>Alamat</strong></h2>
                                <div class="textwidget">
                                    <p>Alamat: Jl. Jambi – Muara Bulian No.KM. 15, Mendalo Darat, Kec. Jambi Luar Kota,
                                        Kabupaten Muaro Jambi, Jambi</p>
                                    <p>Organisasi Penelitian di Bawah Naungan Universitas Jambi.</p>
                                </div>
                            </div>
                        </div>
                        <p><strong>Hours</strong>
                            <br>
                            Senin – Jum'at : 9:00AM–5:00PM
                            <br>
                            Sabtu &amp; Minggu: Libur
                        </p>
                    </div>
                </div>
        </div>
    </div>

    </div><!-- .footer-widgets-wrapper -->
    </aside><!-- .footer-widgets-outer-wrapper -->
    </div><!-- .footer-inner -->
    </div>

    </div>


@endsection
