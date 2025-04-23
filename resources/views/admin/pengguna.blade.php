@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Pengguna</h2>

    <div class="bg-white shadow-md rounded-xl p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Daftar pengguna</h3>
            <div class="flex items-center gap-3">
                <button class="text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2H3V4zM3 8h18M6 12h12M9 16h6" />
                    </svg>
                </button>
                <button class="text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-blue-400 text-white">
                        <th class="py-2 px-4 rounded-tl-lg">No</th>
                        <th class="py-2 px-4">Nama</th>
                        <th class="py-2 px-4">Username</th>
                        <th class="py-2 px-4">Role</th>
                        <th class="py-2 px-4">Email</th>
                        <th class="py-2 px-4 rounded-tr-lg">Tanggal daftar</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @foreach ($users as $index => $user)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4">{{ $index + 1 }}</td>
                            <td class="py-2 px-4">{{ $user->firstname }}</td>
                            <td class="py-2 px-4">@{{ $user->username }}</td>
                            <td class="py-2 px-4 capitalize">{{ $user->role }}</td>
                            <td class="py-2 px-4">{{ Str::limit($user->email, 15, '...') }}</td>
                            <td class="py-2 px-4">{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4 flex justify-center text-blue-500">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
