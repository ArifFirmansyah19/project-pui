@extends('layouts.app-admin')
@section('title', 'halaman sejarah admin')
@section('content-admin')
    <!-- Content -->
    <div class="bg-white shadow-md mt-5 rounded-lg p-4">
        <!-- Konten-->
        <h1 class="text-4xl font-bold text-indigo-900 mb-8">
            Sejarah PUI GEMAR
        </h1>

        @if (!$sejarahExists)
            <div class="flex justify-start mb-10">
                <button
                    class="bg-blue-500 hover:bg-blue-700 mt-10 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    <a href="{{ route('admin.create-sejarah') }}">
                        Tambah Konten sejarah
                    </a>
                </button>
            </div>
        @else
            <div class="mb-8 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                <p class="text-gray-800 leading-relaxed">
                    {!! $sejarah->isi_sejarah !!}
                </p>
            </div>


            {{-- <!--konten sejarah-->
               PUI-GEMAR unja merupakan salah satudari 12 PUI yang ada di Universitas
                Jambi. PUI GEMAR didirikan pada tanggal 13 Mei 2020 berdasarkan SK Rektor
                Universitas Jambi yang memiliki lingkup di bidang penelitian dan
                pembelajaran pada kawasan Geowisata Merangin Jambi.

                Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus molestiae iste vel molestias, ipsum
                officiis maiores enim neque assumenda ad, eaque et inventore doloremque beatae vero fugiat cumque saepe
                laboriosam. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste maxime vitae corrupti,
                reprehenderit,
                est, fuga quis dolor dolorem modi cumque nostrum nulla placeat cum dolore magni dolores qui animi tenetur!
                Lorem
                ipsum dolor sit amet consectetur adipisicing elit. Dolorem, obcaecati. Iste amet doloremque nostrum eum
                labore
                totam, minima libero dolore sed nesciunt inventore tempora distinctio corporis aperiam perferendis
                architecto.
                Quam!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, quasi. Laborum, perspiciatis
                cumque.
                Nihil rerum odit rem repellat consequuntur consectetur exercitationem quis eligendi asperiores illum, sed ad
                quidem? Alias, esse. Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus molestiae iste vel
                molestias, ipsum officiis maiores enim neque assumenda ad, eaque et inventore doloremque beatae vero fugiat
                cumque saepe laboriosam. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste maxime vitae
                corrupti,
                reprehenderit, est, fuga quis dolor dolorem modi cumque nostrum nulla placeat cum dolore magni dolores qui
                animi
                tenetur! Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, obcaecati. Iste amet doloremque
                nostrum eum labore totam, minima libero dolore sed nesciunt inventore tempora distinctio corporis aperiam
                perferendis architecto. Quam!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, quasi.
                Laborum, perspiciatis cumque. Nihil rerum odit rem repellat consequuntur consectetur exercitationem quis
                eligendi asperiores illum, sed ad quidem? Alias, esse.

                Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus molestiae iste vel molestias, ipsum
                officiis maiores enim neque assumenda ad, eaque et inventore doloremque beatae vero fugiat cumque saepe
                laboriosam. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste maxime vitae corrupti,
                reprehenderit,
                est, fuga quis dolor dolorem modi cumque nostrum nulla placeat cum dolore magni dolores qui animi tenetur!
                Lorem
                ipsum dolor sit amet consectetur adipisicing elit. Dolorem, obcaecati. Iste amet doloremque nostrum eum
                labore
                totam, minima libero dolore sed nesciunt inventore tempora distinctio corporis aperiam perferendis
                architecto.
                Quam!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, quasi. Laborum, perspiciatis
                cumque.
                Nihil rerum odit rem repellat consequuntur consectetur exercitationem quis eligendi asperiores illum, sed ad
                quidem? Alias, esse. Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus molestiae iste vel
                molestias, ipsum officiis maiores enim neque assumenda ad, eaque et inventore doloremque beatae vero fugiat
                cumque saepe laboriosam. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste maxime vitae
                corrupti,
                reprehenderit, est, fuga quis dolor dolorem modi cumque nostrum nulla placeat cum dolore magni dolores qui
                animi
                tenetur! Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, obcaecati. Iste amet doloremque
                nostrum eum labore totam, minima libero dolore sed nesciunt inventore tempora distinctio corporis aperiam
                perferendis architecto. Quam!Lorem Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, quasi.
                Laborum, perspiciatis cumque. Nihil rerum odit rem repellat consequuntur consectetur exercitationem quis
                eligendi asperiores illum, sed ad quidem? Alias, esse.
    </div> --}}
            <button
                class="fixed bottom-4 right-4 bg-yellow-500 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"
                aria-label="Edit Sejarah">
                <a href="{{ route('admin.edit-sejarah', $sejarah->id) }}">
                    <i class="fas fa-edit" style="color: #ffffff;"></i>
                </a>
                </i>
            </button>
        @endif
    </div>
@endsection
