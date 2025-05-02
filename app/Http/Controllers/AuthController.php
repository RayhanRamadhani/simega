<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
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
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else {
                if ($user->email_verified_at === null) {
                    return redirect()->route('send-email')->with('error', 'Kode OTP sudah dikirim, silakan cek email Anda.');
                } else {
                    return redirect()->intended('/dashboard');
                }
            }
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
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
        ]);

        do {
            $randomUsername = Str::random(10);
        } while (User::where('username', $randomUsername)->exists());

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $randomUsername,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => random_int(100000, 999999),
            'otp_expired_at' => Carbon::now()->addMinutes(5),
            'email_expired_at' => null,
            'role' => 'user',
        ]);

        Auth::login($user);

        if (is_null($user->email_verified_at)) {
            return redirect()->route('send-email');
        }

        return redirect()->route('dashboard');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        $user = Auth::user();
        
        if ($user->otp != $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid']);
        }
        
        if (Carbon::now()->isAfter($user->otp_expired_at)) {
            return back()->withErrors(['otp' => 'Yah, kode OTPnya sudah kadaluarsa, silakan kirim ulang']);
        } else {
            $user->email_verified_at = Carbon::now();
            $user->save();
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        
        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silahkan login dengan akun yang telah Anda buat.');
    }
}
