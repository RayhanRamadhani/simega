<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Package;
use App\Models\Task;
use App\Models\ListTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if ($request->route()->getName() == 'dashboard') {
            $user_id = Auth::id();
            $tasks = Task::where('userid', $user_id)->get();
            $taskid = $request->input('idtask');
            $listTasks = ListTask::where('idtask', $taskid)->get();


            $user = User::find($user_id);
            if (is_null($user->email_verified_at)) {
                return redirect()->route('send-email');
            }

            $totaltugas = $tasks->count();
            $listtugasselesai = $listTasks->where('isdone', '1')->count();
            $sisalisttugas = $totaltugas - $listtugasselesai;
            $startDate = now()->subDays(6)->startOfDay();
            $endDate = now()->endOfDay();

            $tasksLast7Days = Task::where('userid', $user_id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get();

            $chartData = [];
            for ($i = 0; $i < 7; $i++) {
                $date = now()->subDays(6 - $i)->format('Y-m-d');
                $dailyTasks = $tasksLast7Days->where('created_at', '>=', Carbon::parse($date)->startOfDay())
                    ->where('created_at', '<=', Carbon::parse($date)->endOfDay());

                $total = $dailyTasks->count();
                $completed = $dailyTasks->where('isdone', 'true')->count();
                $remaining = $total - $completed;

                $chartData[] = [
                    'date' => $date,
                    'total' => $total,
                    'completed' => $completed,
                    'remaining' => $remaining,
                ];
            }

            $totaltugas = Task::where('userid', $user_id)->count();
            $totallisttugas = ListTask::where('userid', $user_id)->count();
            $listtugasselesai = ListTask::where('userid', $user_id)
                ->where('isdone', true);
            $sisalisttugas11 = $totallistlisttugas - $listtugasselesai;
            $listtask = ListTask::where('userid', $user_id)->count();

            $chartData = [0, 2, 4, 6, 3, 8, $totaltugas];
            return view('dashboard', compact(
                'tasks',
                'totaltugas',
                'listtugasselesai',
                'sisalisttugas1111',
                'chartData'
            ));
        }

        if ($request->route()->getName() == 'priority') {
            $user_id = Auth::id();
            $tasks = Task::where('ispriority', 1)->get();

            $user = User::find($user_id);
            if (is_null($user->email_verified_at)) {
                return redirect()->route('send-email');
            }

            $totaltugas = Task::where('userid', $user_id)->count();
            $listtugasselesai = ListTask::where('userid', $user_id)
                ->where('isdone', true)
                ->count();
            $sisalisttugas11 = $totaltugas - $listtugasselesai;

            $chartData = [0, 2, 4, 6, 3, 8, $totaltugas];
            return view('priority', compact(
                'tasks',
                'totaltugas',
                'listtugasselesai',
                'sisalisttugas11',
                'chartData'
            ));
        }

    }

    public function create()
    {
        $user = Auth::user();
        $taskLimitReached = false;

        if ($user->tier === 'FREE') {
            $unfinishedCount = Task::where('userid', $user->id)
                ->where('status', '!=', 'completed')
                ->count();

            $taskLimitReached = $unfinishedCount >= 3;
        }

        $packages = Package::all();

        return view('task.create', compact('taskLimitReached', 'packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'deadline' => 'required|date',
            'description' => 'required',
        ]);

        $user = Auth::user();

        // Logika pembatasan task untuk user free
        if ($user->tier === 'FREE') {
            $unfinishedCount = Task::where('userid', $user->id)
                ->where('status', '!=', 'completed')
                ->count();

            if ($unfinishedCount >= 3) {
                return redirect()->route('dashboard')->with('error', 'Akun Free hanya dapat memiliki maksimal 3 tugas aktif. Selesaikan tugas lama untuk menambah tugas baru.');
            }
        }

        // Simpan task
        Task::create([
            'userid' => $user->id,
            'name' => $request->name,
            'deadline' => $request->deadline,
            'description' => $request->description,
            'status' => false,
            'ispriority' => false,
        ]);

        return redirect()->route('dashboard')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function edit($idtask)
    {
        $task = Task::findOrFail($idtask);
        $listTasks = $task->listTasks()->latest()->get();

        return view('task.index', compact('task', 'listTasks'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->userid !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'deadline' => 'required|date',
            'description' => 'required',
        ]);

        $task->update([
            'name' => $request->name,
            'deadline' => $request->deadline,
            'description' => $request->description,
        ]);

        return redirect()->route('task.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Tugas berhasil dihapus.');
    }

    public function togglePriority(Task $task)
    {
        $task->ispriority = !$task->ispriority;
        $task->save();

        return back();
    }

}
