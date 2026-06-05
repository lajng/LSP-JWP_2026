<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login'); 
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|email', // Kita sebut 'username' di form, tapi isinya wajib email
            'password' => 'required',
        ], [
            'username.required' => 'Email gak boleh kosong, jon!',
            'username.email' => 'Format email-nya yang bener dong.',
            'password.required' => 'Password-nya diisi dulu.',
        ]);

        $loginData = [
            'email' => $credentials['username'],
            'password' => $credentials['password'],
            'is_active' => 1
        ];

        if (Auth::attempt($loginData, $request->has('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'username' => 'Email/Password salah, atau akun lu belum aktif, jon.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
