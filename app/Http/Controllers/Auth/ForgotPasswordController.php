<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    // Tampilkan form forgot password
    public function showForgotForm()
    {
        return view('admin.auth.forgot_password');
    }

    // Kirim email reset password
    public function sendResetLink(Request $request)
    {
        // Validasi email
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email tidak terdaftar.'
        ]);

        // Generate token
        $token = Str::random(64);

        // Simpan token ke database (tabel password_resets)
        \DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        // Kirim email ke user
        Mail::send('admin.emails.password_reset', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });

        return back()->with('success', 'Link reset password telah dikirim ke email Anda.');
    }

    public function showResetForm($token)
    {
        return view('auth.reset_password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required',
        ]);

        // Cek token
        $reset = \DB::table('password_resets')->where('token', $request->token)->first();

        if (!$reset || $reset->email != $request->email) {
            return back()->withErrors(['email' => 'Token reset password tidak valid.']);
        }

        // Update password
        $user = User::where('email', $request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        // Hapus token reset
        \DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect('/login')->with('success', 'Password berhasil direset.');
    }
}
