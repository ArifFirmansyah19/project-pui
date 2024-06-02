<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin/login.login', [
            'title' => 'Login',
            'active'=> 'Login'
        ]);
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/dashboard');
        }
        return redirect()->route('login')->with('failed', 'login gagal');
      // return back()->with('LoginError', 'Login Gagal');
     // dd('login berhasil');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function forgot_password(){
        return view('admin/login.lupaPassword');
    }

    public function forgot_password_act(Request $request)
    {
        $customMessage = [
            'email.required'=> 'email tidak boleh kosong',
            'email.email'=> 'email tidak valid',
            'email.exists'=> 'email tidak valid',
        ];

        $token = Str::random(60);

        PasswordResetToken::updateOrCreate(
            [
                'email'=>$request->email,
            ],
            [
                'email'=> $request->email,
                'token'=> $token,
                'created_at'=> now(),
            ]
        );

        Mail::to($request->email)->send(new ResetPasswordMail($token));

        $request->validate([
            'email'=>'required|email|exists:users,email'
        ], $customMessage);

        // $data = [
        //     'email'=> $request-> email
        // ];
        return redirect()->route('forgot-password')->with('succes', 'kami telah mengirimkan link reset password ke email anda');
    }
    
   
    public function validasi_forgot_password(Request $request, $token)
    {
        $getToken = PasswordResetToken::where('token', $token)->first();
        if(!$getToken){
            return redirect()->route('login')->with('failed', 'Token tidak valid');
        }
        return view('admin/login.validasi-token', compact('token'));
    }

   
    public function validasi_forgot_password_act(Request $request)
    {
        $customMessage = [
            'password.required'=> 'password tidak boleh kosong',
            'password.min'=> 'password minimal 6 karakter',
        ];

        $request->validate([
            'password'=>'required|min:6'
        ], $customMessage);

        $token = PasswordResetToken::where('token', $request->token)->first();

        if(!$token){
            return redirect()->route('login')->with('failed', 'Token tidak valid');
        }

        $user =User::where('email', $token->email)->first();
        if(!$user){
            return redirect()->route('login')->with('failed', 'email tidak valid');
        }

        $user->update([
            'password'=>bcrypt($request->password)
        ]);

        $token -> delete();
        
        return redirect()->route('login')->with('succes', 'password berhasil dirubah');
    }
}
