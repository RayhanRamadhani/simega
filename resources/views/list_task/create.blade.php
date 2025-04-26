@extends('layouts.app')

@section('content')
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <form action="{{ route('task.store')}}" method="POST" class="bg-white rounded-2xl shadow-lg w-[90%] max-w-md p-6 relative">
        @csrf
        <label class="block mb-4">
            <span class="text-lg font-semibold">Nama tugas</span>
            <input type="text" name="name" class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Masukkan nama tugas" required>
        </label>
        <label class="block mb-4">
            <span class="text-sm font-semibold">Tanggal Deadline</span>
            <input type="date" name="deadline" class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </label>
        <label class="block mb-6">
            <span class="text-sm font-semibold">Deskripsi</span>
            <textarea name="description" rows="3" class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Tulis deskripsi tugas..."></textarea>
        </label>
        <div class="flex justify-between">
            <a href="/dashboard" class="text-gray-700 font-medium hover:underline">Batal</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-full font-semibold shadow">
                Selesai
            </button>
        </div>
    </form>
</div>
@endsection
