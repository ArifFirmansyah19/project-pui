<?php

namespace App\Http\Controllers;

use App\Models\jenisKeragaman;
use App\Models\dataKeragaman;
use Illuminate\Http\Request;
use App\Models\kontak;

class MuseumController extends Controller
{

    // untuk admin

    public function index_museum(Request $request)
    {
        $selectedJenis = $request->input('jenis_keragaman');

        // Ambil semua jenis keragaman untuk dropdown
        $jenisKeragamans = JenisKeragaman::all();

        // Ambil data keragaman berdasarkan jenis yang dipilih
        $dataKeragamans = DataKeragaman::when($selectedJenis, function ($query, $selectedJenis) {
            return $query->where('jenis_keragaman_id', $selectedJenis);
        })->get();

        return view('admin.museum.museumAdmin', compact('jenisKeragamans', 'dataKeragamans', 'selectedJenis'));
    }


    public function create_jenis_keragaman()
    {
        return view('admin.museum.tambahJenisKeragaman');
    }

    public function store_jenis_keragaman(Request $request)
    {
        $jenisKeragamans = jenisKeragaman::create($request->all());
        $jenisKeragamans->save();
        return redirect(route('admin.museum'))->with('success', 'jenis keragaman berhasil di simpan');
    }

    public function create_data_keragaman()
    {
        $jenisKeragamans = jenisKeragaman::all();
        return view('admin.museum.tambahDataKeragaman', compact('jenisKeragamans'));
    }

    public function store_data_keragaman(Request $request)
    {
        // Aturan validasi input
        $rules = [
            'nama' => 'required|string|max:255',
            'foto_keragaman' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'umur' => 'required|string|max:255',
            'jenis_keragaman_id' => 'required|exists:jenis_keragamans,id',
        ];

        // Pesan kesalahan khusus
        $messages = [
            'nama.required' => 'Nama tim wajib diisi.',
            'foto_keragaman.image' => 'File yang diunggah harus berupa gambar.',
            'foto_keragaman.mimes' => 'Gambar harus dalam format jpeg, png, jpg, gif, atau svg.',
            'foto_keragaman.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
            'deskripsi.required' => 'Deskripsi dari data keragaman wajib diisi.',
            'lokasi.required' => 'lokasi dari data keragaman wajib diisi.',
            'umur.required' => 'Umurdari data keragaman yang diinputkan wajib diisi.',
            'jenis_keragaman_id.required' => 'Divisi wajib diisi.',
            'jenis_keragaman_id.exists' => 'Divisi yang dipilih tidak valid.',
        ];

        // Validasi request
        $validatedData = $request->validate($rules, $messages);

        $dataKeragamans = dataKeragaman::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'umur' => $request->umur,
            'jenis_keragaman_id' => $request->jenis_keragaman_id,
        ]);

        if ($request->hasFile('foto_keragaman')) {
            // Simpan foto_keragaman baru
            $filePath = $request->file('foto_keragaman')->store('fotoDataKeragaman', 'public');
            $dataKeragamans->foto_keragaman = $filePath;
            $dataKeragamans->save();
        }
        // Menyimpan pesan sukses atau kesalahan di session flash
        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.museum')->with('success', 'Data keragaman museum PUI GEMAR berhasil disimpan.');
        }
    }

    public function edit_data_keragaman($id)
    {
        $dataKeragaman = DataKeragaman::with('jenisKeragaman')->findOrFail($id);
        return view('admin.museum.editDataKeragaman', compact('dataKeragaman'));
    }

    public function update_data_keragaman(Request $request, $id)
    {
        // Aturan validasi input
        $rules = [
            'nama' => 'required|string|max:255',
            'foto_keragaman' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'umur' => 'required|string|max:255',
            'jenis_keragaman_id' => 'required|exists:jenis_keragamans,id',
        ];

        // Pesan kesalahan khusus
        $messages = [
            'nama.required' => 'Nama tim wajib diisi.',
            'foto_keragaman.image' => 'File yang diunggah harus berupa gambar.',
            'foto_keragaman.mimes' => 'Gambar harus dalam format jpeg, png, jpg, gif, atau svg.',
            'foto_keragaman.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
            'deskripsi.required' => 'Deskripsi dari data keragaman wajib diisi.',
            'lokasi.required' => 'lokasi dari data keragaman wajib diisi.',
            'umur.required' => 'Umurdari data keragaman yang diinputkan wajib diisi.',
            'jenis_keragaman_id.required' => 'Divisi wajib diisi.',
            'jenis_keragaman_id.exists' => 'Divisi yang dipilih tidak valid.',
        ];

        // Validasi request
        $validatedData = $request->validate($rules, $messages);

        $dataKeragaman = dataKeragaman::findOrFail($id);

        $dataKeragaman->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'umur' => $request->umur,
            'jenis_keragaman_id' => $request->jenis_keragaman_id,
        ]);


        if ($request->hasFile('foto_keragaman')) {
            // Hapus foto_keragaman lama jika ada
            if ($dataKeragaman->foto_keragaman && \Storage::exists('public/' . $dataKeragaman->foto_keragaman)) {
                \Storage::delete('public/' . $dataKeragaman->foto_keragaman);
            }

            // Simpan foto_keragaman baru
            $filePath = $request->file('foto_keragaman')->store('fotoDataKeragaman', 'public');
            $dataKeragaman->foto_keragaman = $filePath;
            $dataKeragaman->save();
        }

        // Menyimpan pesan sukses atau kesalahan di session flash
        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.museum', compact('dataKeragaman'))->with('success', 'data keragaman berhasil diperbarui');
        }
    }


    public function destroy_data_keragaman($id)
    {
        $dataKeragaman = dataKeragaman::findOrFail($id);

        // Hapus foto_keragaman jika ada
        if ($dataKeragaman->foto_keragaman && \Storage::exists('public/' . $dataKeragaman->foto_keragaman)) {
            \Storage::delete('public/' . $dataKeragaman->foto_keragaman);
        }
        $dataKeragaman->delete();
        return redirect(route('admin.museum', compact('dataKeragaman')))->with('success', 'data keragaman berhasil dihapus');
    }



    // untuk pengguna
    public function index()
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();

        // Ambil semua jenis keragaman untuk ditampilkan pada card
        $jenisKeragamans = JenisKeragaman::all();

        return view('user.museum.museumGeowisataMerangin', compact('kontak', 'kontakExists', 'jenisKeragamans',));
    }

    public function all_jenis_keragaman($jenis_keragaman)
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        // Mengambil jenis keragaman yang sesuai
        $jenisKeragaman = JenisKeragaman::with('dataKeragaman')->findOrFail($jenis_keragaman);

        // Mengirimkan data ke view
        return view('user.museum.showAllKeragaman', compact('kontak', 'kontakExists', 'jenisKeragaman'));
    }

    public function detail_data_keragaman($id)
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();

        // Ambil data keragaman berdasarkan ID
        $dataKeragaman = DataKeragaman::findOrFail($id);

        // Kirim data ke view
        return view('user.museum.detailKeragaman', compact('kontak', 'kontakExists', 'dataKeragaman'));
    }
}
