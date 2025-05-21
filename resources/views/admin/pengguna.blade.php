@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Pengguna</h2>

    <div class="bg-white shadow-md rounded-xl p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Daftar pengguna</h3>

            <form method="GET" action="" class="flex gap-2">
                <a href="{{ request()->fullUrlWithQuery(['sort' => request('sort') === 'asc' ? 'desc' : 'asc']) }}" class="text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2H3V4zM3 8h18M6 12h12M9 16h6" />
                    </svg>
                </a>
                <input type="text" name="search" placeholder="Cari pengguna..." value="{{ request('search') }}" class="border border-gray-300 rounded-md px-3 py-1" />
                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                    Cari
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-blue-400 text-white text-left">
                        <th class="py-2 px-4 rounded-tl-lg">Id</th>
                        <th class="py-2 px-4">Nama Depan</th>
                        <th class="py-2 px-4">Nama Belakang</th>
                        <th class="py-2 px-4">Username</th>
                        <th class="py-2 px-4">Email</th>
                        <th class="py-2 px-4">Tier</th>
                        <th class="py-2 px-4 rounded-tr-lg">Tanggal daftar</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @forelse ($pengguna as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4">{{ $user->id }}</td>
                            <td class="py-2 px-4">{{ $user->firstname }}</td>
                            <td class="py-2 px-4">{{ $user->lastname }}</td>
                            <td class="py-2 px-4">{{ $user->username }}</td>
                            <td class="py-2 px-4">{{ $user->email }}</td>
                            <td class="py-2 px-4">{{ $user->tier }}</td>
                            <td class="py-2 px-4">{{ $user->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-blue-500">Data pengguna tidak tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4 flex justify-center space-x-4 text-black">
            @foreach ($pengguna->getUrlRange(1, $pengguna->lastPage()) as $page => $url)
                @if ($page == $pengguna->currentPage())
                    <span class="text-blue-500 font-semibold">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="hover:underline">{{ $page }}</a>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
