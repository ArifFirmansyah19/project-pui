<?php

namespace App\Http\Controllers;

use App\Models\jenisKeragaman;
use App\Models\dataKeragaman;
use Illuminate\Http\Request;
use App\Models\kontak;

class MuseumController extends Controller
{

    protected function validateDataKeragaman(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:255',
            'foto_keragaman' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'umur' => 'required|string|max:255',
            'jenis_keragaman_id' => 'required|exists:jenis_keragamans,id',
        ], [
            'nama.required' => 'Nama tim wajib diisi.',
            'foto_keragaman.image' => 'File yang diunggah harus berupa gambar.',
            'foto_keragaman.mimes' => 'Gambar harus dalam format jpeg, png, jpg, gif, atau svg.',
            'foto_keragaman.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
            'deskripsi.required' => 'Deskripsi dari data keragaman wajib diisi.',
            'lokasi.required' => 'lokasi dari data keragaman wajib diisi.',
            'umur.required' => 'Umurdari data keragaman yang diinputkan wajib diisi.',
            'jenis_keragaman_id.required' => 'Divisi wajib diisi.',
            'jenis_keragaman_id.exists' => 'Divisi yang dipilih tidak valid.',
        ]);
    }

    protected function savePhoto($file, $folder)
    {
        return $file->store($folder, 'public');
    }

    // untuk admin
    public function index_museum(Request $request)
    {
        $selectedJenis = $request->input('jenis_keragaman');
        $jenisKeragamans = JenisKeragaman::all();
        $dataKeragamans = $selectedJenis == 'all' || !$selectedJenis
            ? DataKeragaman::all()
            : DataKeragaman::where('jenis_keragaman_id', $selectedJenis)->get();


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


    public function destroy_jenis_keragaman($id)
    {
        // Temukan jenis keragaman yang akan dihapus
        $jenisKeragaman = JenisKeragaman::findOrFail($id);

        // Temukan semua data keragaman yang terkait dengan jenis keragaman ini
        $dataKeragamans = DataKeragaman::where('jenis_keragaman_id', $id)->get();

        // Hapus setiap data keragaman dan file gambar terkait
        foreach ($dataKeragamans as $dataKeragaman) {
            // Hapus file gambar dari storage jika ada
            if ($dataKeragaman->foto_keragaman && \Storage::exists('public/' . $dataKeragaman->foto_keragaman)) {
                \Storage::delete('public/' . $dataKeragaman->foto_keragaman);
            }

            // Hapus data keragaman dari database
            $dataKeragaman->delete();
        }

        // Hapus jenis keragaman
        $jenisKeragaman->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.museum')->with('success', 'Jenis keragaman beserta data keragaman yang terkait berhasil dihapus');
    }


    public function create_data_keragaman()
    {
        $jenisKeragamans = jenisKeragaman::all();
        return view('admin.museum.tambahDataKeragaman', compact('jenisKeragamans'));
    }

    public function store_data_keragaman(Request $request)
    {
        // Validasi request
        $validatedData = $this->validateDataKeragaman($request);

        $dataKeragamans = dataKeragaman::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'umur' => $request->umur,
            'jenis_keragaman_id' => $request->jenis_keragaman_id,
        ]);

        if ($request->hasFile('foto_keragaman')) {
            // Simpan foto_keragaman baru
            $dataKeragamans->foto_keragaman = $this->savePhoto($request->file('foto_keragaman'), 'fotoDataKeragaman');
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
        // Validasi request
        $validatedData = $this->validateDataKeragaman($request);

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
            $filePath = $this->savePhoto($request->file('foto_keragaman'), 'fotoDataKeragaman');
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