<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tim;
use App\Models\Kegiatan;
use App\Models\Umkm;
use App\Models\Divisi;
use App\Models\Kontak;
use App\Models\PotensiDesa;

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
        $dataTimPui = Tim::with('divisi')->get();
        $articles = Article::latest()->limit(3)->get();
        $tims = Tim::all();
        $kegiatans = Kegiatan::latest()->limit(10)->get();
        $umkms = Umkm::all();
        $potensis = PotensiDesa::all();

        $articles = Article::withCount([
            'comments as totalMainComments' => fn($query) => $query->whereNull('parent_id'),
            'comments as totalReplies' => fn($query) => $query->whereNotNull('parent_id')
        ])->paginate(5);

        return view('index', compact('articles', 'potensis', 'kontak', 'kontakExists', 'divisis', 'dataTimPui', 'tims', 'kegiatans', 'umkms'));
    }
}
