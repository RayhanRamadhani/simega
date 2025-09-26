<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%");
            });
        }

        if ($request->has('sort')) {
        $query->orderBy('username', $request->sort === 'desc' ? 'desc' : 'asc');
        }

        $pengguna = $query->latest()->paginate(5);

        return view('admin.pengguna', compact('pengguna'))->with('filters', $request->only(['search', 'role']));
    }
}
