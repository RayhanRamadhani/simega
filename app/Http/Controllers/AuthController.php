<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Laravel\Prompts\text;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;

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
            'email' => 'email tidak sesuai',
        ])->onlyInput('email');
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regeneratetoken();
        return redirect('login');
    }
}
