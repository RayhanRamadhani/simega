<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'price' => 'required|integer',
        ]);

        $package->update([
            'price' => $request->price,
        ]);

        return redirect()->route('packages.index')->with('success', 'Paket berhasil diperbarui.');
    }
}
