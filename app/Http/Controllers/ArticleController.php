<?php

namespace App\Http\Controllers;

use App\Models\kontak;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\CommentArticle;
use Intervention\Image\ImageManagerStatic as Image;


class ArticleController extends Controller
{
    protected function validateArticle(Request $request)
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'foto_artikel' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1000',
            'abstract' => 'required|string',
            'file_path' => ['nullable', 'url', function ($attribute, $value, $fail) {
                if (!str_starts_with($value, 'https://')) {
                    $fail('URL file harus diawali dengan https://.');
                }
            }],
        ], [
            'judul.required' => 'Judul artikel wajib diisi.',
            'penulis.required' => 'Penulis artikel wajib diisi.',
            'foto_artikel.image' => 'File yang diunggah harus berupa gambar.',
            'foto_artikel.mimes' => 'Gambar artikel harus dalam format jpg, jpeg, png, atau webp.',
            'foto_artikel.max' => 'Ukuran gambar artikel tidak boleh lebih dari 1 MB.',
            'abstract.required' => 'Deskripsi artikel wajib diisi.',
            'file_path.url' => 'URL file yang dimasukkan tidak valid.',
        ]);
    }

    // untuk admin
    public function index_admin()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.sumberdaya.artikel.artikelAdmin', compact('articles'));
    }

    public function create_artikel()
    {
        return view('admin.sumberdaya.artikel.create');
    }

    public function store_artikel(Request $request)
    {
        // dd($request->all());
        // Validasi request
        $validatedData = $this->validateArticle($request);

        // Mengolah abstract dan gambar dalam summernote
        $storagePath = storage_path('app/public/fotoArtikel');
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->abstract, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
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
                $new_src = asset('storage/fotoArtikel/' . $filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }

        // Membuat artikel baru
        $article = Article::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'file_path' => $request->file_path,
            'abstract' => $dom->saveHTML(),

        ]);

        // Menyimpan gambar artikel jika ada
        if ($request->hasFile('foto_artikel')) {
            // Simpan foto_artikel baru
            $filePath = $request->file('foto_artikel')->store('fotoArtikel', 'public');
            $article->foto_artikel = $filePath;
            $article->save();
        }

        // Menyimpan pesan sukses atau kesalahan di session flash
        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.artikel')->with('success', 'Data Artikel Anda Berhasil Disimpan.');
        }
    }


    public function edit_artikel($id)
    {
        $article = Article::findOrFail($id);

        // Mengolah abstract lama untuk mendapatkan gambar
        $oldDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $oldDom->loadHTML($article->abstract, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $oldImages = [];
        foreach ($oldDom->getElementsByTagName('img') as $img) {
            $src = $img->getAttribute('src');
            if (!preg_match('/data:image/', $src)) {
                $oldImages[] = basename(parse_url($src, PHP_URL_PATH));
            }
        }
        session()->forget('success');
        return view('admin.sumberdaya.artikel.edit', compact('article', 'oldImages'));
    }

    public function update_artikel(Request $request, $id)
    {
        // Validasi request
        $validatedData = $this->validateArticle($request);

        // Temukan artikel
        $article = Article::findOrFail($id);

        // Path penyimpanan gambar
        $storagePath = storage_path('app/public/fotoArtikel');

        // Mengolah abstract lama dalam summernote
        $oldDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $oldDom->loadHTML($article->abstract, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
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

        // Mengolah abstract baru dengan gambar baru
        $newDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $newDom->loadHTML($request->abstract, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $newImages = [];
        foreach ($newDom->getElementsByTagName('img') as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContentRand = substr(md5(uniqid()), 0, 6) . '_' . time();
                $filePath = "$fileNameContentRand.$mimetype";

                // Simpan gambar baru
                $image = Image::make($src)->resize(400, 400)->encode($mimetype, 100)->save("$storagePath/$filePath");
                $new_src = asset('storage/fotoArtikel/' . $filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
                $newImages[] = basename(parse_url($new_src, PHP_URL_PATH));

                // Hapus gambar lama dengan nama yang sama (jika ada)
                $oldImageName = basename(parse_url($src, PHP_URL_PATH));
                if (in_array($oldImageName, $oldImages)) {
                    $filePathToDelete = $storagePath . '/' . $oldImageName;
                    if (file_exists($filePathToDelete)) {
                        \Storage::delete('public/fotoArtikel/' . $oldImageName);
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
                \Storage::delete('public/fotoArtikel/' . $image);
            }
        }

        // Simpan foto_artikel baru jika ada
        if ($request->hasFile('foto_artikel')) {
            // Hapus foto_artikel lama jika ada
            if ($article->foto_artikel && \Storage::exists('public/' . $article->foto_artikel)) {
                \Storage::delete('public/' . $article->foto_artikel);
            }

            // Simpan foto_artikel baru
            $filePath = $request->file('foto_artikel')->store('fotoArtikel', 'public');
            $article->foto_artikel = $filePath;
        }

        // Update artikel
        $article->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'file_path' => $request->file_path,
            'abstract' => $newDom->saveHTML(),
        ]);

        // Menyimpan pesan sukses atau kesalahan di session flash
        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.artikel')->with('success', 'Data artikel Anda berhasil diperbarui.');
        }
    }

    public function destroy_artikel($id)
    {
        $article = Article::findOrFail($id);

        // Hapus foto_artikel jika ada
        if ($article->foto_artikel && \Storage::exists('public/' . $article->foto_artikel)) {
            \Storage::delete('public/' . $article->foto_artikel);
        }

        // Hapus gambar dari abstract
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($article->abstract, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (!preg_match('/data:image/', $src)) {
                $imagePath = parse_url($src, PHP_URL_PATH);
                $fileName = basename($imagePath);
                $filePath = storage_path('app/public/fotoArtikel/' . $fileName);

                // Hapus gambar dari direktori
                if (file_exists($filePath)) {
                    \Storage::delete('public/fotoArtikel/' . $fileName);
                }
            }
        }
        $article->delete();
        return redirect(route('admin.artikel'))->with('success', 'Data artikel berhasil dihapus');
    }


    public function show()
    {
        $article = Article::orderBy('created_at', 'desc')->paginate(10);
        return view('user.sumberdaya.artikel.artikelUser', compact('article'));
    }

    public function detail_artikel_admin($id)
    {
        session()->forget('success');
        $article = Article::findOrFail($id);

        // Mengambil komentar utama untuk artikel dengan jumlah balasan
        $commentArticles = CommentArticle::where('article_id', $id)
            ->whereNull('parent_id') // Hanya komentar utama yang tidak memiliki parent
            ->withCount('replies') // Menghitung jumlah balasan untuk setiap komentar
            ->orderBy('created_at', 'desc') // Mengurutkan komentar utama berdasarkan tanggal terbaru
            ->paginate(10); // Menggunakan pagination untuk membatasi jumlah komentar yang ditampilkan

        // Memuat balasan untuk setiap komentar utama
        $commentArticles->load([
            'replies' => function ($query) {
                $query->orderBy('created_at', 'desc'); // Mengurutkan balasan berdasarkan tanggal terbaru
            },
            'replies.replies' => function ($query) {
                $query->orderBy('created_at', 'desc'); // Mengurutkan balasan nested berdasarkan tanggal terbaru
            }
        ]);

        return view('admin.sumberdaya.artikel.detailArtikel', compact('article', 'commentArticles'));
    }


    public function store_comment_artikel(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'parent_id' => 'nullable|exists:comment_articles,id',
            'isi_komentar' => 'required|string|max:4000',
            'nama' => 'nullable|string|max:255' // Nama pengguna jika bukan admin
        ]);

        $is_admin = false;

        // Periksa apakah pengguna adalah admin atau bukan
        if (Auth::check() && Auth::user()->isAdmin()) {
            $is_admin = true;
        }

        // Membuat nilai nama berdasarkan apakah admin atau bukan
        $nama = $is_admin ? 'Admin' : $request->nama;

        // Simpan komentar baru ke database
        CommentArticle::create([
            'article_id' => $request->article_id,
            'parent_id' => $request->parent_id,
            'nama' => $nama,
            'isi_komentar' => $request->isi_komentar,
            'is_admin' => $is_admin,
        ]);

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Komentar berhasil ditambahkan');
    }



    public function destroy_comment_artikel($id)
    {
        // Temukan komentar utama
        $commentArticle = CommentArticle::findOrFail($id);

        if (Auth::check() && Auth::user()->isAdmin()) {
            $commentArticle->replies()->delete();
            $commentArticle->delete();

            return back()->with('success', 'Komentar dan balasan berhasil dihapus.');
        } else {
            return back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini.');
        }
    }


    // untuk pengguna
    public function index()
    {
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

        return view('user.sumberdaya.artikel.artikelUser', compact('kontak', 'kontakExists', 'articles', 'articlesWithComments'));
    }

    public function detail_article($id)
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();

        $article = Article::findOrFail($id);

        // Mengambil komentar utama untuk artikel dan balasan nested
        $commentArticles = CommentArticle::where('article_id', $id)
            ->whereNull('parent_id') // Hanya komentar utama yang tidak memiliki parent
            ->with([
                'replies' => function ($query) {
                    $query->orderBy('created_at', 'desc'); // Mengurutkan balasan berdasarkan tanggal terbaru
                }
            ])
            ->orderBy('created_at', 'desc') // Mengurutkan komentar utama berdasarkan tanggal terbaru
            ->get();

        // Mengambil balasan nested untuk setiap balasan
        foreach ($commentArticles as $comment) {
            $comment->load([
                'replies.replies' => function ($query) {
                    $query->orderBy('created_at', 'desc'); // Mengurutkan balasan nested berdasarkan tanggal terbaru
                }
            ]);
        }

        // Menghitung jumlah balasan total untuk setiap komentar
        foreach ($commentArticles as $commentArticle) {
            $commentArticle->total_replies = $commentArticle->countAllReplies();
        }

        return view('user.sumberdaya.artikel.detailartikel', compact('kontak', 'kontakExists', 'article', 'commentArticles',));
    }
}