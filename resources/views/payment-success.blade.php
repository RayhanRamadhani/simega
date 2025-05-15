@extends('layouts.app')

@section('content')
<title>Payment Successfull</title>
<div class="flex justify-center bg-white">
    <div class="text-center p-6">
        <h1 class="text-2xl font-bold mb-6">Pembayaran berhasil!</h1>
        <img src="{{ asset('images/lucu.png') }}" alt="Maskot" class="mx-auto mb-6 w-48">
        <p class="text-gray-700 text-lg mb-8">
            Pembayaran kamu berhasil, nikmati manfaat berlangganan dengan SIMEGA!<br>
            Klik tombol lanjut di bawah ini untuk berpindah halaman atau halaman otomatis teralihkan dalam <span id="countdown">10</span> detik.
        </p>
        <a href="{{ route('dashboard') }}">
            <button class="bg-blue-400 text-white font-semibold px-6 py-2 rounded-xl shadow hover:bg-blue-600 transition">
                Lanjut
            </button>
        </a>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        let counter = 10;
        const countdownEl = document.getElementById('countdown');

        const interval = setInterval(() => {
            counter--;
            countdownEl.textContent = counter;
            if (counter <= 0) {
                clearInterval(interval);
                window.location.href = "{{ route('dashboard') }}";
            }
        }, 1000);
    });
</script>
@endsection
