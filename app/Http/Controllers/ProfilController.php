<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\StrukturOrganisasi;
use App\Models\divisi;
use App\Models\VisionMission;
use App\Models\kontak;
use App\Models\CommentArticle;

class ProfilController extends Controller
{
    // Untuk Admin
    public function index_admin()
    {
        return view('admin.profil.sejarah.sejarahAdmin');
    }


    public function index_visimisi()
    {
        $visiMisiExists = VisionMission::exists();
        $visionMission = VisionMission::first();
        return view('admin.profil.visimisi.visiMisiAdmin', compact('visionMission', 'visiMisiExists'));
    }

    public function create_visimisi()
    {
        return view('admin.profil.visimisi.createVisiMisi');
    }

    public function store_visimisi(Request $request)
    {
        $visionMission = VisionMission::create($request->all());
        $visionMission->save();

        return redirect(route('profiladmin.visimisi'))->with('success', 'data berhasil ditambahkan');
    }

    public function edit_visimisi($id)
    {
        $visionMission = VisionMission::findOrFail($id);
        return view('admin.profil.visimisi.editVisiMisi', compact('visionMission'));
    }

    public function update_visimisi(Request $request, $id)
    {
        // dd($request->all());
        $visionMission = VisionMission::findOrFail($id);
        $visionMission->update($request->all());
        $visionMission->save();
        return redirect(route('admin.visimisi'))->with('success', 'data berhasil diedit');
    }


    public function index_struktur_organisasi()
    {
        $gambarStrukturOrganisasiExists = StrukturOrganisasi::exists();
        $strukturOrganisasi = StrukturOrganisasi::first();
        $divisis = divisi::all();
        return view('admin.profil.strukturOrganisasi.strukturOrganisasi', compact('divisis', 'gambarStrukturOrganisasiExists', 'strukturOrganisasi'));
    }

    public function create_struktur_organisasi()
    {
        return view('admin.profil.strukturOrganisasi.createStrukturOrganisasi');
    }

    public function store_struktur_organisasi(Request $request)
    {

        // aturan Validasi input
        $rules = [
            'foto_struktur_organisasi' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // validasi untuk gambar
        ];

        // pesan khusus kesalahan input vakidasi
        $messages = [
            'foto_struktur_organisasi.image' => 'File yang diunggah harus berupa gambar.',
            'foto_struktur_organisasi.mimes' => 'Gambar harus dalam format jpg, jpeg, png, atau webp.',
            'foto_struktur_organisasi.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
        ];

        // Validasi request
        $validatedData = $request->validate($rules, $messages);


        // Cek apakah ada file yang diupload
        if ($request->hasFile('foto_struktur_organisasi')) {
            // Simpan file ke storage dan dapatkan path-nya
            $filePath = $request->file('foto_struktur_organisasi')->store('fotoStrukturOrganisasi', 'public');

            // Membuat entitas baru dari StrukturOrganisasi dengan path gambar
            StrukturOrganisasi::create([
                'foto_struktur_organisasi' => $filePath,
            ]);
        }

        // Menyimpan pesan sukses atau kesalahan di session flash dan mengarahkan halaman
        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.SO')->with('success', 'Data Struktur Organisasi Berhasil Disimpan.');
        }
    }

    public function edit_struktur_organisasi($id)
    {
        $strukturOrganisasi = StrukturOrganisasi::findOrFail($id);
        return view('admin.profil.strukturOrganisasi.editStrukturOrganisasi', compact('strukturOrganisasi'));
    }

    public function update_struktur_organisasi(Request $request, $id)
    {
        // aturan Validasi input
        $rules = [
            'foto_struktur_organisasi' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // validasi untuk gambar
        ];

        // pesan khusus kesalahan input vakidasi
        $messages = [
            'foto_struktur_organisasi.image' => 'File yang diunggah harus berupa gambar.',
            'foto_struktur_organisasi.mimes' => 'Gambar harus dalam format jpg, jpeg, png, atau webp.',
            'foto_struktur_organisasi.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
        ];

        // Validasi request
        $validatedData = $request->validate($rules, $messages);

        // Temukan data struktur organisasi berdasarkan id yang dipilih
        $strukturOrganisasi = StrukturOrganisasi::findOrFail($id);

        // Cek apakah ada file gambar baru yang diunggah
        if ($request->hasFile('foto_struktur_organisasi')) {
            // Hapus gambar lama dari storage jika ada
            if ($strukturOrganisasi->foto_struktur_organisasi && \Storage::exists('public/' . $strukturOrganisasi->foto_struktur_organisasi)) {
                \Storage::delete('public/' . $strukturOrganisasi->foto_struktur_organisasi);
            }

            // Simpan file gambar baru ke storage dan dapatkan path-nya
            $filePath = $request->file('foto_struktur_organisasi')->store('fotoStrukturOrganisasi', 'public');

            // Update path gambar di database
            $strukturOrganisasi->update([
                'foto_struktur_organisasi' => $filePath,
            ]);
        }

        // Menyimpan pesan sukses atau kesalahan di session flash dan mengarahkan halaman
        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.SO')->with('success', 'Data Struktur Organisasi Berhasil Diupdate.');
        }
    }


    // untuk pengguna
    public function sejarah()
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $articles = Article::all();

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

        return view('user/profil.sejarah', compact('kontak', 'kontakExists', 'articles', 'articlesWithComments'));
    }

    public function visimisi()
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $visiMisiExists = VisionMission::exists();
        $visionMission = VisionMission::first();
        $articles = Article::all();

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

        return view('user/profil.visi_misi', compact('kontak', 'kontakExists', 'visiMisiExists', 'visionMission', 'articles', 'articlesWithComments'));
    }

    public function struktur_organisasi()
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $gambarStrukturOrganisasiExists = StrukturOrganisasi::exists();
        $strukturOrganisasi = StrukturOrganisasi::first();
        $divisis = divisi::all();
        $articles = Article::all();

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

        return view('user/profil.strukturorganisasi', compact('kontak', 'kontakExists', 'gambarStrukturOrganisasiExists', 'strukturOrganisasi', 'divisis', 'articles', 'articlesWithComments'));
    }
}