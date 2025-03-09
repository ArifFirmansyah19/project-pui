<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tim;
use App\Models\Article;
use App\Models\Divisi;
use App\Models\Kontak;
use App\Models\CommentArticle;

class TimController extends Controller
{

    protected function validateTimPuiGemar(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'divisi_id' => 'required|exists:divisis,id',
            'jabatan' => 'required|string|max:100',
            'bidang_keahlian' => 'required|string|max:255',
        ], [
            'nama.required' => 'Nama tim wajib diisi.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Gambar harus dalam format jpeg, png, jpg, gif, atau svg.',
            'foto.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
            'divisi_id.required' => 'Divisi wajib diisi.',
            'divisi_id.exists' => 'Divisi yang dipilih tidak valid.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'bidang_keahlian.required' => 'Bidang keahlian wajib diisi.',
        ]);
    }

    // untuk admin
    public function index_admin()
    {
        $divisis = Divisi::all();
        $dataTimPui = Tim::with('divisi')->orderBy('divisi_id')->get();

        // Mengelompokkan data tim berdasarkan nama divisi
        $groupedTims = $dataTimPui->groupBy(function ($dataTim) {
            return $dataTim->divisi->nama_divisi;
        });
        return view('admin.profil.tim.timAdmin', compact('divisis', 'dataTimPui', 'groupedTims'));
    }

    public function detailtim_admin($id)
    {
        $tim = Tim::find($id);
        return view('admin.profil.tim.detailtimadmin', compact('tim'));
    }

    public function create_tim()
    {
        $divisis = Divisi::all();
        return view('admin.profil.tim.tambahTim', compact('divisis'));
    }

    public function store_tim(Request $request)
    {
        $validatedData = $this->validateTimPuiGemar($request);
        $tim = Tim::create([
            'nama' => $request->nama,
            'divisi_id' => $request->divisi_id,
            'jabatan' => $request->jabatan,
            'bidang_keahlian' => $request->bidang_keahlian,
        ]);

        if ($request->hasFile('foto')) {
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
        $tim = Tim::findOrFail($id);
        $divisis = Divisi::all();
        session()->forget('success');
        return view('admin.profil.tim.editTim', compact('tim', 'divisis'));
    }

    public function update_tim(Request $request, $id)
    {
        $validatedData = $this->validateTimPuiGemar($request);
        $tim = Tim::findOrFail($id);

        // Update data tim
        $tim->update([
            'nama' => $request->nama,
            'divisi_id' => $request->divisi_id,
            'jabatan' => $request->jabatan,
            'bidang_keahlian' => $request->bidang_keahlian,
        ]);

        if ($request->hasFile('foto')) {
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
        $tim = Tim::findOrFail($id);
        if ($tim->foto && \Storage::exists('public/' . $tim->foto)) {
            \Storage::delete('public/' . $tim->foto);
        }
        $tim->delete();
        return redirect(route('admin.tim'))->with('success', 'Data Anggota Berhasil di hapus');
    }


    public function store_divisi(Request $request)
    {
        $request->validate([
            'nama_divisi' => 'required|string|max:255',
        ]);
        Divisi::create([
            'nama_divisi' => $request->nama_divisi,
        ]);

        return redirect()->back()->with('success', 'Divisi berhasil ditambahkan.');
    }



    // untuk pengguna
    public function tim()
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $dataTimPui = Tim::with('divisi')->get();
        $groupedTims = $dataTimPui->groupBy(function ($dataTim) {
            return $dataTim->divisi->nama_divisi;
        });
        $articles = Article::withCount([
            'comments as totalMainComments' => fn($query) => $query->whereNull('parent_id'),
            'comments as totalReplies' => fn($query) => $query->whereNotNull('parent_id')
        ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('user/profil.team', compact('kontak', 'kontakExists', 'articles', 'groupedTims'));
    }

    public function detail_tim($id)
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $divisis = Divisi::all();
        $tim = Tim::with(['divisi'])->where('id', $id)->firstOrFail();
        $articles = Article::orderBy('created_at', 'desc')->paginate(2);
        $articlesWithComments = $articles->map(function ($article) {
            $totalMainComments = CommentArticle::where('article_id', $article->id)
                ->whereNull('parent_id')
                ->count();

            $totalReplies = CommentArticle::where('article_id', $article->id)
                ->whereNotNull('parent_id')
                ->count();

            $article->totalComments = $totalMainComments + $totalReplies;
            return $article;
        });
        return view('user.profil.detailteam', compact('kontak', 'kontakExists', 'divisis', 'tim', 'articles', 'articlesWithComments'));
    }
}
