<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'photo' => 'nullable|image|max:2048',
            'address' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images', 'public');
            $user->photo = '/storage/' . $path;
        }

        $user->update($request->only('username', 'firstname', 'lastname', 'address'));

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    function show()
    {
        return view('profile');
    }
}
