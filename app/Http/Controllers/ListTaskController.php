<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ListTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListTaskController extends Controller
{
        public function index($idtask)
    {
        $task = Task::findOrFail($idtask);
        $listTasks = $task->listTasks()->latest()->get();

        return view('task.index', compact('task', 'listTasks'));
    }

    public function create(Request $request)
    {
        $task = Task::findOrFail($request->idtask);
        return view('list_task.create', compact('task'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'listname' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'description' => 'nullable',
        ]);

        $user = Auth::user();
        $task = Task::findOrFail($request->idtask);

        // Hitung jumlah list task yang sudah dibuat untuk task ini
        $existingListCount = $task->listTasks()->count();

        // Jika tier akun free dan sudah ada 5 list task, tolak
        if ($user->tier === 'free' && $existingListCount >= 5) {
            return redirect()->back()->with('error', 'Akun free hanya dapat membuat maksimal 5 list task.');
        }

        // Jika lolos pengecekan, simpan data
        ListTask::create([
            'idtask' => $request->idtask,
            'listname' => $request->listname,
            'date' => $request->date,
            'time' => $request->time,
            'description' => $request->description,
        ]);

        return redirect()->route('task.edit', $request->idtask)->with('success', 'List tugas berhasil ditambahkan.');
    }

    // public function edit($id)
    // {
    //     $listTask = ListTask::findOrFail($id);
    //     return view('list_task.edit', compact('listTask'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'listname' => 'required',
    //         'date' => 'required|date',
    //         'time' => 'required',
    //         'description' => 'nullable',
    //     ]);

    //     $listTask = ListTask::findOrFail($id);
    //     $listTask->update($request->only('listname', 'date', 'time', 'description'));

    //     return redirect('/task')->with('success', 'List Tugas berhasil diperbarui.');
    // }

    public function destroy($id)
    {
        $listTask = ListTask::findOrFail($id);
        $listTask->delete();

        return redirect('/task')->with('success', 'List Tugas berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $list = ListTask::findOrFail($id);
        $list->isdone = !$list->isdone;
        $list->save();

        return back();
    }
}
