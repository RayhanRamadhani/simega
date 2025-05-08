<?php

use App\Http\Controllers\AdminDashboard;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListTaskController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use Symfony\Component\HttpKernel\Profiler\Profile;

//////////////// AUTH
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/chatbot', [ChatbotController::class, 'chatbot'])->name('chatbot');
    Route::post('/chatbot', 'App\Http\Controllers\ChatbotController');
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
    Route::get('/priority', [TaskController::class, 'index'])->name('priority');
    Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])->name('dashboardAdmin');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('task', TaskController::class);
    Route::resource('list-task', ListTaskController::class);
    Route::resource('pengguna', UserController::class);
    Route::resource('packages', PackageController::class);
    Route::get('/send-email', function(){
        \Mail::to(auth()->user()->email)->send(new \App\Mail\SendEmail());
        return redirect()->route('verify-email')->with('success', 'Kode OTP sudah dikirim, silakan cek email Anda.');})->name('send-email');
    Route::get('/verify-email', function ()
        {
        return view('auth.verify-email');})->name('verify-email');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp');
    Route::get('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend.otp');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');
    Route::patch('/tasks/{task}/toggle-priority', [TaskController::class, 'togglePriority'])
    ->name('task.toggle-priority');
    Route::patch('/list-task/{id}/toggle', [ListTaskController::class, 'toggleStatus'])->name('list-task.toggle');
    Route::get('/payment', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/details/{transaction}', [PaymentController::class, 'showDetails'])->name('payment.details');
    Route::get('/payment-checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('/payment-checkout/success/{transaction}', [PaymentController::class, 'success'])->name('payment.checkout.success');
    Route::get('/payment', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/details/{transaction}', [PaymentController::class, 'showDetails'])->name('payment.details');
    Route::get('/payment-checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('/payment-checkout/success/{transaction}', [PaymentController::class, 'success'])->name('payment.checkout.success');
});

//////////////// GUEST
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view ('homepage');
    });
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store']);
});
