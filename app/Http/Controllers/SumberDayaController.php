<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Umkm;
use App\Models\PotensiDesa;
use App\Models\Kecamatan;
use App\Models\Kontak;

class SumberDayaController extends Controller
{
    public function peta_persebaran()
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $umkms = Umkm::all();
        $kecamatans = Kecamatan::with('potensiDesa')->get();
        $potensis = PotensiDesa::all();
        $articles = Article::withCount([
            'comments as totalMainComments' => fn($query) => $query->whereNull('parent_id'),
            'comments as totalReplies' => fn($query) => $query->whereNotNull('parent_id')
        ])
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('user.sumberdaya.persebaranUMKM.peta', compact('kontak', 'kontakExists', 'umkms', 'kecamatans', 'potensis', 'articles'));
    }

    public function detail_umkm($kecamatan_id, $umkm_id)
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();

        $kecamatan = Kecamatan::with(['umkm' => function ($query) use ($umkm_id) {
            $query->where('id', $umkm_id); // Memfilter berdasarkan id UMKM yang diminta
        }])->findOrFail($kecamatan_id);

        // Temukan UMKM berdasarkan ID dan kecamatan
        $umkm = Umkm::where('id', $umkm_id)
            ->where('kecamatan_id', $kecamatan_id)
            ->with('produkUmkm') // Muat data produk terkait UMKM
            ->firstOrFail();

        // Extract username dari IG pemilik UMKM 
        $instagramUrl = $umkm->instagram;
        $username = $this->extractInstagramUsername($instagramUrl);

        return view('user.sumberdaya.persebaranUMKM.detailUmkm', compact('umkm', 'kecamatan',  'kontak', 'kontakExists', 'username'));
    }

    public function detail_potensi_kecamatan($kecamatan_id, $potensi_id)
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $kecamatan = Kecamatan::with(['potensiDesa' => function ($query) use ($potensi_id) {
            $query->where('id', $potensi_id); // Memfilter hanya berdasarkan id potensi yang diminta
        }])->findOrFail($kecamatan_id);


        // Temukan potensi desa berdasarkan ID
        $potensi = PotensiDesa::where('id', $potensi_id)
            ->where('kecamatan_id', $kecamatan_id)
            ->firstOrFail();
        return view('user.sumberdaya.persebaranUMKM.detailpotensi', compact('kecamatan', 'kontak', 'kontakExists', 'potensi'));
    }


    private function extractInstagramUsername($url)
    {
        // Menggunakan regex untuk mengekstrak username
        preg_match('/instagram\.com\/([^\/?]+)/', $url, $matches);
        return $matches[1] ?? $url; // Mengembalikan username jika ditemukan, atau URL jika tidak
    }
}
