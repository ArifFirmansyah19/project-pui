<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HKI;
use App\Models\kontak;
// use Illuminate\Support\Facades\Storage;


class HKIController extends Controller
{
    // Untuk Controller HKI bagian Admin website

    protected function validateHKI(Request $request, $isUpdate = false)
    {
        $rules = [
            'judul' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ];

        // Tambahkan validasi file_path sesuai kondisi store atau update
        if ($isUpdate) {
            // Jika update, file_path boleh nullable
            $rules['file_path'] = 'nullable|file|mimes:pdf|max:2048';
        } else {
            // Jika store, file_path wajib diupload
            $rules['file_path'] = 'required|file|mimes:pdf|max:2048';
        }

        return $request->validate($rules, [
            'judul.required' => 'Judul HKI wajib diisi.',
            'nama.required' => 'Nama pemilik HKI wajib diisi.',
            'deskripsi.required' => 'Deskripsi HKI wajib diisi.',
            'file_path.required' => 'File HKI wajib diupload.',
            'file_path.file' => 'Input harus berupa file.',
            'file_path.mimes' => 'File harus berupa PDF.',
            'file_path.max' => 'Ukuran file maksimal 2MB.',
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

        // Mengunggah file PDF ke storage 'public/hkiFiles'
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('hkiFiles', 'public');
        }

        $HKIs = HKI::create([
            'judul' => $request->judul,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath,
        ]);

        $HKIs->save();

        // Menyimpan pesan sukses atau kesalahan di session flash
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

        // Ambil nilai old_file_path dari request (hidden input)
        $oldFilePath = $request->input('old_file_path');

        // Cek apakah ada file baru yang diunggah
        if ($request->hasFile('file_path')) {
            $newFile = $request->file('file_path');

            // Simpan file baru ke storage dan dapatkan path-nya
            $newFilePath = $newFile->store('hkiFiles', 'public');

            // Hapus file lama jika ada file baru
            if ($oldFilePath && \Storage::exists('public/' . $oldFilePath)) {
                \Storage::delete('public/' . $oldFilePath);
            }

            // Simpan path file baru ke database
            $HKI->file_path = $newFilePath;
        } else {
            // Jika tidak ada file baru, gunakan nilai dari old_file_path (hidden input)
            $HKI->file_path = $oldFilePath;
        }

        // Update data lainnya
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
        // Cek apakah file ada di storage, dan jika ada hapus dari storage
        if (\Storage::exists('public/' . $hki->file_path)) {
            \Storage::delete('public/' . $hki->file_path);
        }

        $hki->delete();

        return redirect()->route('admin.HKI')->with('success', 'Data HKI berhasil dihapus.');
    }



    // Untuk Controller HKI bagian pengguna website
    public function index_HKI()
    {
        $HKIExists = HKI::exists();
        $HKIs = HKI::orderBy('created_at', 'desc')->paginate(10);
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        return view('user.sumberdaya.HKI.HKIUser', compact('HKIExists', 'HKIs', 'kontak', 'kontakExists'));
    }

    public function detail_HKI($id)
    {
        $HKI = HKI::findOrFail($id);
        $kontak = Kontak::first();
        $kontakExists = Kontak::exists();
        return view('user.sumberdaya.HKI.detailHKI', compact('kontak', 'kontakExists', 'HKI'));
    }
}
