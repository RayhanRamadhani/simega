@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Riwayat Transaksi</h2>

    <div class="bg-white shadow-md rounded-xl p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Daftar Riwayat Transaksi Pembelian Langganan</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-blue-400 text-white">
                        <th class="py-2 px-4 rounded-tl-lg text-center">Id Transaksi</th>
                        <th class="py-2 px-4 text-center">Id User</th>
                        <th class="py-2 px-4 text-center">Harga</th>
                        <th class="py-2 px-4 text-center rounded-tr-lg">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @forelse ($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 text-center">{{ $transaction->id }}</td>
                            <td class="py-2 px-4 text-center">{{ $transaction->user_id }}</td>
                            <td class="py-2 px-4 text-center">{{ $transaction->price }}</td>
                            <td class="py-2 px-4 text-center">{{ $transaction->status }}</td>
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
            @foreach ($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                @if ($page == $transactions->currentPage())
                    <span class="text-blue-500 font-semibold">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="hover:underline">{{ $page }}</a>
                @endif
            @endforeach
        </div>

    </div>
</div>
@endsection
