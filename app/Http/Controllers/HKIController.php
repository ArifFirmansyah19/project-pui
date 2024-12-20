<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HKI;
use App\Models\Kontak;
use App\Models\Article;
use Intervention\Image\Facades\Image;

class HKIController extends Controller
{
    protected function validateHKI(Request $request, $isUpdate = false)
    {
        $rules = [
            'judul' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ];

        if ($isUpdate) {
            $rules['file_path'] = 'nullable|file|mimes:pdf|max:5000';
        } else {
            $rules['file_path'] = 'required|file|mimes:pdf|max:5000';
        }

        return $request->validate($rules, [
            'judul.required' => 'Judul HKI wajib diisi.',
            'nama.required' => 'Nama pemilik HKI wajib diisi.',
            'deskripsi.required' => 'Deskripsi HKI wajib diisi.',
            'file_path.required' => 'File HKI wajib diupload.',
            'file_path.file' => 'Input harus berupa file.',
            'file_path.mimes' => 'File harus berupa PDF.',
            'file_path.max' => 'Ukuran file maksimal 5MB.',
        ]);
    }

    public function index_HKI_admin()
    {
        $HKIExists = HKI::exists();
        $HKIs = HKI::orderBy('created_at', 'desc')->get();
        return view('admin.sumberdaya.HKI.HKIAdmin', compact('HKIExists', 'HKIs'));
    }

    public function create_HKI()
    {
        session()->forget('success');
        return view('admin.sumberdaya.HKI.createHKI');
    }

    public function store_HKI(Request $request)
    {
        $validatedData = $this->validateHKI($request, false);
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('hkiFiles', 'public');
        }

        // Mengolah isi_deskripsi (summernote) dan gambar (jika ada)
        $storagePath = storage_path('app/public/fotoHKI');
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->deskripsi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
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
                $new_src = asset('storage/fotoHKI/' . $filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }

        HKI::create([
            'judul' => $request->judul,
            'nama' => $request->nama,
            'deskripsi' => $dom->saveHTML(),
            'file_path' => $filePath,
        ]);

        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.HKI')->with('success', 'Data HKI Berhasil Disimpan.');
        }
    }

    public function edit_HKI($id)
    {
        session()->forget('success');
        $HKI = HKI::findOrFail($id);
        return view('admin.sumberdaya.HKI.editHKI', compact('HKI'));
    }

    public function update_HKI(Request $request, $id)
    {
        $validatedData = $this->validateHKI($request, true);
        $HKI = HKI::findOrFail($id);
        $oldFilePath = $request->input('old_file_path');

        // Cek apakah ada file baru yang diunggah
        if ($request->hasFile('file_path')) {
            $newFile = $request->file('file_path');
            $newFilePath = $newFile->store('hkiFiles', 'public');

            // Hapus file lama jika ada file baru
            if ($oldFilePath && \Storage::exists('public/' . $oldFilePath)) {
                \Storage::delete('public/' . $oldFilePath);
            }

            $HKI->file_path = $newFilePath;
        } else {
            $HKI->file_path = $oldFilePath;
        }

        $HKI->update([
            'judul' => $request->judul,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.HKI')->with('success', 'Data HKI Berhasil Diupdate.');
        }
    }

    public function destroy_HKI($id)
    {
        $hki = HKI::findOrFail($id);
        if (\Storage::exists('public/' . $hki->file_path)) {
            \Storage::delete('public/' . $hki->file_path);
        }
        $hki->delete();
        return redirect()->route('admin.HKI')->with('success', 'Data HKI berhasil dihapus.');
    }

    // Untuk Controller HKI bagian pengguna website
    public function index_HKI()
    {
        $HKIs = HKI::orderBy('created_at', 'desc')->paginate(10);
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();

        $articles = Article::withCount([
            'comments as totalMainComments' => fn($query) => $query->whereNull('parent_id'),
            'comments as totalReplies' => fn($query) => $query->whereNotNull('parent_id')
        ])->paginate(5);

        return view('user.sumberdaya.HKI.HKIUser', compact('articles', 'HKIs', 'kontak', 'kontakExists'));
    }

    public function detail_HKI($id)
    {
        $HKI = HKI::findOrFail($id);
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        return view('user.sumberdaya.HKI.detailHKI', compact('kontak', 'kontakExists', 'HKI'));
    }
}
