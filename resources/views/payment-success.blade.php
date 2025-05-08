@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<title>Pembayaran Sukses!</title>
<div class="container w-full h-auto">
    <div class="flex justify-left items-center" data-aos="fade-up" data-aos-duration="1500">
        <img src="{{ asset('images/roki.png') }}" alt="Maskot" class="w-32 h-30">
        <div class="ml-4 text-left">
            <h1 class="text-5xl font-bold">Hai,</h1>
            <h2 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-blue-500">{{ Auth::user()->firstname }}!</h2>
            <p class="text-gray-600 text-lg">Mau Nugas Apa Hari Ini?</p>
        </div>
    </div>
    <div class="flex bg-green-50">
        <h1 class=" text-green-500">Pembayaranmu berhasil!</h1>
        <p>Pembayaran telah berhasil</p>
        <a href="{{ route('dashboard') }}">
          <button>
            Kembali ke Dashboard
          </button>
        </a>
    </div>
</div>
@endsection