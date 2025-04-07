<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Perbaiki penulisan 'Str'
use App\Models\User;

class AuthController extends Controller
{
    function login() {
        return view('login');
    }

    function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    function register()
    {
        return view('register');
    }

    function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
        ]);

        // Membuat username acak yang unik
        do {
            $randomUsername = Str::random(10); // Menghasilkan username acak sepanjang 10 karakter
        } while (User::where('username', $randomUsername)->exists()); // Memastikan username unik

        // Membuat user baru
        $user = User::create([
            'firstname' => $request->firstname, // Menggunakan firstname
            'lastname' => $request->lastname,   // Menggunakan lastname
            'username' => $randomUsername, // Menyimpan username acak
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password yang telah di-hash
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke halaman login setelah berhasil registrasi
        return redirect('/login');
    }
}
