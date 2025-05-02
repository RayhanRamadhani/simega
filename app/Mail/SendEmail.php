<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct()
    {
        $user = Auth::user();

        $this->data = [
            'name'  => $user->firstname,
            'body'  => 'Hai! Ini adalah email verifikasi, silahkan salin kode OTP di bawah ini untuk verifikasi akun SIMEGA kamu:',
            'otp'   => $user->otp,
            'body2' => 'Kode ini berlaku selama 5 menit',
        ];
    }

    public function build()
    {
        return $this
            ->subject('Kode OTP')
            ->view('auth.sendemail')
            ->with('data', $this->data);
    }
}