<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tasks = Task::where('userid', $user->id)->get();

        $totaltugas = Task::where('userid', $user->id)->count();
        $listtugasselesai = Task::where('status', 'done')->count();
        // // dibawah ini harusnya list tugas, cuman belum ada databasenya?
        $sisalisttugas = Task::where('status', 'null')->count();
        
        $idtugas = Task::where('userid', $user->id)->get();
        $namatugas = Task::where('name', $user->name)->get();
        $deadlinetugas = Task::where('deadline', $user->deadline)->get();

        return view('dashboard', compact(
            'user',
            'totaltugas',
            'listtugasselesai',
            'sisalisttugas',
            'idtugas',
            'namatugas',
            'deadlinetugas',
            'tasks'
        ));
    }
}
