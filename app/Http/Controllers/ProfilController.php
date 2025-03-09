<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\StrukturOrganisasi;
use App\Models\Divisi;
use App\Models\VisionMission;
use App\Models\Kontak;
use App\Models\CommentArticle;
use App\Models\Sejarah;
use Intervention\Image\ImageManagerStatic as Image;

class ProfilController extends Controller
{

    protected function validateStrukturOrganisasi(Request $request)
    {
        return $request->validate([
            'judul' => 'required|string|max:50',
            'foto_struktur_organisasi' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // validasi untuk gambar
            'isi_konten' => 'required|string'
        ], [
            'judul.required' => 'Deskripsi kegiatan wajib diisi.',
            'isi_konten.required' => 'Deskripsi kegiatan wajib diisi.',
            'foto_struktur_organisasi.image' => 'File yang diunggah harus berupa gambar.',
            'foto_struktur_organisasi.mimes' => 'Gambar harus dalam format jpg, jpeg, png, atau webp.',
            'foto_struktur_organisasi.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
        ]);
    }

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

        if ($request->hasFile('foto_konten_sejarah')) {
            // Simpan file ke storage dan dapatkan path-nya
            $filePath = $request->file('foto_konten_sejarah')->store('fotoSejarah', 'public');
        }

        // Membuat sejarah baru
        $sejarahs = Sejarah::create([
            'judul' => $request->input('judul'),
            'foto_konten_sejarah' => $filePath,
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

        // Cek apakah ada file gambar baru yang diunggah
        if ($request->hasFile('foto_konten_sejarah')) {
            // Hapus gambar lama dari storage jika ada
            if ($sejarah->foto_konten_sejarah && \Storage::exists('public/' . $sejarah->foto_konten_sejarah)) {
                \Storage::delete('public/' . $sejarah->foto_konten_sejarah);
            }

            // Simpan file gambar baru ke storage dan dapatkan path-nya
            $filePath = $request->file('foto_konten_sejarah')->store('fotoSejarah', 'public');
        }

        $sejarah->update([
            'judul' => $request->input('judul'),
            'foto_konten_sejarah' => $filePath ?? '',
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
        $divisis = Divisi::all();
        return view('admin.profil.strukturOrganisasi.strukturOrganisasi', compact('divisis', 'gambarStrukturOrganisasiExists', 'strukturOrganisasi'));
    }

    public function create_struktur_organisasi()
    {
        return view('admin.profil.strukturOrganisasi.createStrukturOrganisasi');
    }

    public function store_struktur_organisasi(Request $request)
    {
        $validatedData = $this->validateStrukturOrganisasi($request);

        // Mengolah isi_konten dan gambar
        $storagePath = storage_path('app/public/fotoStrukturOrganisasi');
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->isi_konten, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
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
                $new_src = asset('storage/fotoStrukturOrganisasi/' . $filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }

        // Cek apakah ada file yang diupload
        if ($request->hasFile('foto_struktur_organisasi')) {
            // Simpan file ke storage dan dapatkan path-nya
            $filePath = $request->file('foto_struktur_organisasi')->store('fotoStrukturOrganisasi', 'public');
        }

        // Membuat entitas baru dari StrukturOrganisasi dengan path gambar
        StrukturOrganisasi::create([
            'judul' => $request->input('judul'),
            'foto_struktur_organisasi' => $filePath,
            'isi_konten' => $dom->saveHTML(),
        ]);

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

        // Mengolah isi_konten lama untuk mendapatkan gambar
        $oldDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $oldDom->loadHTML($strukturOrganisasi->isi_konten, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $oldImages = [];
        foreach ($oldDom->getElementsByTagName('img') as $img) {
            $src = $img->getAttribute('src');
            if (!preg_match('/data:image/', $src)) {
                $oldImages[] = basename(parse_url($src, PHP_URL_PATH));
            }
        }

        session()->forget('success');
        return view('admin.profil.strukturOrganisasi.editStrukturOrganisasi', compact('strukturOrganisasi', 'oldImages'));
    }

    public function update_struktur_organisasi(Request $request, $id)
    {
        $validatedData = $this->validateStrukturOrganisasi($request);
        $strukturOrganisasi = StrukturOrganisasi::findOrFail($id);
        $storagePath = storage_path('app/public/fotoStrukturOrganisasi');

        // Mengambil daftar gambar lama dari isi_konten yang tersimpan di database
        $oldDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $oldDom->loadHTML($strukturOrganisasi->isi_konten, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
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

        // Mengolah isi_konten baru untuk gambar baru
        $newDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $newDom->loadHTML($request->isi_konten, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
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
                $new_src = asset('storage/fotoStrukturOrganisasi/' . $filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
                $newImages[] = basename(parse_url($new_src, PHP_URL_PATH));

                // Hapus gambar lama dengan nama yang sama (jika ada)
                $oldImageName = basename(parse_url($src, PHP_URL_PATH));
                if (in_array($oldImageName, $oldImages)) {
                    $filePathToDelete = $storagePath . '/' . $oldImageName;
                    if (file_exists($filePathToDelete)) {
                        \Storage::delete('public/fotoStrukturOrganisasi/' . $oldImageName);
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
                \Storage::delete('public/fotoStrukturOrganisasi/' . $image);
            }
        }

        // Cek apakah ada file gambar baru yang diunggah
        if ($request->hasFile('foto_struktur_organisasi')) {
            // Hapus gambar lama dari storage jika ada
            if ($strukturOrganisasi->foto_struktur_organisasi && \Storage::exists('public/' . $strukturOrganisasi->foto_struktur_organisasi)) {
                \Storage::delete('public/' . $strukturOrganisasi->foto_struktur_organisasi);
            }
            // Simpan file gambar baru ke storage dan dapatkan path-nya
            $filePath = $request->file('foto_struktur_organisasi')->store('fotoStrukturOrganisasi', 'public');
            $strukturOrganisasi->foto_struktur_organisasi = $filePath;
        }

        // Update path gambar di database
        $strukturOrganisasi->update([
            'judul' => $request->input('judul'),
            'isi_konten' => $newDom->saveHTML(),
        ]);

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
        $sejarahExists = Sejarah::exists();
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $articles = Article::withCount([
            'comments as totalMainComments' => fn($query) => $query->whereNull('parent_id'),
            'comments as totalReplies' => fn($query) => $query->whereNotNull('parent_id')
        ])
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('user/profil.sejarah', compact('kontak', 'kontakExists', 'articles', 'sejarahExists', 'sejarah'));
    }

    public function visimisi()
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $visiMisiExists = VisionMission::exists();
        $visionMission = VisionMission::first();
        $articles = Article::withCount([
            'comments as totalMainComments' => fn($query) => $query->whereNull('parent_id'),
            'comments as totalReplies' => fn($query) => $query->whereNotNull('parent_id')
        ])
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('user/profil.visi_misi', compact('kontak', 'kontakExists', 'visiMisiExists', 'visionMission', 'articles'));
    }

    public function struktur_organisasi()
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $gambarStrukturOrganisasiExists = StrukturOrganisasi::exists();
        $strukturOrganisasi = StrukturOrganisasi::first();
        $divisis = Divisi::all();
        $articles = Article::withCount([
            'comments as totalMainComments' => fn($query) => $query->whereNull('parent_id'),
            'comments as totalReplies' => fn($query) => $query->whereNotNull('parent_id')
        ])
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('user/profil.strukturorganisasi', compact('kontak', 'kontakExists', 'gambarStrukturOrganisasiExists', 'strukturOrganisasi', 'divisis', 'articles'));
    }
}
