@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex justify-left items-center">
        <img src="{{ asset('images/roki.png') }}" alt="Maskot" class="w-32 h-30">
        <div class="ml-4 text-left">
            <h1 class="text-5xl font-bold">Hai,</h1>
            <h2 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-blue-500">{{ Auth::user()->name }}!</h2>
            <p class="text-gray-600 text-lg">Mau Nugas Apa Hari Ini?</p>
        </div>
    </div>
</div>
@endsection
