<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;

class KontakController extends Controller
{
    // untuk pengguna
    public function index()
    {
        $kontakExists = Kontak::exists();
        $kontak = Kontak::first();
        return view('user.kontak.kontak', compact('kontak', 'kontakExists'));
    }

    // untuk admin
    public function index_admin()
    {
        $kontakExists = Kontak::exists();
        $kontak = Kontak::first();
        session()->forget('success');
        return view('admin.kontak.kontak', compact('kontak', 'kontakExists'));
    }

    public function create_kontak()
    {
        return view('admin.kontak.createKontak');
    }

    public function store_kontak(Request $request)
    {
        // Cek Jika sudah ada data, maka akan dikembalikan ke halaman strukturOrganisasi
        if (Kontak::exists()) {
            return redirect(route('admin.kontak'))->withErrors('Data Kontak sudah ada. hanya diperbolehkan mengisi data Kontak satu kali');
        }
        $kontak = Kontak::create($request->all());
        $kontak->save();
        return redirect(route('admin.kontak'))->with('success', 'data berhasil ditambahkan');
    }

    public function update_kontak(Request $request, $id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->update($request->all());
        $kontak->save();
        return redirect(route('admin.kontak'))->with('success', 'kontak diupdate');
    }

    public function destroy_kontak($id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->delete();
        return redirect(route('admin.kontak'))->with('success', 'kontak dihapus');
    }
}
