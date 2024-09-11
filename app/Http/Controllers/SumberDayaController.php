<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\umkm;
use App\Models\desaPotensi;
use App\Models\kontak;
use App\Models\CommentArticle;

class SumberDayaController extends Controller
{
    public function peta_persebaran()
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $umkms = umkm::all();
        $desas = desaPotensi::with(['umkm', 'potensiDesa'])->get();
        $articles = Article::orderBy('created_at', 'desc')->paginate(5);

        // Menghitung total komentar utama dan balasan untuk setiap artikel
        $articlesWithComments = $articles->map(function ($article) {
            // Menghitung jumlah komentar utama
            $totalMainComments = CommentArticle::where('article_id', $article->id)
                ->whereNull('parent_id')
                ->count();

            // Menghitung jumlah balasan
            $totalReplies = CommentArticle::where('article_id', $article->id)
                ->whereNotNull('parent_id')
                ->count();

            // Menjumlahkan komentar utama dan balasan
            $article->totalComments = $totalMainComments + $totalReplies;

            return $article;
        });

        return view('user.sumberdaya.persebaranUMKM.peta', compact('kontak', 'kontakExists', 'umkms', 'desas', 'articles', 'articlesWithComments'));
    }

    public function detail_umkm($id)
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $umkm = umkm::with('produkUmkm', 'desaPotensi')->findOrFail($id);

        // Extract username dari IG pemilik UMKM 
        $instagramUrl = $umkm->instagram;
        $username = $this->extractInstagramUsername($instagramUrl);

        return view('user.sumberdaya.persebaranUMKM.detailPersebaran', compact('umkm', 'kontak', 'kontakExists', 'username'));
    }

    public function detail_potensi_desa($id)
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $desa = desaPotensi::with('potensiDesa')->findOrFail($id);
        return view('user.sumberdaya.persebaranUMKM.detailpotensi', compact('desa', 'kontak', 'kontakExists'));
    }


    private function extractInstagramUsername($url)
    {
        // Menggunakan regex untuk mengekstrak username
        preg_match('/instagram\.com\/([^\/?]+)/', $url, $matches);
        return $matches[1] ?? $url; // Mengembalikan username jika ditemukan, atau URL jika tidak
    }
}
