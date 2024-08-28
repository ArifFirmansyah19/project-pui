<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Article;
use App\Models\Kontak;
use App\Models\CommentKegiatan;
use App\Models\CommentArticle;
use Intervention\Image\ImageManagerStatic as Image;

class KegiatanController extends Controller
{

    protected function validateKegiatan(Request $request)
    {
        return $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'foto_kegiatan' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1000',
            'deskripsi_kegiatan' => 'required|string',
        ], [
            'nama_kegiatan.required' => 'Judul kegiatan wajib diisi.',
            'penulis.required' => 'Penulis kegiatan wajib diisi.',
            'foto_kegiatan.image' => 'File yang diunggah harus berupa gambar.',
            'foto_kegiatan.mimes' => 'Gambar kegiatan harus dalam format jpg, jpeg, png, atau webp.',
            'foto_kegiatan.max' => 'Ukuran gambar kegiatan tidak boleh lebih dari 1 MB.',
            'deskripsi_kegiatan.required' => 'Deskripsi kegiatan wajib diisi.',
        ]);
    }

    // Menampilkan halaman kegiatan untuk admin
    public function index_admin()
    {
        $dataKegiatan = Kegiatan::all();
        return view('admin.sumberdaya.kegiatan.kegiatan', compact('dataKegiatan'));
    }

    // Menampilkan halaman pembuatan kegiatan baru
    public function create_kegiatan()
    {
        return view('admin.sumberdaya.kegiatan.createKegiatan');
    }

    // Menyimpan kegiatan baru
    public function store_kegiatan(Request $request)
    {
        // Validasi request
        $validatedData = $this->validateKegiatan($request);

        // Mengolah deskripsi_kegiatan dan gambar
        $storagePath = storage_path('app/public/fotoKegiatan');
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->deskripsi_kegiatan, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
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
                $new_src = asset('storage/fotoKegiatan/' . $filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }

        // Membuat kegiatan baru
        $kegiatan = Kegiatan::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'deskripsi_kegiatan' => $dom->saveHTML(),
        ]);

        // Menyimpan gambar kegiatan jika ada
        if ($request->hasFile('foto_kegiatan')) {
            // Hapus foto_kegiatan lama jika ada
            if ($kegiatan->foto_kegiatan && \Storage::exists('public/' . $kegiatan->foto_kegiatan)) {
                \Storage::delete('public/' . $kegiatan->foto_kegiatan);
            }

            // Simpan foto_kegiatan baru
            $filePath = $request->file('foto_kegiatan')->store('fotoKegiatan', 'public');
            $kegiatan->foto_kegiatan = $filePath;
            $kegiatan->save();
        }

        // Menyimpan pesan sukses atau kesalahan di session flash
        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.kegiatan')->with('success', 'Data Kegiatan Anda Berhasil Disimpan.');
        }
    }


    // Menampilkan halaman edit kegiatan
    public function edit_kegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        // Mengolah deskripsi_kegiatan lama untuk mendapatkan gambar
        $oldDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $oldDom->loadHTML($kegiatan->deskripsi_kegiatan, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $oldImages = [];
        foreach ($oldDom->getElementsByTagName('img') as $img) {
            $src = $img->getAttribute('src');
            if (!preg_match('/data:image/', $src)) {
                $oldImages[] = basename(parse_url($src, PHP_URL_PATH));
            }
        }

        return view('admin.sumberdaya.kegiatan.editKegiatan', compact('kegiatan', 'oldImages'));
    }

    // Mengupdate data kegiatan
    public function update_kegiatan(Request $request, $id)
    {
        // Validasi request
        $validatedData = $this->validateKegiatan($request);

        // Temukan kegiatan
        $kegiatan = Kegiatan::findOrFail($id);

        // Path penyimpanan gambar
        $storagePath = storage_path('app/public/fotoKegiatan');

        // Mengambil daftar gambar lama dari deskripsi yang tersimpan di database
        $oldDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $oldDom->loadHTML($kegiatan->deskripsi_kegiatan, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
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

        // Mengolah deskripsi_kegiatan baru untuk gambar baru
        $newDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $newDom->loadHTML($request->deskripsi_kegiatan, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
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
                $new_src = asset('storage/fotoKegiatan/' . $filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
                $newImages[] = basename(parse_url($new_src, PHP_URL_PATH));

                // Hapus gambar lama dengan nama yang sama (jika ada)
                $oldImageName = basename(parse_url($src, PHP_URL_PATH));
                if (in_array($oldImageName, $oldImages)) {
                    $filePathToDelete = $storagePath . '/' . $oldImageName;
                    if (file_exists($filePathToDelete)) {
                        \Storage::delete('public/fotoKegiatan/' . $oldImageName);
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
                \Storage::delete('public/fotoKegiatan/' . $image);
            }
        }

        // Simpan foto_kegiatan baru jika ada
        if ($request->hasFile('foto_kegiatan')) {
            // Hapus foto_kegiatan lama jika ada
            if ($kegiatan->foto_kegiatan && \Storage::exists('public/' . $kegiatan->foto_kegiatan)) {
                \Storage::delete('public/' . $kegiatan->foto_kegiatan);
            }

            // Simpan foto_kegiatan baru
            $filePath = $request->file('foto_kegiatan')->store('fotoKegiatan', 'public');
            $kegiatan->foto_kegiatan = $filePath;
        }

        // Update kegiatan
        $kegiatan->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'deskripsi_kegiatan' => $newDom->saveHTML(),
        ]);

        // Menyimpan pesan sukses atau kesalahan di session flash
        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.kegiatan')->with('success', 'Data kegiatan Anda berhasil diperbarui.');
        }
    }


    // Menghapus data kegiatan
    public function destroy_kegiatan($id)
    {
        $dataKegiatan = Kegiatan::findOrFail($id);

        // Hapus foto_kegiatan jika ada
        if ($dataKegiatan->foto_kegiatan && \Storage::exists('public/' . $dataKegiatan->foto_kegiatan)) {
            \Storage::delete('public/' . $dataKegiatan->foto_kegiatan);
        }

        // Hapus gambar dari deskripsi_kegiatan
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($dataKegiatan->deskripsi_kegiatan, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (!preg_match('/data:image/', $src)) {
                $imagePath = parse_url($src, PHP_URL_PATH);
                $fileName = basename($imagePath);
                $filePath = storage_path('app/public/fotoKegiatan/' . $fileName);

                // Hapus gambar dari direktori
                if (file_exists($filePath)) {
                    \Storage::delete('public/fotoKegiatan/' . $fileName);
                }
            }
        }

        // Hapus kegiatan
        $dataKegiatan->delete();

        return redirect(route('admin.kegiatan'))->with('success', 'Data kegiatan berhasil dihapus');
    }


    // Menampilkan detail kegiatan untuk admin
    public function detail_kegiatan_admin($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $commentkegiatans = CommentKegiatan::where('kegiatan_id', $id)
            ->whereNull('parent_id')
            ->with([
                'replies' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                }
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($commentkegiatans as $comment) {
            $comment->load([
                'replies.replies' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                }
            ]);
        }

        foreach ($commentkegiatans as $commentKegiatan) {
            $commentKegiatan->total_replies = $commentKegiatan->countAllReplies();
        }

        return view('admin.sumberdaya.kegiatan.detailKegiatan', compact('kegiatan', 'commentkegiatans'));
    }

    // Menyimpan komentar kegiatan
    public function store_comment_kegiatan(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatans,id',
            'parent_id' => 'nullable|exists:comment_kegiatans,id',
            'isi_komentar' => 'required|string|max:5000',
        ]);

        $is_admin = false;

        //Periksa apakah pengguna adalah admin atau bukan
        if (Auth::check() && Auth::user()->isAdmin()) {
            $is_admin = true;
        }

        //membuat nilai nama berdasarkan is admin
        $nama = $is_admin ? 'Admin' : $request->nama;

        CommentKegiatan::create([
            'kegiatan_id' => $request->kegiatan_id,
            'parent_id' => $request->parent_id,
            'nama' => $nama,
            'isi_komentar' => $request->isi_komentar,
            'is_admin' => $is_admin,
        ]);

        return back();
    }

    // Menampilkan halaman kegiatan untuk pengguna
    public function index()
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $articles = Article::all();
        $kegiatans = Kegiatan::all();

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


        // Menghitung total komentar utama dan balasan untuk setiap kegiatan
        $kegiatansWithComments = $kegiatans->map(function ($kegiatan) {
            // Menghitung jumlah komentar utama
            $totalMainComments = CommentKegiatan::where('kegiatan_id', $kegiatan->id)
                ->whereNull('parent_id')
                ->count();

            // Menghitung jumlah balasan
            $totalReplies = CommentKegiatan::where('kegiatan_id', $kegiatan->id)
                ->whereNotNull('parent_id')
                ->count();

            // Menjumlahkan komentar utama dan balasan
            $kegiatan->totalComments = $totalMainComments + $totalReplies;

            return $kegiatan;
        });

        return view('user.sumberdaya.kegiatan.kegiatan', compact('kontak', 'kontakExists', 'articles', 'kegiatans', 'kegiatansWithComments', 'articlesWithComments'));
    }

    // Menampilkan detail kegiatan untuk pengguna
    public function kegiatan_detail($id)
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $articles = Article::all();

        $kegiatan = Kegiatan::findOrFail($id);
        $commentkegiatans = CommentKegiatan::where('kegiatan_id', $id)
            ->whereNull('parent_id')
            ->with([
                'replies' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                }
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($commentkegiatans as $comment) {
            $comment->load([
                'replies.replies' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                }
            ]);
        }

        foreach ($commentkegiatans as $commentKegiatan) {
            $commentKegiatan->total_replies = $commentKegiatan->countAllReplies();
        }

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

        return view('user.sumberdaya.kegiatan.detailKegiatan', compact('kontak', 'kontakExists', 'kegiatan', 'articles', 'commentkegiatans', 'articlesWithComments'));
    }
}