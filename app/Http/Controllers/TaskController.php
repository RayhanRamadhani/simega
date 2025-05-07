<?php

namespace App\Http\Controllers;

use App\Models\Task;
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
    
            $user = User::find($user_id);
            if (is_null($user->email_verified_at)) {
                return redirect()->route('send-email');
            }
    
            $totaltugas = Task::where('userid', $user_id)->count();
            $listtugasselesai = Task::where('userid', $user_id)
                ->where('status', 'completed')
                ->count();
            $sisalisttugas = $totaltugas - $listtugasselesai;
    
            $chartData = [0, 2, 4, 6, 3, 8, $totaltugas];
            return view('dashboard', compact(
                'tasks',
                'totaltugas',
                'listtugasselesai',
                'sisalisttugas',
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
            $listtugasselesai = Task::where('userid', $user_id)
                ->where('status', 'completed')
                ->count();
            $sisalisttugas = $totaltugas - $listtugasselesai;
    
            $chartData = [0, 2, 4, 6, 3, 8, $totaltugas];
            return view('priority', compact(
                'tasks',
                'totaltugas',
                'listtugasselesai',
                'sisalisttugas',
                'chartData'
            ));
        }
        
    }

    public function create()
    {
        return view('task.create');
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
        if ($user->tier === 'free') {
            // Hitung total task yang belum completed
            $unfinishedCount = Task::where('userid', $user->id)
                ->where('status', '!=', 'completed') // Atau ->where('status', false) jika boolean
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
