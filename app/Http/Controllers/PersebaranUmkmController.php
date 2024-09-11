<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\umkm;
use App\Models\desaPotensi;
use App\Models\PotensiDesa;
use App\Models\produkUmkm;

class PersebaranUmkmController extends Controller
{

    protected function validateDesa(Request $request)
    {
        return $request->validate([
            'nama_desa' => 'required|string|max:255',
            'deskripsi_desa' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'potensi_desa.*.nama_potensi' => 'required|string|max:255',
            'potensi_desa.*.foto_potensi' => 'nullable|file|mimes:jpg,png|max:2048',
            'potensi_desa.*.deskripsi_potensi' => 'required|string|max:255',
        ], [
            'nama_desa.required' => 'Nama desa wajib diisi.',
            'deskripsi_desa.required' => 'Deskripsi desa wajib diisi.',
            'latitude.required' => 'Latitude wajib diisi. Klik lokasi desa pada peta',
            'longitude.required' => 'Longitude wajib diisi. Klik lokasi desa pada peta',
            'potensi_desa.*.nama_potensi.required' => 'Nama potensi wajib diisi.',
            'potensi_desa.*.foto_potensi.mimes' => 'Foto potensi harus dalam format JPG atau PNG.',
            'potensi_desa.*.foto_potensi.max' => 'Ukuran file foto potensi tidak boleh lebih dari 2MB.',
            'potensi_desa.*.deskripsi_potensi.required' => 'Deskripsi potensi wajib diisi.',
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
            'foto_umkm' => 'nullable|file|mimes:jpg,png|max:2048',
            'deskripsi_umkm' => 'required|string',
            'kontak' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'instagram' => 'nullable|string|max:255',
            'desa_potensi_id' => 'required|exists:desa_potensis,id',
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
            'foto_umkm.mimes' => 'Foto UMKM harus dalam format JPG atau PNG.',
            'foto_umkm.max' => 'Ukuran file foto UMKM tidak boleh lebih dari 2MB.',
            'deskripsi_umkm.required' => 'Deskripsi UMKM wajib diisi.',
            'kontak.required' => 'Kontak UMKM wajib diisi.',
            'kontak.max' => 'Kontak UMKM tidak boleh lebih dari 20 karakter.',
            'whatsapp.max' => 'Nomor WhatsApp tidak boleh lebih dari 15 karakter.',
            'email.email' => 'Format email tidak valid.',
            'desa_potensi_id.required' => 'Desa potensi wajib dipilih.',
            'desa_potensi_id.exists' => 'Desa potensi yang dipilih tidak valid.',
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

    // halaman index admin persebaran UMKM
    public function index_admin()
    {
        $umkms = umkm::all();
        $desas = DesaPotensi::with('potensiDesa')->get();
        return view('admin.sumberdaya.persebaranUMKM.persebaranUMKM', compact('umkms', 'desas'));
    }

    // kelola desa dan potensi
    public function create_desa_potensi()
    {
        return view('admin.sumberdaya.persebaranUMKM.tambahDesa');
    }

    public function store_desa_potensi(Request $request)
    {
        // Validasi request mengambil dari validateDesa
        $validatedData = $this->validateDesa($request);

        // Menyimpan data desa
        $desa = desaPotensi::create([
            'nama_desa' => $request->input('nama_desa'),
            'deskripsi_desa' => $request->input('deskripsi_desa'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        // Menyimpan potensi desa
        foreach ($request->input('potensi_desa', []) as $key => $potensi_desa) {
            $potensiItem = new PotensiDesa();
            $potensiItem->desa_potensi_id = $desa->id;
            $potensiItem->nama_potensi = $potensi_desa['nama_potensi'] ?? '';
            $potensiItem->deskripsi_potensi = $potensi_desa['deskripsi_potensi'] ?? '';

            // Menyimpan gambar jika ada
            if ($request->hasFile('potensi_desa.' . $key . '.foto_potensi')) {
                $filePath = $this->savePhoto($request->file('potensi_desa.' . $key . '.foto_potensi'), 'fotoPotensiDesa');
                $potensiItem->foto_potensi = $filePath;
            }
            $potensiItem->save();
        }
        // Menyimpan pesan sukses atau kesalahan di session flash
        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.persebaran')->with('success', 'Data desa dan potensi berhasil disimpan');
        }
    }

    public function detail_desa_admin($id)
    {
        $desa = desaPotensi::with('potensiDesa')->findOrFail($id);
        return view('admin.sumberdaya.persebaranUMKM.detailDesa', compact('desa'));
    }

    public function edit_desa_potensi($id)
    {
        // Mengambil data desa berdasarkan ID
        $desa = DesaPotensi::findOrFail($id);
        // Mengambil data potensi desa yang terkait dengan desa tersebut
        $potensiDesas = PotensiDesa::where('desa_potensi_id', $desa->id)->get();

        // Mengolah deskripsi lama untuk mendapatkan gambar
        $oldFotos = [];
        foreach ($potensiDesas as $potensi) {
            if ($potensi->foto_potensi) {
                $oldFotos[$potensi->id] = 'fotoPotensiDesa/' . basename($potensi->foto_potensi);
            }
        }
        session()->forget('success');
        return view('admin.sumberdaya.persebaranUMKM.editDesa', compact('desa', 'potensiDesas', 'oldFotos'));
    }

    public function update_desa_potensi(Request $request, $id)
    {
        // Validasi request mengambil dari validateDesa
        $validatedData = $this->validateDesa($request);

        // Update data desa
        $desa = DesaPotensi::findOrFail($id);
        $desa->update([
            'nama_desa' => $request->input('nama_desa'),
            'deskripsi_desa' => $request->input('deskripsi_desa'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        // Ambil semua ID potensi desa yang ada di database untuk desa ini
        $existingPotensiIds = $desa->potensiDesa->pluck('id')->toArray();

        // Proses data potensi desa
        $inputPotensiIds = []; // Array untuk menyimpan ID dari potensi yang diinputkan

        foreach ($request->input('potensi_desa', []) as $key => $potensi_desa) {
            if (isset($potensi_desa['id'])) {
                // Jika ID ada, lakukan update
                $potensiItem = PotensiDesa::find($potensi_desa['id']);
                $inputPotensiIds[] = $potensi_desa['id']; // Tambahkan ke array inputPotensiIds
            } else {
                // Jika tidak ada ID, tambahkan data baru
                $potensiItem = new PotensiDesa();
                $potensiItem->desa_potensi_id = $desa->id;
            }
            $potensiItem->nama_potensi = $potensi_desa['nama_potensi'] ?? '';
            $potensiItem->deskripsi_potensi = $potensi_desa['deskripsi_potensi'] ?? '';

            // Cek jika ada file foto potensi yang diupload
            if ($request->hasFile('potensi_desa.' . $key . '.foto_potensi')) {
                $filePath = $this->savePhoto($request->file('potensi_desa.' . $key . '.foto_potensi'), 'fotoPotensiDesa');

                // Cek jika ada old_foto_potensi
                if (!empty($potensi_desa['old_foto_potensi'])) {
                    // Ambil nama foto lama dari form tanpa prefix 'fotoPotensiDesa/'
                    $oldFotoName = basename($potensi_desa['old_foto_potensi']);

                    // Hapus foto lama dari direktori public/fotoPotensiDesa jika nama foto lama ada
                    if (\Storage::exists('public/fotoPotensiDesa/' . $oldFotoName)) {
                        \Storage::delete('public/fotoPotensiDesa/' . $oldFotoName);
                    }
                }

                // Update foto potensi dengan file path baru
                $potensiItem->foto_potensi = $filePath;
            } else {
                // Jika tidak ada foto baru, periksa old_foto_potensi
                $potensiItem->foto_potensi = $potensi_desa['old_foto_potensi'] ?? $potensiItem->foto_potensi;
            }
            $potensiItem->save();
        }

        // Hapus potensi desa yang tidak ada dalam inputan (telah dihapus oleh pengguna)
        $potensiToDelete = array_diff($existingPotensiIds, $inputPotensiIds);
        PotensiDesa::whereIn('id', $potensiToDelete)->delete();

        // Menyimpan pesan sukses atau kesalahan di session flash
        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect()->route('admin.persebaran')->with('success', 'Data desa dan potensi berhasil diperbarui');
        }
    }


    // kelola UMKM
    public function create_umkm()
    {
        $desas = desaPotensi::all();
        return view('admin.sumberdaya.persebaranUMKM.tambahUMKM', compact('desas'));
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
            'desa_potensi_id' => $request->input('desa_potensi_id'),
        ]);

        if ($request->hasFile('foto_umkm')) {
            $umkm->foto_umkm = $this->savePhoto($request->file('foto_umkm'), 'fotoUmkm');
            $umkm->save();
        }
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

    public function edit_umkm($id)
    {
        // Mengambil data UMKM berdasarkan ID
        $umkm = Umkm::with('produkUmkm')->findOrFail($id);

        // Mengolah deskripsi lama untuk mendapatkan foto produk
        $oldFotos = [];
        foreach ($umkm->produkUmkm as $produk) {
            if ($produk->foto_produk) {
                $oldFotos[$produk->id] = 'fotoProdukUMKM/' . basename($produk->foto_produk);
            }
        }
        $desas = DesaPotensi::all();
        session()->forget('success');
        return view('admin.sumberdaya.persebaranUMKM.editUmkm', compact('umkm', 'desas', 'oldFotos'));
    }

    public function update_umkm(Request $request, $id)
    {
        // Validasi request dari validateUmkm
        $validatedData = $this->validateUmkm($request);

        // Update data UMKM
        $umkm = Umkm::findOrFail($id);

        // Tangani upload foto UMKM
        if ($request->hasFile('foto_umkm')) {
            // Hapus foto lama jika ada
            if ($umkm->foto_umkm && \Storage::exists('public/' . $umkm->foto_umkm)) {
                \Storage::delete('public/' . $umkm->foto_umkm);
            }

            $filePath = $this->savePhoto($request->file('foto_umkm'), 'fotoUmkm');
            $umkm->foto_umkm = $filePath;
        }

        // Update data UMKM (termasuk foto jika ada perubahan)
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
            'desa_potensi_id' => $request->input('desa_potensi_id'),
        ]);

        // Ambil ID produk yang ada di database untuk UMKM ini
        $existingProductIds = $umkm->produkUmkm->pluck('id')->toArray();
        $inputProductIds = [];

        // Proses data produk UMKM
        foreach ($request->input('produk_umkm', []) as $key => $produkData) {
            if (isset($produkData['id'])) {
                // Update produk yang sudah ada
                $produkItem = ProdukUMKM::findOrFail($produkData['id']);
                $inputProductIds[] = $produkData['id']; // Tambahkan ID ke array inputProductIds

            } else {
                // Jika tidak ada ID, tambahkan data baru
                $produkItem = new ProdukUMKM();
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
        ProdukUMKM::whereIn('id', $productsToDelete)->delete();

        // Menyimpan pesan sukses atau kesalahan di session flash
        if ($request->session()->has('errors')) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            return redirect(route('admin.persebaran'))->with('success', 'Update data UMKM berhasil disimpan');
        }
    }


    public function detail_umkm_admin($id)
    {
        $umkm = umkm::with('produkUmkm', 'desaPotensi')->findOrFail($id);
        return view('admin.sumberdaya.persebaranUMKM.detailPersebaran', compact('umkm'));
    }


    public function destroy_umkm($id)
    {
        $umkm = Umkm::with('produkUmkm')->findOrFail($id);

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
        $umkm->delete();
        return redirect()->route('admin.persebaran')->with('success', 'Data UMKM dan produk terkait berhasil dihapus');
    }
}
