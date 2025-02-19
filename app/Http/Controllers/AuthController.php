<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Menampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Membuat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    // Proses login menggunakan session
    public function login(Request $request)
    {
        // Validasi email dan password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Coba login menggunakan session
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $user = Auth::user();

            // Jika role user adalah admin, arahkan ke halaman home
            if ($user->role == 'admin') {
                return redirect()->route('home');
            }

            // Jika bukan admin, arahkan ke halaman lain atau tampilkan pesan
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors(['email' => 'Incorrect email or password.']);
    }

    // Logout dan hapus session
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
