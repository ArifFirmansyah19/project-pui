<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Notifications\AdminResetPasswordNotification;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $admin = User::where('email', $request->email)->first();

        if ($admin) {
            $token = app('auth.password.broker')->createToken($admin);
            $admin->notify(new AdminResetPasswordNotification($token));
            return back()->with('status', 'Reset link sent to your email.');
        }

        return back()->withErrors(['email' => 'Email address not found.']);
    }

    public function showResetForm($token)
    {
        return view('admin.auth.passwords.reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::broker('users')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($admin, $password) {
                $admin->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                Auth::guard('users')->login($admin);
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('admin.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
