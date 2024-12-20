<?php

namespace App\Http\Controllers;

use App\Models\JenisKeragaman;
use App\Models\DataKeragaman;
use Illuminate\Http\Request;
use App\Models\Kontak;
use App\Models\KontakMuseum;
use App\Models\MuseumGeopark;

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

    private function extractInstagramUsername($url)
    {
        // Menggunakan regex untuk mengekstrak username
        preg_match('/instagram\.com\/([^\/?]+)/', $url, $matches);
        return $matches[1] ?? $url; // Mengembalikan username jika ditemukan, atau URL jika tidak
    }

    public function edit_kontak_museum($id)
    {
        $kontakMuseum = KontakMuseum::findOrFail($id);
        session()->forget('success');
        return view('admin.museum.editKontakMuseum', compact('kontakMuseum'));
    }

    public function update_kontak_museum(Request $request, $id)
    {
        $kontakMuseum = KontakMuseum::findOrFail($id);
        $kontakMuseum->update([
            'nama_kontak' => $request->input('nama_kontak'),
            'telepon' => $request->input('telepon'),
            'whatsapp' => $request->input('whatsapp'),
            'email' => $request->input('email'),
            'instagram' => $request->input('instagram'),
            'alamat' => $request->input('alamat'),
        ]);
        return redirect()->route('admin.museum')->with('success', 'Kontak Museum Geopark Berhasil diperbarui.');
    }

    // untuk admin
    public function index_museum(Request $request)
    {
        $dataGeopark = MuseumGeopark::first();
        $kontakMuseum = KontakMuseum::first();
        // $dataGeopark = MuseumGeopark::findOrFail($id);
        $selectedJenis = $request->input('jenis_keragaman');
        $jenisKeragamans = JenisKeragaman::all();
        $dataKeragamans = $selectedJenis == 'all' || !$selectedJenis
            ? DataKeragaman::all()
            : DataKeragaman::where('jenis_keragaman_id', $selectedJenis)->paginate(10);

        $instagramUrl = $kontakMuseum->instagram;
        $username = $this->extractInstagramUsername($instagramUrl);
        return view('admin.museum.museumAdmin', compact('dataGeopark', 'jenisKeragamans', 'dataKeragamans', 'selectedJenis', 'kontakMuseum', 'username'));
    }

    public function create_jenis_keragaman()
    {
        return view('admin.museum.tambahJenisKeragaman');
    }

    public function store_jenis_keragaman(Request $request)
    {
        $jenisKeragamans = JenisKeragaman::create($request->all());
        $jenisKeragamans->save();
        return redirect(route('admin.museum'))->with('success', 'jenis keragaman berhasil di simpan');
    }

    public function destroy_jenis_keragaman($id)
    {
        $jenisKeragaman = JenisKeragaman::findOrFail($id);
        $dataKeragamans = DataKeragaman::where('jenis_keragaman_id', $id)->get();
        foreach ($dataKeragamans as $dataKeragaman) {
            // Hapus file gambar dari storage jika ada
            if ($dataKeragaman->foto_keragaman && \Storage::exists('public/' . $dataKeragaman->foto_keragaman)) {
                \Storage::delete('public/' . $dataKeragaman->foto_keragaman);
            }

            $dataKeragaman->delete();
        }
        $jenisKeragaman->delete();
        return redirect()->route('admin.museum')->with('success', 'Jenis keragaman beserta data keragaman yang terkait berhasil dihapus');
    }

    public function create_data_keragaman()
    {
        $jenisKeragamans = JenisKeragaman::all();
        return view('admin.museum.tambahDataKeragaman', compact('jenisKeragamans'));
    }

    public function store_data_keragaman(Request $request)
    {
        $validatedData = $this->validateDataKeragaman($request);
        $dataKeragamans = DataKeragaman::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'umur' => $request->umur,
            'jenis_keragaman_id' => $request->jenis_keragaman_id,
        ]);

        if ($request->hasFile('foto_keragaman')) {
            $dataKeragamans->foto_keragaman = $this->savePhoto($request->file('foto_keragaman'), 'fotoDataKeragaman');
            $dataKeragamans->save();
        }

        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.museum')->with('success', 'Data keragaman museum PUI GEMAR berhasil disimpan.');
        }
    }

    public function edit_museum_geopark($id)
    {
        $dataGeopark = museumGeopark::findOrFail($id);
        session()->forget('success');
        return view('admin.museum.editMuseum', compact('dataGeopark'));
    }

    public function edit_data_keragaman($id)
    {
        $dataKeragaman = DataKeragaman::with('jenisKeragaman')->findOrFail($id);
        $jenisKeragamans = JenisKeragaman::all();
        session()->forget('success');
        return view('admin.museum.editDataKeragaman', compact('dataKeragaman', 'jenisKeragamans'));
    }

    public function update_museum_geopark(Request $request, $id)
    {
        $dataGeopark = museumGeopark::findOrFail($id);
        if ($request->hasFile('foto')) {
            // Hapus gambar lama dari storage jika ada
            if ($dataGeopark->foto && \Storage::exists('public/' . $dataGeopark->foto)) {
                \Storage::delete('public/' . $dataGeopark->foto);
            }

            // Simpan file gambar baru ke storage dan dapatkan path-nya
            $filePath = $request->file('foto')->store('fotoMuseumGeopark', 'public');
            $dataGeopark->foto = $filePath;
        }

        $dataGeopark->update([
            'judul' => $request->input('judul'),
            'thumbnail' => $request->input('thumbnail'),
            'deskripsi' => $request->input('deskripsi'),
        ]);
        return redirect()->route('admin.museum')->with('success', 'Data Museum Geopark Berhasil diperbarui.');

        session()->forget('success');
        return redirect()->route('admin.museum', compact('dataGeopark'))->with('success', 'data Museum Geopark berhasil diperbarui');
    }



    public function update_data_keragaman(Request $request, $id)
    {
        $validatedData = $this->validateDataKeragaman($request);
        $dataKeragaman = DataKeragaman::findOrFail($id);
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

        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.museum', compact('dataKeragaman'))->with('success', 'data keragaman berhasil diperbarui');
        }
    }

    public function destroy_data_keragaman($id)
    {
        $dataKeragaman = DataKeragaman::findOrFail($id);
        if ($dataKeragaman->foto_keragaman && \Storage::exists('public/' . $dataKeragaman->foto_keragaman)) {
            \Storage::delete('public/' . $dataKeragaman->foto_keragaman);
        }
        $dataKeragaman->delete();
        return redirect(route('admin.museum', compact('dataKeragaman')))->with('success', 'data keragaman berhasil dihapus');
    }

    public function index()
    {
        $kontak = Kontak::first();
        $museumGeopark = MuseumGeopark::first();
        $kontakMuseum = KontakMuseum::first();
        $kontakExists = Kontak::exists();
        $dataKeragamans = DataKeragaman::with('jenisKeragaman')->get()->groupBy(function ($item) {
            return $item->jenisKeragaman->jenis_keragaman; // Mengelompokkan berdasarkan nama jenis keragaman
        });
        $instagramUrl = $kontakMuseum->instagram;
        $username = $this->extractInstagramUsername($instagramUrl);

        // Ambil data pertama dari setiap kelompok (misalnya untuk 'selectedImage')
        $firstDataKeragamans = $dataKeragamans->map(function ($items) {
            return $items->first();
        });

        return view('user.museum.museumGeowisataMerangin', [
            'kontak' => $kontak,
            'kontakExists' => $kontakExists,
            'dataKeragamans' => $dataKeragamans,
            'firstDataKeragamans' => $firstDataKeragamans,
            'museumGeopark' => $museumGeopark,
            'kontakMuseum' => $kontakMuseum,
            'username' => $username,
        ]);
    }

    public function detail_geopark()
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $museumGeopark = MuseumGeopark::first();
        return view('user.museum.detailGeopark', compact('kontak', 'kontakExists', 'museumGeopark'));
    }

    public function detail_data_keragaman($id)
    {
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        $dataKeragaman = DataKeragaman::findOrFail($id);
        return view('user.museum.detailKeragaman', compact('kontak', 'kontakExists', 'dataKeragaman'));
    }
}
