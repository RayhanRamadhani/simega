<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $task = Task::where('userid', Auth::id())->latest()->first();
        return view('task.index', compact('task'));
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

        Task::create([
            'userid' => Auth::id(),
            'name' => $request->name,
            'deadline' => $request->deadline,
            'description' => $request->description
        ]);

        return redirect()->route('task.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function edit(Task $task)
    {
        return view('task.index', compact('task'));
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
        return redirect()->route('task.show')->with('success', 'Tugas berhasil dihapus.');
    }

    // function show()
    // {
    //     $user= Auth::user();
    //     return view('task');
    // }

}
