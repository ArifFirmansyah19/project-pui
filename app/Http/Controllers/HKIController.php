<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HKI;
use App\Models\kontak;
// use Illuminate\Support\Facades\Storage;


class HKIController extends Controller
{
    // Untuk Controller HKI bagian Admin website

    protected function validateHKI(Request $request)
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file_path' => 'required|file|mimes:pdf|max:2048', // hanya file PDF yang diizinkan, maksimal 2MB
        ], [
            'judul.required' => 'Judul HKI wajib diisi.',
            'nama.required' => 'nama pemilik HKI wajib diisi.',
            'deskripsi.required' => 'Deskripsi HKI wajib diisi.',
            'file_path.required' => 'File PDF wajib diunggah.',
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
        return view('admin.sumberdaya.HKI.createHKI');
    }

    public function store_HKI(Request $request)
    {
        $validatedData = $this->validateHKI($request);

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
        $HKI = HKI::findOrFail($id);
        return view('admin.sumberdaya.HKI.editHKI', compact('HKI'));
    }


    public function update_HKI(Request $request, $id)
    {
        // Validasi data jika diperlukan
        $validatedData = $this->validateHKI($request);

        // Temukan data HKI berdasarkan ID
        $HKI = HKI::findOrFail($id);

        // Ambil path file lama dari database
        $oldFilePath = $HKI->file_path;
        // dd($request->all());

        // Variabel untuk menyimpan path file yang baru
        $newFilePath = $oldFilePath;

        // Jika ada file baru yang diupload
        if ($request->hasFile('file_path')) {
            // Simpan file baru ke storage dan ambil path-nya
            $newFilePath = $request->file('file_path')->store('hkiFiles', 'public');

            // Hapus file lama dari storage jika ada
            if ($oldFilePath) {
                // Path file lama untuk storage
                $oldFilePathForStorage = str_replace('storage/', 'public/', $oldFilePath);

                // Cek apakah file lama ada di storage
                if (\Storage::exists($oldFilePathForStorage)) {
                    // Hapus file lama
                    \Storage::delete($oldFilePathForStorage);
                }
            }

            // Ubah path file baru agar bisa diakses publik
            $newFilePath = str_replace('public/', 'storage/', $newFilePath);
        }

        // Update data HKI di database
        $HKI->update([
            'judul' => $request->judul,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'file_path' => $newFilePath,
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