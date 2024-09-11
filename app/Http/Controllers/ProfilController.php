<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\StrukturOrganisasi;
use App\Models\divisi;
use App\Models\VisionMission;
use App\Models\kontak;
use App\Models\CommentArticle;
use App\Models\Sejarah;
use Intervention\Image\ImageManagerStatic as Image;

class ProfilController extends Controller
{
    // Untuk Admin
    public function index_sejarah()
    {
        $sejarahExists = Sejarah::exists();
        $sejarah = Sejarah::first();
        return view('admin.profil.sejarah.sejarahAdmin', compact('sejarahExists', 'sejarah'));
    }

    public function create_sejarah()
    {
        return view('admin.profil.sejarah.createSejarah');
    }

    public function store_sejarah(Request $request)
    {
        // Mengolah isi_sejarah dan gambar (jika ada)
        $storagePath = storage_path('app/public/fotoSejarah');
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->isi_sejarah, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContentRand = substr(md5(uniqid()), 0, 6) . '_' . time();
                $filePath = "$fileNameContentRand.$mimetype";
                $image = Image::make($src)->resize(400, 400)->encode($mimetype, 100)->save("$storagePath/$filePath");
                $new_src = asset('storage/fotoSejarah/' . $filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }
        // Membuat sejarah baru
        $sejarahs = Sejarah::create([
            'isi_sejarah' => $dom->saveHTML(),
        ]);
        $sejarahs->save();

        return redirect(route('admin.sejarah'))->with('success', 'data Sejarah berhasil ditambahkan');
    }

    public function edit_sejarah($id)
    {
        $sejarah = Sejarah::findOrFail($id);
        // Mengolah isi_sejarah dan mendapatkan gambar lama (jika ada)
        $oldDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $oldDom->loadHTML($sejarah->isi_sejarah, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $oldImages = [];
        foreach ($oldDom->getElementsByTagName('img') as $img) {
            $src = $img->getAttribute('src');
            if (!preg_match('/data:image/', $src)) {
                $oldImages[] = basename(parse_url($src, PHP_URL_PATH));
            }
        }
        session()->forget('success');
        return view('admin.profil.sejarah.editSejarah', compact('sejarah', 'oldImages'));
    }

    public function update_sejarah(Request $request, $id)
    {
        // dd($request->all());
        $sejarah = Sejarah::findOrFail($id);

        $storagePath = storage_path('app/public/fotoSejarah');

        // Mengambil daftar gambar lama dari isi_sejarah yang tersimpan di database
        $oldDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $oldDom->loadHTML($sejarah->isi_sejarah, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $oldImages = [];
        foreach ($oldDom->getElementsByTagName('img') as $img) {
            $src = $img->getAttribute('src');
            if (!preg_match('/data:image/', $src)) {
                $oldImages[] = basename(parse_url($src, PHP_URL_PATH));
            }
        }

        // Mengambil daftar gambar lama yang dikirim dari input hidden
        $oldImagesFromRequest = $request->input('old_images', []);
        if (!is_array($oldImagesFromRequest)) {
            $oldImagesFromRequest = [];
        }
        $oldImages = array_merge($oldImages, $oldImagesFromRequest);

        // Mengolah isi_sejarah baru untuk gambar baru
        $newDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $newDom->loadHTML($request->isi_sejarah, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $newImages = [];
        foreach ($newDom->getElementsByTagName('img') as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                // Jika ini adalah gambar baru (base64)
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContentRand = substr(md5(uniqid()), 0, 6) . '_' . time();
                $filePath = "$fileNameContentRand.$mimetype";

                // Simpan gambar baru
                $image = Image::make($src)->encode($mimetype, 100)->save("$storagePath/$filePath");
                $new_src = asset('storage/fotoSejarah/' . $filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
                $newImages[] = basename(parse_url($new_src, PHP_URL_PATH));

                // Hapus gambar lama dengan nama yang sama (jika ada)
                $oldImageName = basename(parse_url($src, PHP_URL_PATH));
                if (in_array($oldImageName, $oldImages)) {
                    $filePathToDelete = $storagePath . '/' . $oldImageName;
                    if (file_exists($filePathToDelete)) {
                        \Storage::delete('public/fotoSejarah/' . $oldImageName);
                    }
                }
            } else {
                // Memasukkan gambar yang sudah ada ke dalam newImages
                $newImages[] = basename(parse_url($src, PHP_URL_PATH));
            }
        }

        // Menyaring gambar lama untuk dihapus
        $imagesToDelete = array_diff($oldImages, $newImages);

        foreach ($imagesToDelete as $image) {
            $filePath = $storagePath . '/' . $image;
            if (file_exists($filePath)) {
                \Storage::delete('public/fotoSejarah/' . $image);
            }
        }

        // Update sejarah
        $sejarah->update([
            'isi_sejarah' => $newDom->saveHTML(),
        ]);
        return redirect()->route('admin.sejarah')->with('success', 'Data Sejarah Anda berhasil diperbarui.');
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

        return redirect(route('admin.visimisi'))->with('success', 'data berhasil ditambahkan');
    }

    public function edit_visimisi($id)
    {
        $visionMission = VisionMission::findOrFail($id);
        session()->forget('success');
        return view('admin.profil.visimisi.editVisiMisi', compact('visionMission'));
    }

    public function update_visimisi(Request $request, $id)
    {
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
        session()->forget('success');
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
        $sejarah = Sejarah::first();
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
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

        return view('user/profil.sejarah', compact('kontak', 'kontakExists', 'articles', 'articlesWithComments', 'sejarah'));
    }

    public function visimisi()
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $visiMisiExists = VisionMission::exists();
        $visionMission = VisionMission::first();
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

        return view('user/profil.visi_misi', compact('kontak', 'kontakExists', 'visiMisiExists', 'visionMission', 'articles', 'articlesWithComments'));
    }

    public function struktur_organisasi()
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $gambarStrukturOrganisasiExists = StrukturOrganisasi::exists();
        $strukturOrganisasi = StrukturOrganisasi::first();
        $divisis = divisi::all();
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

        return view('user/profil.strukturorganisasi', compact('kontak', 'kontakExists', 'gambarStrukturOrganisasiExists', 'strukturOrganisasi', 'divisis', 'articles', 'articlesWithComments'));
    }
}