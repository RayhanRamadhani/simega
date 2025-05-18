<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use App\Models\ListTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tasks = Task::where('userid', $user->id)->with('listtasks')->get();
        $listTasks = ListTask::whereIn('idtask', $tasks->pluck('idtask'))->get();

        $totaltugas = Task::where('userid', $user->id)->count();
        $listtugasselesai = ListTask::where('userid', $user->id)->and('status', 'done')->count();
        $sisalisttugas = ListTask::where('userid', $user->id)->count();

        $idtugas = Task::where('userid', $user->id)->get();
        $namatugas = Task::where('name', $user->name)->get();
        $deadlinetugas = Task::where('deadline', $user->deadline)->get();


        return view('dashboard', compact(
            'user',
            'sisalisttugas',
            'totaltugas',
            'listtugasselesai',
            'idtugas',
            'namatugas',
            'deadlinetugas',
            'tasks',
            'listTasks'
        ));
    }
}
