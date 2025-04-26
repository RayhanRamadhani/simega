@extends('layouts.admin')

@section('content')
<!-- Background abu transparan -->
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-50">
    <!-- Modal Box -->
    <div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-md">
        <form method="POST" action="{{ route('packages.update', $package) }}">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <h2 class="text-2xl font-bold">Nama paket</h2>
                <p class="mt-2 text-gray-800">{{ old('name', $package->name) }}</p>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Durasi paket (bulan)</label>
                <div class="flex items-center space-x-2 text-gray-800">
                    <span>{{ old('duration_month', $package->duration_month) }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6 2a1 1 0 00-1 1v1H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2h-.003V3a1 1 0 10-2 0v1H8V3a1 1 0 00-1-1zM4 8h12v8a1 1 0 01-1 1H5a1 1 0 01-1-1V8z" />
                    </svg>
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Harga</label>
                <input
                    type="number"
                    name="price"
                    value="{{ old('price', $package->price) }}"
                    class="w-full text-gray-800 bg-transparent focus:outline-none border-b border-gray-300 focus:border-blue-500"
                    required
                />
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-1">Deskripsi</label>
                <div class="text-gray-800 whitespace-pre-line">
                    @foreach(old('features', $package->features ?? []) as $feature)
                        {{ $feature }}
                    @endforeach
                </div>
            </div>

            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('packages.index') }}" class="text-gray-700 font-semibold">Batal</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-12 rounded-xl">
                    Selesai
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
