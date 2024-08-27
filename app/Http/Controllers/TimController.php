<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tim;
use App\Models\Article;
use App\Models\divisi;
use App\Models\jabatan;
use App\Models\kontak;
use App\Models\CommentArticle;

class TimController extends Controller
{

    // untuk admin
    public function index_admin()
    {
        $divisis = divisi::all();
        $jabatans = jabatan::select('nama_jabatan')->distinct()->get();
        $dataTimPui = tim::with('divisi', 'jabatan')->get();

        // Mengelompokkan data tim berdasarkan nama divisi
        $groupedTims = $dataTimPui->groupBy(function ($dataTim) {
            return $dataTim->divisi->nama_divisi;
        });
        return view('admin.profil.tim.timAdmin', compact('divisis', 'jabatans', 'dataTimPui', 'groupedTims'));
    }

    public function create_tim()
    {
        $divisis = divisi::all();
        $jabatans = jabatan::all();
        return view('admin.profil.tim.tambahTim', compact('divisis', 'jabatans'));
    }

    public function store_tim(Request $request)
    {
        // Aturan validasi input
        $rules = [
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'divisi_id' => 'required|exists:divisis,id',
            'jabatan_id' => 'required|exists:jabatans,id',
            'bidang_keahlian' => 'required|string|max:255',
        ];

        // Pesan kesalahan khusus
        $messages = [
            'nama.required' => 'Nama tim wajib diisi.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Gambar harus dalam format jpeg, png, jpg, gif, atau svg.',
            'foto.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
            'divisi_id.required' => 'Divisi wajib diisi.',
            'divisi_id.exists' => 'Divisi yang dipilih tidak valid.',
            'jabatan_id.required' => 'Jabatan wajib diisi.',
            'jabatan_id.exists' => 'Jabatan yang dipilih tidak valid.',
            'bidang_keahlian.required' => 'Bidang keahlian wajib diisi.',
        ];

        // Validasi request
        $validatedData = $request->validate($rules, $messages);

        // Membuat artikel baru
        $tim = tim::create([
            'nama' => $request->nama,
            'divisi_id' => $request->divisi_id,
            'jabatan_id' => $request->jabatan_id,
            'bidang_keahlian' => $request->bidang_keahlian,
        ]);

        if ($request->hasFile('foto')) {
            // Simpan foto baru
            $filePath = $request->file('foto')->store('fotoTim', 'public');
            $tim->foto = $filePath;
            $tim->save();
        }
        // Menyimpan pesan sukses atau kesalahan di session flash
        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.tim')->with('success', 'Data TIM PUI GEMAR Berhasil Disimpan.');
        }
    }

    public function edit_tim($id)
    {
        $tim = tim::findOrFail($id);
        $divisis = divisi::all();
        $jabatans = jabatan::all();
        return view('admin.profil.tim.editTim', compact('tim', 'divisis', 'jabatans'));
    }


    public function update_tim(Request $request, $id)
    {
        // Aturan validasi input
        $rules = [
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'divisi_id' => 'required|exists:divisis,id',
            'jabatan_id' => 'required|exists:jabatans,id',
            'bidang_keahlian' => 'required|string|max:255',
        ];

        // Pesan kesalahan khusus
        $messages = [
            'nama.required' => 'Nama tim wajib diisi.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Gambar harus dalam format jpeg, png, jpg, gif, atau svg.',
            'foto.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
            'divisi_id.required' => 'Divisi wajib diisi.',
            'divisi_id.exists' => 'Divisi yang dipilih tidak valid.',
            'jabatan_id.required' => 'Jabatan wajib diisi.',
            'jabatan_id.exists' => 'Jabatan yang dipilih tidak valid.',
            'bidang_keahlian.required' => 'Bidang keahlian wajib diisi.',
        ];

        // Validasi request
        $validatedData = $request->validate($rules, $messages);

        // Temukan tim yang akan diperbarui
        $tim = Tim::findOrFail($id);

        // Update data tim
        $tim->update([
            'nama' => $request->nama,
            'divisi_id' => $request->divisi_id,
            'jabatan_id' => $request->jabatan_id,
            'bidang_keahlian' => $request->bidang_keahlian,
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($tim->foto && \Storage::exists('public/' . $tim->foto)) {
                \Storage::delete('public/' . $tim->foto);
            }

            // Simpan foto baru
            $filePath = $request->file('foto')->store('fotoTim', 'public');
            $tim->foto = $filePath;
            $tim->save();
        }

        // Menyimpan pesan sukses atau kesalahan di session flash
        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.tim')->with('success', 'Data TIM PUI GEMAR Berhasil Diperbarui.');
        }
    }


    public function destroy_tim($id)
    {
        $tim = tim::findOrFail($id);
        // Hapus foto jika ada
        if ($tim->foto && \Storage::exists('public/' . $tim->foto)) {
            \Storage::delete('public/' . $tim->foto);
        }
        $tim->delete();
        return redirect(route('admin.tim'))->with('success', 'Data Anggota Berhasil di hapus');
    }



    public function create_divisi()
    {
        return view('admin.profil.tim.tambahDivisi');
    }

    public function store_divisi(Request $request)
    {
        $divisis = divisi::create($request->all());
        $divisis->save();
        return redirect(route('admin.tim'))->with('success', 'data berhasil di simpan');
    }

    public function destroy_divisi($id)
    {
        $divisis = divisi::findOrFail($id);
        $divisis->delete();
        return redirect(route('admin.tim'))->with('success', 'data divisi berhasil dihapus');
    }

    public function create_jabatan()
    {
        $divisis = divisi::all();
        return view('admin.profil.tim.tambahJabatan', compact('divisis'));
    }

    public function store_jabatan(Request $request)
    {
        $jabatans = jabatan::create($request->all());
        $jabatans->save();
        return redirect(route('admin.tim'))->with('success', 'data berhasil di simpan');
    }

    public function destroy_jabatan($id)
    {
        $jabatans = jabatan::findOrFail($id);
        $jabatans->delete();
        return redirect(route('admin.tim'))->with('success', 'data jabatan berhasil dihapus');
    }


    // untuk pengguna
    public function tim()
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $divisis = divisi::all();
        $jabatans = jabatan::select('nama_jabatan')->distinct()->get();
        $dataTimPui = tim::with('divisi', 'jabatan')->get();
        $articles = Article::all();

        // Mengelompokkan data tim berdasarkan nama divisi
        $groupedTims = $dataTimPui->groupBy(function ($dataTim) {
            return $dataTim->divisi->nama_divisi;
        });

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

        return view('user/profil.team', compact('kontak', 'kontakExists', 'divisis', 'jabatans', 'articles', 'groupedTims', 'articlesWithComments'));
    }

    public function detail_tim($id)
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $divisis = divisi::all();
        $jabatans = jabatan::select('nama_jabatan')->distinct()->get();
        $tim = tim::with(['divisi', 'jabatan'])->where('id', $id)->firstOrFail();
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

        return view('user.profil.detailteam', compact('kontak', 'kontakExists', 'divisis', 'jabatans', 'tim', 'articles', 'articlesWithComments'));
    }
}
