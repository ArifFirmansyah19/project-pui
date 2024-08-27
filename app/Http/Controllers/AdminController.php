<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    // Menampilkan halaman profil admin
    public function profile_admin()
    {
        return view('admin.edit-admin.profil_admin');
    }

    // Menampilkan halaman edit profil admin
    public function edit_profile_admin()
    {
        return view('admin.edit-admin.edit_admin');
    }

    // Memperbarui profil admin
    public function update_profile_admin(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                'string',
                'min:3',
                'max:50',
                'unique:users,email,' . auth()->id(),
                'regex:/^[\w\.-]+@[a-zA-Z\d\.-]+\.(com|net|org|edu|gov|mil|int)$/i' // Validasi email dengan domain tertentu
            ],
            'name' => ['required', 'string', 'min:3', 'max:50', 'alpha_num'],
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'email.regex' => 'Alamat email harus diakhiri dengan .com, .net, .org, .edu, .gov, .mil, atau .int',
        ]);


        $user = auth()->user();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && \Storage::exists('public/' . $user->foto)) {
                \Storage::delete('public/' . $user->foto);
            }

            // Simpan foto baru
            $filePath = $request->file('foto')->store('users', 'public');
            $user->foto = $filePath;
        }

        // Update nama dan email
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'foto' => $user->foto, // update foto jika ada perubahan
        ]);

        return redirect()->route('dashboard.admin')->with('message', 'Profil admin berhasil diubah');
    }

    // Menampilkan halaman edit password admin
    public function edit_password_admin()
    {
        return view('admin.edit-admin.edit_password');
    }

    // Memperbarui password admin
    public function update_password_admin(Request $request)
    {
        $request->validate([
            'password_lama' => ['required'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        if (Hash::check($request->password_lama, auth()->user()->password)) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
            return redirect()->route('dashboard.admin')->with('message', 'Password Anda berhasil diubah');
        }

        throw ValidationException::withMessages([
            'password_lama' => 'Password yang Anda masukkan tidak cocok',
        ]);
    }
}
