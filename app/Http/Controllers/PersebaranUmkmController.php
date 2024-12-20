<?php

namespace App\Http\Controllers;

use App\Models\FotoPotensi;
use Illuminate\Http\Request;
use App\Models\Umkm;
// use App\Models\kecamatanPotensi;
use App\Models\PotensiDesa;
use App\Models\ProdukUmkm;
use App\Models\Kecamatan;

class PersebaranUmkmController extends Controller
{

    protected function validatePotensi(Request $request)
    {
        return $request->validate([
            // 'nama_kecamatan' => 'required|string|max:100',
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'alamat' => 'required|string|max:255',
            'nama_potensi' => 'required|string|max:255',
            'deskripsi_potensi' => 'required|string',
            'alamat' => 'required|string|max:255',
            'foto_potensis' => 'required|array', // Menambahkan validasi untuk memastikan foto_potensis adalah array
            'foto_potensis.*.foto_potensi' => 'nullable|file|mimes:jpg,png|max:2048',
            'foto_potensis.*.deskripsi_foto' => 'required|string|max:255',
        ], [
            // 'nama_desas.required' => 'Nama desas wajib diisi.',
            'kecamatan_id.required' => 'ID kecamatan wajib diisi.',
            'latitude.required' => 'Latitude wajib diisi.',
            'longitude.required' => 'Longitude wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'nama_potensi.required' => 'Nama potensi wajib diisi.',
            'deskripsi_potensi.required' => 'Deskripsi potensi wajib diisi.',
            'alamat.required' => 'Alamat potensi wajib diisi.',
            'foto_potensis.required' => 'Data potensi wajib diisi.',
            'foto_potensis.array' => 'Data potensi harus berupa array.',
            'foto_potensis.*.foto_potensi.mimes' => 'Foto potensi harus dalam format JPG atau PNG.',
            'foto_potensis.*.foto_potensi.max' => 'Ukuran file foto potensi tidak boleh lebih dari 2MB.',
            'foto_potensis.*.deskripsi_foto.required' => 'Deskripsi potensi wajib diisi.',
        ]);
    }


    protected function validateUmkm(Request $request)
    {
        return $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'alamat_umkm' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            // 'foto_umkm' => 'nullable|file|mimes:jpg,png|max:2048',
            'deskripsi_umkm' => 'required|string',
            'kontak' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'instagram' => 'nullable|string|max:255',
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'produk_umkm.*.nama_produk' => 'required|string|max:255',
            'produk_umkm.*.deskripsi_produk' => 'required|string',
            'produk_umkm.*.foto_produk' => 'nullable|file|mimes:jpg,png|max:2048',
            'produk_umkm.*.harga_terendah' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/', // Validasi untuk angka dengan 0 atau 2 tempat desimal
            ],
            'produk_umkm.*.harga_tertinggi' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/', // Validasi untuk angka dengan 0 atau 2 tempat desimal
            ],
        ], [
            'nama_umkm.required' => 'Nama UMKM wajib diisi.',
            'nama_pemilik.required' => 'Nama pemilik UMKM wajib diisi.',
            'alamat_umkm.required' => 'Alamat UMKM wajib diisi.',
            'latitude.required' => 'Latitude wajib diisi.',
            'longitude.required' => 'Longitude wajib diisi.',
            // 'foto_umkm.mimes' => 'Foto UMKM harus dalam format JPG atau PNG.',
            // 'foto_umkm.max' => 'Ukuran file foto UMKM tidak boleh lebih dari 2MB.',
            'deskripsi_umkm.required' => 'Deskripsi UMKM wajib diisi.',
            'kontak.required' => 'Kontak UMKM wajib diisi.',
            'kontak.max' => 'Kontak UMKM tidak boleh lebih dari 20 karakter.',
            'whatsapp.max' => 'Nomor WhatsApp tidak boleh lebih dari 15 karakter.',
            'email.email' => 'Format email tidak valid.',
            'kecamatan_id.required' => 'Desa potensi wajib dipilih.',
            'kecamatan_id.exists' => 'Desa potensi yang dipilih tidak valid.',
            'produk_umkm.*.nama_produk.required' => 'Nama produk UMKM wajib diisi.',
            'produk_umkm.*.deskripsi_produk.required' => 'Deskripsi produk UMKM wajib diisi.',
            'produk_umkm.*.foto_produk.mimes' => 'Foto produk harus dalam format JPG atau PNG.',
            'produk_umkm.*.foto_produk.max' => 'Ukuran file foto produk tidak boleh lebih dari 2MB.',
            'produk_umkm.*.harga_terendah.required' => 'Harga terendah produk wajib diisi.',
            'produk_umkm.*.harga_tertinggi.required' => 'Harga tertinggi produk wajib diisi.',
            'produk_umkm.*.harga_terendah.regex' => 'Harga terendah harus berupa angka dengan maksimal dua desimal.',
            'produk_umkm.*.harga_tertinggi.regex' => 'Harga tertinggi harus berupa angka dengan maksimal dua desimal.',
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


    // halaman index admin persebaran UMKM
    public function index_admin()
    {
        $umkms = Umkm::all();
        $kecamatans = Kecamatan::with('potensiDesa')->get();
        $potensis = PotensiDesa::all();
        return view('admin.sumberdaya.persebaranUMKM.persebaranUMKM', compact('umkms', 'potensis', 'kecamatans'));
    }

    public function store_kecamatan(Request $request)
    {
        // Validasi request mengambil dari validateDesa
        $request->validate([
            'nama_kecamatan' => 'required|string|max:100',
        ]);

        dd($request->all());

        Kecamatan::create([
            'nama_kecamatan' => $request->nama_kecamatan,
        ]);

        return redirect()->back()->with('success', 'Kecamatan berhasil ditambahkan.');
    }

    public function update_kecamatan(Request $request, $id)
    {
        $request->validate([
            'nama_kecamatan' => 'required|string|max:100',
        ]);

        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->update([
            'nama_kecamatan' => $request->nama_kecamatan,
        ]);

        return redirect()->back()->with('success', 'Kecamatan berhasil diperbarui.');
    }


    public function delete_kecamatan($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->delete();

        return redirect()->back()->with('success', 'Kecamatan dan semua potensi terkait berhasil dihapus');
    }



    public function create_potensi($kecamatan_id)
    {
        $kecamatan = Kecamatan::find($kecamatan_id);
        return view('admin.sumberdaya.persebaranUMKM.tambahPotensi', compact('kecamatan'));
    }

    public function store_potensi(Request $request)
    {
        // Validasi request mengambil dari validateDesa
        $validatedData = $this->validatePotensi($request);

        // Menyimpan data kecamatan
        $potensi = PotensiDesa::create([
            'nama_potensi' => $request->input('nama_potensi'),
            'longitude' => $request->input('longitude'),
            'latitude' => $request->input('latitude'),
            'deskripsi_potensi' => $request->input('deskripsi_potensi'),
            'alamat' => $request->input('alamat'),
            'kecamatan_id' => $request->input('kecamatan_id'),
        ]);

        // Menyimpan potensi kecamatan
        foreach ($request->input('foto_potensis', []) as $key => $foto_potensis) {
            $potensiItem = new FotoPotensi();
            $potensiItem->potensi_desas_id = $potensi->id;
            // $potensiItem->nama_potensi = $foto_potensis['nama_potensi'] ?? '';
            $potensiItem->deskripsi_foto = $foto_potensis['deskripsi_foto'] ?? '';

            // Menyimpan gambar jika ada
            if ($request->hasFile('foto_potensis.' . $key . '.foto_potensi')) {
                $filePath = $this->savePhoto($request->file('foto_potensis.' . $key . '.foto_potensi'), 'fotoPotensi');
                $potensiItem->foto_potensi = $filePath;
            }
            $potensiItem->save();
        }

        // Menyimpan pesan sukses atau kesalahan di session flash
        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.persebaran')->with('success', 'Data potensi desa di dalam kecamatan berhasil disimpan');
        }
    }

    public function detail_potensi_admin($kecamatan_id, $potensi_id)
    {
        // Temukan kecamatan berdasarkan ID
        $kecamatan = Kecamatan::with(['potensiDesa' => function ($query) use ($potensi_id) {
            $query->where('id', $potensi_id); // Memfilter hanya berdasarkan id potensi yang diminta
        }])->findOrFail($kecamatan_id);


        // Temukan potensi desa berdasarkan ID
        $potensi = PotensiDesa::where('id', $potensi_id)
            ->where('kecamatan_id', $kecamatan_id)
            ->firstOrFail();

        return view('admin.sumberdaya.persebaranUMKM.detailPotensi', compact('kecamatan', 'potensi', 'potensi_id'));
    }


    public function edit_potensi($kecamatan_id, $potensi_id)
    {
        // Mengambil data PotensiDesa berdasarkan potensi_id
        $potensi = PotensiDesa::findOrFail($potensi_id);

        // Mengambil semua foto potensi yang terkait dengan potensi desa tersebut
        $fotoPotensis = FotoPotensi::where('potensi_desas_id', $potensi->id)->get();

        // Mengolah foto lama untuk mendapatkan path file
        $oldFotos = [];
        foreach ($fotoPotensis as $fotoPotensi) {
            if ($fotoPotensi->foto_potensi) {
                $oldFotos[$fotoPotensi->id] = 'fotoPotensi/' . basename($fotoPotensi->foto_potensi);
            }
        }

        // Mengambil data kecamatan berdasarkan kecamatan_id jika diperlukan
        $kecamatan = Kecamatan::findOrFail($kecamatan_id);

        // Mengirim data ke view
        return view('admin.sumberdaya.persebaranUMKM.editPotensi', compact('potensi', 'fotoPotensis', 'oldFotos', 'kecamatan'));
    }


    public function update_potensi(Request $request, $kecamatan_id, $potensi_id)
    {
        $validatedData = $this->validatePotensi($request);
        $potensi = PotensiDesa::findOrFail($potensi_id);

        // Update data potensi desa
        $potensi->update([
            'nama_potensi' => $request->input('nama_potensi'),
            'longitude' => $request->input('longitude'),
            'latitude' => $request->input('latitude'),
            'deskripsi_potensi' => $request->input('deskripsi_potensi'),
            'alamat' => $request->input('alamat'),
        ]);

        // Ambil semua ID foto potensi yang ada di database untuk potensi ini
        $existingFotoPotensiIds = $potensi->fotoPotensi->pluck('id')->toArray();

        // Proses data foto potensi
        $inputFotoPotensiIds = []; // Array untuk menyimpan ID dari foto potensi yang diinputkan

        foreach ($request->input('foto_potensis', []) as $key => $foto_potensis) {
            if (isset($foto_potensis['id'])) {
                // Jika ID ada, lakukan update
                $fotoPotensiItem = FotoPotensi::find($foto_potensis['id']);
                $inputFotoPotensiIds[] = $foto_potensis['id']; // Tambahkan ke array inputPotensiIds
            } else {
                // Jika tidak ada ID, tambahkan data baru
                $fotoPotensiItem = new FotoPotensi();
                $fotoPotensiItem->potensi_desas_id = $potensi->id;
            }

            $fotoPotensiItem->deskripsi_foto = $foto_potensis['deskripsi_foto'] ?? '';

            // Cek jika ada file foto potensi yang diupload
            if ($request->hasFile('foto_potensis.' . $key . '.foto_potensi')) {
                $filePath = $this->savePhoto($request->file('foto_potensis.' . $key . '.foto_potensi'), 'fotoPotensi');

                // Cek jika ada old_foto_potensi
                if (!empty($foto_potensis['old_foto_potensi'])) {
                    // Ambil nama foto lama dari form tanpa prefix 'fotoPotensi/'
                    $oldFotoName = basename($foto_potensis['old_foto_potensi']);

                    // Hapus foto lama dari direktori public/fotoPotensi jika nama foto lama ada
                    if (\Storage::exists('public/fotoPotensi/' . $oldFotoName)) {
                        \Storage::delete('public/fotoPotensi/' . $oldFotoName);
                    }
                }

                // Update foto potensi dengan file path baru
                $fotoPotensiItem->foto_potensi = $filePath;
            } else {
                // Jika tidak ada foto baru, periksa old_foto_potensi
                $fotoPotensiItem->foto_potensi = $foto_potensis['old_foto_potensi'] ?? $fotoPotensiItem->foto_potensi;
            }
            $fotoPotensiItem->save();
        }

        // Hapus foto potensi yang tidak ada dalam inputan (telah dihapus oleh pengguna)
        $fotoPotensiToDelete = array_diff($existingFotoPotensiIds, $inputFotoPotensiIds);
        FotoPotensi::whereIn('id', $fotoPotensiToDelete)->delete();

        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            // Redirect dengan menggunakan potensi_id
            return redirect()->route('admin.persebaran', $potensi->id)
                ->with('success', 'Data potensi desa berhasil diperbarui');
        }
    }

    public function delete_potensi($kecamatan_id, $potensi_id)
    {
        // Mengambil data potensi desa beserta foto-foto terkait berdasarkan ID potensi dan kecamatan
        $potensi = PotensiDesa::with('fotoPotensi')
            ->where('id', $potensi_id)
            ->where('kecamatan_id', $kecamatan_id)
            ->firstOrFail();

        // Hapus foto potensi dari storage jika ada, dan hapus data foto dari tabel FotoPotensi
        foreach ($potensi->fotoPotensi as $item) {
            if ($item->foto_potensi && \Storage::exists('public/' . $item->foto_potensi)) {
                \Storage::delete('public/' . $item->foto_potensi);
            }
            $item->delete();
        }
        $potensi->delete();
        return redirect()->route('admin.persebaran')->with('success', 'Potensi berhasil dihapus.');
    }


























    // kelola UMKM
    public function create_umkm($kecamatan_id)
    {
        $kecamatan = Kecamatan::find($kecamatan_id);
        return view('admin.sumberdaya.persebaranUMKM.tambahUMKM', compact('kecamatan'));
    }

    public function store_umkm(Request $request)
    {
        // Validasi request dari validateUmkm
        $validatedData = $this->validateUmkm($request);

        // Simpan UMKM
        $umkm = UMKM::create([
            'nama_umkm' => $request->input('nama_umkm'),
            'nama_pemilik' => $request->input('nama_pemilik'),
            'alamat_umkm' => $request->input('alamat_umkm'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'deskripsi_umkm' => $request->input('deskripsi_umkm'),
            'kontak' => $request->input('kontak'),
            'whatsapp' => $request->input('whatsapp'),
            'email' => $request->input('email'),
            'instagram' => $request->input('instagram'),
            'kecamatan_id' => $request->input('kecamatan_id'),
        ]);

        // Simpan produk terkait UMKM
        foreach ($request->input('produk_umkm', []) as $key => $produk_umkm) {
            $produkItem = new produkUmkm();
            $produkItem->umkm_id = $umkm->id;
            $produkItem->nama_produk = $produk_umkm['nama_produk'] ?? '';
            $produkItem->deskripsi_produk = $produk_umkm['deskripsi_produk'] ?? '';

            // Menyimpan foto produk jika ada
            if ($request->hasFile('produk_umkm.' . $key . '.foto_produk')) {
                $filePath = $this->savePhoto($request->file('produk_umkm.' . $key . '.foto_produk'), 'fotoProdukUmkm');
                $produkItem->foto_produk = $filePath;
            }

            $produkItem->harga_terendah = $produk_umkm['harga_terendah'] ?? '';
            $produkItem->harga_tertinggi = $produk_umkm['harga_tertinggi'] ?? '';
            $produkItem->save();
        }
        // Menyimpan pesan sukses atau kesalahan di session flash
        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.persebaran')->with('success', 'Data UMKM dan produk berhasil disimpan');
        }
    }

    public function edit_umkm($kecamatan_id, $umkm_id)
    {
        // Menghapus session sukses sebelumnya
        session()->forget('success');

        // Mengambil data UMKM berdasarkan umkm_id
        $umkm = Umkm::with('produkUmkm')->findOrFail($umkm_id);

        // Mengambil data kecamatan berdasarkan kecamatan_id
        $kecamatan = Kecamatan::findOrFail($kecamatan_id);

        // Mengolah deskripsi lama untuk mendapatkan foto produk
        $oldFotos = [];
        foreach ($umkm->produkUmkm as $produk) {
            if ($produk->foto_produk) {
                $oldFotos[$produk->id] = 'fotoProdukUMKM/' . basename($produk->foto_produk);
            }
        }

        // Mengirim data ke view
        return view('admin.sumberdaya.persebaranUMKM.editUmkm', compact('umkm', 'kecamatan', 'oldFotos'));
    }

    public function update_umkm(Request $request, $kecamatan_id, $umkm_id)
    {
        // Validasi request dari validateUmkm
        $validatedData = $this->validateUmkm($request);

        // Mengambil data UMKM berdasarkan umkm_id
        $umkm = Umkm::findOrFail($umkm_id);

        // Update data UMKM
        $umkm->update([
            'nama_umkm' => $request->input('nama_umkm'),
            'nama_pemilik' => $request->input('nama_pemilik'),
            'alamat_umkm' => $request->input('alamat_umkm'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'deskripsi_umkm' => $request->input('deskripsi_umkm'),
            'kontak' => $request->input('kontak'),
            'whatsapp' => $request->input('whatsapp'),
            'email' => $request->input('email'),
            'instagram' => $request->input('instagram'),
            'kecamatan_id' => $kecamatan_id,
        ]);

        // Ambil ID produk yang ada di database untuk UMKM ini
        $existingProductIds = $umkm->produkUmkm->pluck('id')->toArray();
        $inputProductIds = [];

        // Proses data produk UMKM
        foreach ($request->input('produk_umkm', []) as $key => $produkData) {
            if (isset($produkData['id'])) {
                // Update produk yang sudah ada
                $produkItem = ProdukUmkm::findOrFail($produkData['id']);
                $inputProductIds[] = $produkData['id'];
            } else {
                // Jika tidak ada ID, tambahkan data baru
                $produkItem = new produkUmkm();
                $produkItem->umkm_id = $umkm->id;
            }

            $produkItem->nama_produk = $produkData['nama_produk'];
            $produkItem->deskripsi_produk = $produkData['deskripsi_produk'];
            $produkItem->harga_terendah = $produkData['harga_terendah'];
            $produkItem->harga_tertinggi = $produkData['harga_tertinggi'];

            // Tangani upload foto produk
            if ($request->hasFile('produk_umkm.' . $key . '.foto_produk')) {
                $filePath = $this->savePhoto($request->file('produk_umkm.' . $key . '.foto_produk'), 'fotoProdukUmkm');

                // Hapus foto lama jika ada
                if (!empty($produkData['old_foto_produk'])) {
                    $oldFotoName = basename($produkData['old_foto_produk']);
                    if (\Storage::exists('public/fotoProdukUmkm/' . $oldFotoName)) {
                        \Storage::delete('public/fotoProdukUmkm/' . $oldFotoName);
                    }
                }
                $produkItem->foto_produk = $filePath;
            } else {
                // Jika tidak ada foto baru, gunakan foto lama jika ada
                $produkItem->foto_produk = $produkData['old_foto_produk'] ?? $produkItem->foto_produk;
            }
            $produkItem->save();
        }

        // Hapus produk yang tidak ada di inputan
        $productsToDelete = array_diff($existingProductIds, $inputProductIds);
        ProdukUmkm::whereIn('id', $productsToDelete)->delete();

        // Redirect dengan pesan sukses atau kesalahan
        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.persebaran', $umkm->id)->with('success', 'Update data UMKM berhasil disimpan');
        }
    }



    public function detail_umkm_admin($kecamatan_id, $umkm_id)
    {
        // Temukan kecamatan berdasarkan ID dan muat data UMKM terkait
        $kecamatan = Kecamatan::with(['umkm' => function ($query) use ($umkm_id) {
            $query->where('id', $umkm_id); // Memfilter berdasarkan id UMKM yang diminta
        }])->findOrFail($kecamatan_id);

        // Temukan UMKM berdasarkan ID dan kecamatan
        $umkm = Umkm::where('id', $umkm_id)
            ->where('kecamatan_id', $kecamatan_id)
            ->with('produkUmkm') // Muat data produk terkait UMKM
            ->firstOrFail();

        $instagramUrl = $umkm->instagram;
        $username = $this->extractInstagramUsername($instagramUrl);

        return view('admin.sumberdaya.persebaranUMKM.detailUmkm', compact('kecamatan', 'umkm', 'umkm_id', 'username'));
    }



    public function destroy_umkm($kecamatan_id, $umkm_id)
    {
        // Mengambil data UMKM beserta produk-produknya berdasarkan ID UMKM dan kecamatan
        $umkm = Umkm::with('produkUmkm')
            ->where('id', $umkm_id)
            ->where('kecamatan_id', $kecamatan_id)
            ->firstOrFail();

        // Hapus foto UMKM dari storage jika ada
        if ($umkm->foto_umkm && \Storage::exists('public/' . $umkm->foto_umkm)) {
            \Storage::delete('public/' . $umkm->foto_umkm);
        }

        // Hapus produk terkait UMKM
        foreach ($umkm->produkUmkm as $produk) {
            // Hapus foto produk dari storage jika ada
            if ($produk->foto_produk && \Storage::exists('public/' . $produk->foto_produk)) {
                \Storage::delete('public/' . $produk->foto_produk);
            }
            $produk->delete();
        }

        // Hapus data UMKM dari tabel Umkm
        $umkm->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.persebaran')->with('success', 'Data UMKM dan produk terkait berhasil dihapus.');
    }
}
