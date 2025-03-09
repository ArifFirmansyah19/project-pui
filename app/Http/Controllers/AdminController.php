<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{

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
            'password_lama' => ['required_with:password'],
            'password' => ['nullable', 'min:6', 'confirmed'],
        ], [
            'email.regex' => 'Alamat email harus diakhiri dengan .com, .net, .org, .edu, .gov, .mil, atau .int',
        ]);
        $user = auth()->user();
        if ($request->filled('password') && !Hash::check($request->password_lama, $user->password)) {
            throw ValidationException::withMessages([
                'password_lama' => 'Password yang Anda masukkan tidak cocok',
            ]);
        }

        if ($request->hasFile('foto')) {
            if ($user->foto && \Storage::exists('public/' . $user->foto)) {
                \Storage::delete('public/' . $user->foto);
            }

            $filePath = $request->file('foto')->store('users', 'public');
            $user->foto = $filePath;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'foto' => $user->foto,
        ]);

        // Update password hanya jika password baru diisi
        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }
        return redirect()->route('dashboard.admin')->with('success', 'Profil Admin Berhasil Diperbarui');
    }
}
