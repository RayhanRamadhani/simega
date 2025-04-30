@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex justify-between items-center w-full">
        <h1 class="text-2xl font-bold flex items-center space-x-2">
            <a href="/dashboard" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                <span>Profile</span>
            </a>
        </h1>
        <a href="/"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
        </svg></a>
    </div>
    <br>
    <div class="flex items-start gap-5">
        <img src="{{ Auth::user()->photo }}" class="w-24 h-24 rounded-full border-4 border-gray-500" alt="Profile Picture">
        @php $user = Auth::user(); @endphp
        @if($user->tier === 'pro')
            <button class="border border-blue-500 text-blue-500 px-4 py-1 rounded-lg">PRO</button>
            <p class="text-base text-blue-400">Sampai 26/06/2026</p>
        @else
            <span class="border border-gray-400 text-gray-600 px-4 py-1 rounded-lg">{{ Auth::user()->tier }}</span>
        @endif
    </div>
    <br>
    <div class="flex flex-col">
        <p class="text-lg font-semibold">Username</p>
        <p>{{ Auth::user()->username }}</p>
    </div>
    <div class="flex gap-32">
        <div>
          <p class="text-lg font-semibold">Nama Depan</p>
          <p>{{ Auth::user()->firstname }}</p>
        </div>
        <div>
          <p class="text-lg font-semibold">Nama Belakang</p>
          <p>{{ Auth::user()->lastname }}</p>
        </div>
    </div>
    <div class="flex flex-col">
        <p class="text-lg font-semibold">Email</p>
        <p>{{ Auth::user()->email }}</p>
    </div>
    <br>
    <br>
    <div class="flex items-center gap-x-2">
        <a href="/logout" class="flex items-center text-red-600 hover:text-red-800">
            <svg xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24"
                 fill="currentColor"
                 class="w-5 h-5">
                <path fill-rule="evenodd" d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z" clip-rule="evenodd" />
            </svg>
            <span>Logout</span>
        </a>
    </div>
</div>
@endsection
