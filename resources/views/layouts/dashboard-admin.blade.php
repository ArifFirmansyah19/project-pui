<div class="max-w-3xl mx-auto text-center">
    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-24 w-auto object-contain mx-auto mb-4" />
    <h1 class="text-3xl font-bold text-gray-800 mb-2">
        Selamat datang, {{ Auth::user()->name }}
    </h1>
    <p class="text-lg text-gray-600 mb-4 leading-relaxed">
        Berikut beberapa hal yang bisa Admin lakukan untuk website PUI
        GEMAR:
    </p>
    <ul class="text-lg text-gray-600 list-disc list-inside mx-auto">
        <li>Kelola Akun Admin</li>
        <li>
            Kelola konten profil PUI GEMAR (Visi Misi, Struktur
            Organisasi, dan Tim )
        </li>
        <li>
            Kelola konten Sumber Daya PUI GEMAR (Artikel, Kegiatan,
            Persebaran UMKM)
        </li>
        <li>Kelola Museum Geopark Merangin</li>
        <li>Kelola Konten Kontak</li>
        <li>Kelola dan Membalas Chat yang Masuk di Dalam Website</li>
    </ul>
</div>
