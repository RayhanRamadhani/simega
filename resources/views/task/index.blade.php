@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex justify-between items-center w-full">
        <h1 class="text-2xl font-bold flex items-center space-x-2">
            <a href="/dashboard" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                <span>{{ $task->name }}</span>
            </a>
        </h1>
        <a onclick="toggleModal()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
            </svg>
        </a>
    </div>
    <br>
    <div class="flex mt-5 ml-7">
        <p>{{ $task->description }}</p>
    </div>
    <div class="flex mt-5 ml-7 inline-flex items-center w-fit">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-blue-500">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        <a href="{{ route('list-task.create', ['idtask' => $task->idtask]) }}" class="ml-4 text-blue-500">Tambah list tugas</a>
    </div>

    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
            <h2 class="text-lg font-semibold mb-4">Edit Tugas</h2>
            <form method="POST" action="{{ route('task.update', $task->idtask) }}">
                @csrf
                @method('PUT')
                <label class="block text-sm font-medium mb-1">Nama Tugas</label>
                <input type="text" name="name" value="{{ $task->name }}" class="w-full border border-gray-300 p-2 rounded mb-4" required>

                <label class="block text-sm font-medium mb-1">Deskripsi</label>
                <textarea name="description" class="w-full border border-gray-300 p-2 rounded mb-4" rows="4">{{ $task->description }}</textarea>

                <label class="block text-sm font-medium mb-1">Deadline</label>
                <input type="date" name="deadline" value="{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') : '' }}" class="w-full border border-gray-300 p-2 rounded mb-4">

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="toggleModal()" class="bg-gray-200 px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-4 ml-7">
        @foreach ($listTasks as $list)
            <div class="flex items-center space-x-3 my-2">
                <form action="{{ route('list-task.toggle', $list->id) }}" method="POST">
                @csrf
                @method('PATCH')
                    <button type="submit" class="flex items-center">
                        @if ($list->isdone)
                            <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        @else
                            <div class="w-5 h-5 border-2 border-black rounded-full"></div>
                        @endif
                    </button>
                </form>
                <span onclick="openModal({{ $list->id }})" class="cursor-pointer {{ $list->isdone ? 'line-through' : '' }}">
                    {{ $list->listname }}
                </span>

                <span style="margin-left: auto; color: gray;">
                    {{ $list->date }} {{ $list->time }}
                </span>
            </div>
            <div id="modal-{{ $list->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
                <div class="bg-white p-6 rounded shadow-md w-96 relative">
                    <button onclick="closeModal({{ $list->id }})" class="absolute top-2 right-3 text-gray-500 hover:text-black text-xl">&times;</button>
                    <h2 class="text-lg font-semibold mb-4">Detail List Tugas</h2>
                    <p><strong>Nama:</strong> {{ $list->listname }}</p>
                    <p><strong>Tanggal:</strong> {{ $list->date }}</p>
                    <p><strong>Waktu:</strong> {{ $list->time }}</p>
                    <p><strong>Status:</strong> {{ $list->isdone ? 'Selesai' : 'Belum selesai' }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('editModal');
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }

    function openModal(id) {
        document.getElementById('modal-' + id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById('modal-' + id).classList.add('hidden');
    }
    </script>
</div>

<div class="fixed bottom-0 right-4 flex flex-col items-center z-40">
    <div class="mb-1 px-4 py-1 rounded-full border text-sm font-semibold shadow bg-white text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-blue-600">
        Butuh bantuan?
    </div>
    <img src="{{ asset('images/bb.png') }}" alt="Help Bot" class="w-20 h-20 object-contain">
</div>
@endsection
