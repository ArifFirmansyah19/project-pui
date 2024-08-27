<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tim;
use App\Models\Kegiatan;
use App\Models\Umkm;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Kontak;
use App\Models\CommentArticle;
// use App\Models\CommentArticle;
use App\Models\desaPotensi;

class DashboardController extends Controller
{
    // Menampilkan dashboard admin
    public function index_admin()
    {
        return view('admin.dashboard');
    }

    // Menampilkan halaman utama web
    public function indexWeb()
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $divisis = divisi::all();
        $jabatans = jabatan::select('nama_jabatan')->distinct()->get();
        $dataTimPui = tim::with('divisi', 'jabatan')->get();
        $articles = Article::all();
        $tims = tim::all();
        $kegiatans = Kegiatan::all();
        $umkms = umkm::all();
        $desas = DesaPotensi::with('potensiDesa')->get();


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

        return view('index', compact('articles', 'desas', 'kontak', 'kontakExists', 'divisis', 'jabatans', 'dataTimPui', 'tims', 'kegiatans', 'umkms', 'articlesWithComments'));
    }
}
