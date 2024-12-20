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
            'foto_kegiatan' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,avi,mov|max:2048',
            'deskripsi_kegiatan' => 'required|string',
        ], [
            'nama_kegiatan.required' => 'Judul kegiatan wajib diisi.',
            'foto_kegiatan.file' => 'File yang diunggah harus berupa gambar atau video.',
            'foto_kegiatan.mimes' => 'File kegiatan harus dalam format jpg, jpeg, png, webp, mp4, avi, atau mov.',
            'foto_kegiatan.max' => 'Ukuran file kegiatan tidak boleh lebih dari 2 MB.',
            'deskripsi_kegiatan.required' => 'Deskripsi kegiatan wajib diisi.',
        ]);
    }

    public function index_admin()
    {
        $dataKegiatan = Kegiatan::withCount([
            'comments as totalMainComments' => fn($query) => $query->whereNull('parent_id'),
            'comments as totalReplies' => fn($query) => $query->whereNotNull('parent_id'),
            'comments as totalComments'
        ])->paginate(10);

        return view('admin.sumberdaya.kegiatan.kegiatan', compact('dataKegiatan'));
    }

    public function create_kegiatan()
    {
        return view('admin.sumberdaya.kegiatan.createKegiatan');
    }

    public function store_kegiatan(Request $request)
    {
        $validatedData = $this->validateKegiatan($request);
        $storagePath = storage_path('app/public/fotoKegiatan');

        // Mengolah deskripsi_kegiatan dan gambar
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
            if ($kegiatan->foto_kegiatan && \Storage::exists('public/' . $kegiatan->foto_kegiatan)) {
                \Storage::delete('public/' . $kegiatan->foto_kegiatan);
            }
            $filePath = $request->file('foto_kegiatan')->store('fotoKegiatan', 'public');
            $kegiatan->foto_kegiatan = $filePath;
            $kegiatan->save();
        }
        return $request->session()->has('errors')
            ? redirect()->back()->withErrors($validatedData)->withInput()
            : redirect()->route('admin.kegiatan')->with('success', 'Data Kegiatan Anda Berhasil Disimpan.');
    }

    // Menampilkan halaman edit kegiatan
    public function edit_kegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
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
        session()->forget('success');
        return view('admin.sumberdaya.kegiatan.editKegiatan', compact('kegiatan', 'oldImages'));
    }


    public function update_kegiatan(Request $request, $id)
    {
        $validatedData = $this->validateKegiatan($request);
        $kegiatan = Kegiatan::findOrFail($id);

        $storagePath = storage_path('app/public/fotoKegiatan');
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
        $oldImagesFromRequest = is_array($oldImagesFromRequest) ? $oldImagesFromRequest : [];
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
        $dataKegiatan->delete();
        return redirect(route('admin.kegiatan'))->with('success', 'Data kegiatan berhasil dihapus');
    }

    // Mengambil komentar kegiatan
    public function getComments($kegiatanId)
    {
        $comments = CommentKegiatan::where('kegiatan_id', $kegiatanId)->get();
        return response()->json($comments);
    }

    // Menampilkan detail kegiatan untuk admin
    public function detail_kegiatan_admin($id)
    {
        session()->forget('success');

        $kegiatan = Kegiatan::findOrFail($id);
        $commentKegiatans = CommentKegiatan::with([
            'replies.replies' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }
        ])
            ->where('kegiatan_id', $id)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($commentKegiatans as $commentKegiatan) {
            $commentKegiatan->total_replies = $commentKegiatan->countAllReplies();
        }

        return view('admin.sumberdaya.kegiatan.detailKegiatan', compact('kegiatan', 'commentKegiatans'));
    }

    public function store_comment_kegiatan(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatans,id',
            'parent_id' => 'nullable|exists:comment_kegiatans,id',
            'isi_komentar' => 'required|string|max:5000',
            'nama' => 'nullable|string|max:255', // Nama pengguna jika bukan admin
        ]);

        // Periksa apakah pengguna adalah admin atau bukan
        $is_admin = Auth::check() && Auth::user()->isAdmin();
        $nama = $is_admin ? 'Admin' : $request->nama;

        // Membuat komentar baru
        CommentKegiatan::create([
            'kegiatan_id' => $request->kegiatan_id,
            'parent_id' => $request->parent_id,
            'nama' => $nama,
            'isi_komentar' => $request->isi_komentar,
            'is_admin' => $is_admin,
        ]);
        return back()->with('success', 'Komentar berhasil ditambahkan');
    }

    // Menghapus komentar kegiatan
    public function destroy_comment_kegiatan($id)
    {
        $commentKegiatan = CommentKegiatan::findOrFail($id);
        if (Auth::check() && Auth::user()->isAdmin()) {
            $commentKegiatan->replies()->delete();
            $commentKegiatan->delete();

            return back()->with('success', 'Komentar dan balasan berhasil dihapus.');
        } else {
            return back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini.');
        }
    }

    // Menampilkan data kegiatan untuk admin
    public function index()
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $kegiatans = Kegiatan::orderBy('created_at', 'desc')->paginate(5);

        // Menambahkan jumlah komentar utama dan balasan untuk setiap artikel
        $articles = Article::withCount([
            'comments as totalMainComments' => fn($query) => $query->whereNull('parent_id'),
            'comments as totalReplies' => fn($query) => $query->whereNotNull('parent_id')
        ])->paginate(10);

        // Menghitung total komentar utama dan balasan untuk setiap kegiatan
        $kegiatansWithComments = $kegiatans->map(function ($kegiatan) {
            $totalMainComments = CommentKegiatan::where('kegiatan_id', $kegiatan->id)
                ->whereNull('parent_id')
                ->count();

            $totalReplies = CommentKegiatan::where('kegiatan_id', $kegiatan->id)
                ->whereNotNull('parent_id')
                ->count();

            // Menjumlahkan komentar utama dan balasan
            $kegiatan->totalComments = $totalMainComments + $totalReplies;
            return $kegiatan;
        });
        return view('user.sumberdaya.kegiatan.kegiatan', compact('kontak', 'kontakExists', 'articles', 'kegiatans', 'kegiatansWithComments'));
    }

    // Menampilkan detail kegiatan untuk pengguna
    public function kegiatan_detail($id)
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $kegiatan = Kegiatan::findOrFail($id);

        // Mengambil komentar dan balasan kegiatan
        $commentKegiatans = CommentKegiatan::with([
            'replies.replies' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }
        ])
            ->where('kegiatan_id', $id)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get();

        // Menambahkan total balasan untuk setiap komentar
        foreach ($commentKegiatans as $commentKegiatan) {
            $commentKegiatan->total_replies = $commentKegiatan->countAllReplies();
        }

        // Menampilkan artikel dan jumlah komentar
        $articles = Article::withCount([
            'comments as totalMainComments' => fn($query) => $query->whereNull('parent_id'),
            'comments as totalReplies' => fn($query) => $query->whereNotNull('parent_id')
        ])->paginate(5);

        return view('user.sumberdaya.kegiatan.detailKegiatan', compact('kontak', 'kontakExists', 'kegiatan', 'articles', 'commentKegiatans'));
    }
}
