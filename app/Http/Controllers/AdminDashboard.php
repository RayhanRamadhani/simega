<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboard extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalpengguna = User::count();
        $penggunapro = User::where('tier', 'pro')->count();
        $penggunamendaftar = User::whereDate('created_at', '>=', now()->startOfWeek())->count();

        $pendaftarperhari = collect(range(0, 6))->map(function($day) {
            $date = Carbon::now()->startOfWeek()->addDays($day);
            return User::whereDate('created_at', $date)->count();
        })->toArray();

        return view('admin.dashboard', compact(
            'user',
            'totalpengguna',
            'penggunapro',
            'penggunamendaftar',
            'pendaftarperhari'
        ));
    }
}
