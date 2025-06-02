<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Package;
use App\Models\Task;
use App\Models\ListTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

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

            // Setup data chart berdasarkan hari dalam seminggu
            $chartData = [];
            $dayNames = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            $dayShort = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];

            // Ambil awal minggu ini (Senin)
            $startOfWeek = Carbon::now()->startOfWeek();

            // Inisialisasi array untuk menyimpan data per hari
            for ($i = 0; $i < 7; $i++) {
                $currentDay = (clone $startOfWeek)->addDays($i);
                $dayIndex = $currentDay->dayOfWeek - 1; // 0 = Senin, 6 = Minggu
                if ($dayIndex < 0) $dayIndex = 6; // Koreksi untuk Carbon yang menganggap 0 = Minggu

                // Ambil tugas untuk hari ini
                $dailyTasks = Task::where('userid', $user_id)
                    ->whereDate('created_at', $currentDay->toDateString())
                    ->get();

                // Ambil list tugas untuk hari ini
                $dailyListTasks = ListTask::where('userid', $user_id)
                    ->whereDate('created_at', $currentDay->toDateString())
                    ->get();

                // Hitung tugas dan yang selesai
                $totalTasks = $dailyTasks->count();
                $completedListTasks = $dailyListTasks->where('isdone', true)->count();

                $chartData[] = [
                    'day' => $dayShort[$dayIndex],
                    'dayFull' => $dayNames[$dayIndex],
                    'date' => $currentDay->toDateString(),
                    'total' => $totalTasks,
                    'completed' => $completedListTasks
                ];
            }

            $totaltugas = Task::where('userid', $user_id)->count();
            $totallisttugas = ListTask::where('userid', $user_id)->count();
            $listtugasselesai = ListTask::where('userid', $user_id)
                ->where('isdone', true)
                ->count();
            $sisalisttugas11 = $totallisttugas - $listtugasselesai;
            $listtask = ListTask::where('userid', $user_id)->count();

            return view('dashboard', compact(
                'tasks',
                'totaltugas',
                'listtugasselesai',
                'sisalisttugas11',
                'chartData'
            ));
        }

        if ($request->route()->getName() == 'priority') {
            $user_id = Auth::id();

            // Ambil hanya tugas prioritas milik user yang sedang login
            $tasks = Task::where('userid', $user_id)
                ->where('ispriority', 1)
                ->get();

            $user = User::find($user_id);
            if (is_null($user->email_verified_at)) {
                return redirect()->route('send-email');
            }

            // Hitung hanya tugas dengan ispriority = true milik user ini
            $totaltugas = Task::where('userid', $user_id)
                ->where('ispriority', true)
                ->count();

            // Dapatkan ID dari semua tugas prioritas milik user
            $priorityTaskIds = Task::where('userid', $user_id)
                ->where('ispriority', true)
                ->pluck('idtask')
                ->toArray();

            // Hitung total list tugas untuk tugas prioritas user ini
            $totalListTasksPriority = ListTask::whereIn('idtask', $priorityTaskIds)->count();

            // Hitung list tugas yang selesai untuk tugas prioritas user ini
            $listtugasselesai = ListTask::whereIn('idtask', $priorityTaskIds)
                ->where('isdone', true)
                ->count();

            // Hitung sisa list tugas
            $sisalisttugas11 = $totalListTasksPriority - $listtugasselesai;

            $chartData = [];
            $dayNames = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            $dayShort = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];

            // Ambil awal minggu ini (Senin)
            $startOfWeek = Carbon::now()->startOfWeek();

            // Inisialisasi array untuk menyimpan data per hari
            for ($i = 0; $i < 7; $i++) {
                $currentDay = (clone $startOfWeek)->addDays($i);
                $dayIndex = $currentDay->dayOfWeek - 1; // 0 = Senin, 6 = Minggu
                if ($dayIndex < 0) $dayIndex = 6;

                // Ambil HANYA tugas prioritas milik user untuk hari ini
                $dailyTasks = Task::where('userid', $user_id)
                    ->where('ispriority', true)
                    ->whereDate('created_at', $currentDay->toDateString())
                    ->get();

                $priorityTaskIds = $dailyTasks->pluck('idtask')->toArray();

                // Ambil list tugas dari tugas prioritas milik user
                $dailyListTasks = ListTask::whereIn('idtask', $priorityTaskIds)
                    ->whereDate('created_at', $currentDay->toDateString())
                    ->get();

                $totalTasks = $dailyTasks->count();
                $completedListTasks = $dailyListTasks->where('isdone', true)->count();

                $chartData[] = [
                    'day' => $dayShort[$dayIndex],
                    'dayFull' => $dayNames[$dayIndex],
                    'date' => $currentDay->toDateString(),
                    'total' => $totalTasks,
                    'completed' => $completedListTasks
                ];
            }

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
