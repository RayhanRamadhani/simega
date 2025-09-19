<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email'=> 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan');
        }

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        $resetLink = url('/reset-password/'. $token);

        Mail::raw("Klik link ini untuk reset password akun anda : $resetLink", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Reset Password');
        });

        return back()->with('success', 'Link reset password telah dikirim ke email');
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'token' => 'required'
        ]);

    $reset = DB::table('password_resets')
        ->where('email', $request->email)
        ->where('token', $request->token)
        ->first();

    if (!$reset) {
        return back()->with('error', 'Token tidak valid atau kadaluarsa');
    }

    User::where('email', $request->email)->update([
        'password' => Hash::make($request->password)
    ]);

    DB::table('password_resets')->where('email', $request->email)->delete();

    return redirect('/login')->with('success', 'Password berhasil direset, silakan login');
    }
}
