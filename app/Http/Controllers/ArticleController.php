<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
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

    public function index_admin()
    {
        $articles = Article::withCount([
            'comments as totalMainComments' => fn($query) => $query->whereNull('parent_id'),
            'comments as totalReplies' => fn($query) => $query->whereNotNull('parent_id'),
            'comments as totalComments'
        ])
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan tanggal pembuatan secara menurun
            ->paginate(5);

        return view('admin.sumberdaya.artikel.artikelAdmin', compact('articles'));
    }


    public function getComments($articleId)
    {
        $comments = CommentArticle::where('article_id', $articleId)->get();
        return response()->json($comments);
    }

    public function showComments($articleId)
    {
        $comments = CommentArticle::where('article_id', $articleId)->get();
        return response()->json($comments);
    }

    public function store_comment_artikel(Request $request)
    {
        $validatedData = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'parent_id' => 'nullable|exists:comment_articles,id',
            'isi_komentar' => 'required|string|max:4000',
            'nama' => 'nullable|string|max:255',
        ]);

        if (Auth::check()) {
            $is_admin = true;
            $nama = 'Admin';
        } else {
            $is_admin = false;
            $nama = $validatedData['nama'];
        }

        $comment = new CommentArticle();
        $comment->article_id = $validatedData['article_id'];
        $comment->isi_komentar = $validatedData['isi_komentar'];
        $comment->parent_id = $validatedData['parent_id'] ?? null;
        $comment->nama = $nama;
        $comment->is_admin = $is_admin;

        $comment->save();
        return response()->json([
            'message' => 'Komentar berhasil dikirim',
            'comment' => $comment
        ]);
    }

    public function create_artikel()
    {
        return view('admin.sumberdaya.artikel.create');
    }

    public function store_artikel(Request $request)
    {
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
        $validatedData = $this->validateArticle($request);
        $article = Article::findOrFail($id);

        $storagePath = storage_path('app/public/fotoArtikel');
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

    public function destroy_comment_artikel($articleId, $commentId)
    {
        $commentArticle = CommentArticle::where('id', $commentId)
            ->where('article_id', $articleId)
            ->first();

        if (!$commentArticle) {
            return response()->json([
                'success' => false,
                'message' => 'Komentar tidak ditemukan.'
            ], 404);
        }

        // Pastikan pengguna memiliki izin
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk menghapus komentar ini.'
            ], 403);
        }

        // Hapus komentar
        $commentArticle->delete();

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dihapus.'
        ], 200);
    }

    // untuk pengguna
    public function index()
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $articles = Article::withCount([
            'comments as totalMainComments' => fn($query) => $query->whereNull('parent_id'),
            'comments as totalReplies' => fn($query) => $query->whereNotNull('parent_id')
        ])
            ->orderBy('created_at', 'desc')
            ->paginate(5);


        return view('user.sumberdaya.artikel.artikelUser', compact('kontak', 'kontakExists', 'articles'));
    }
}
