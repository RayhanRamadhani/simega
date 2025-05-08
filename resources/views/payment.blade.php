@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<title>Pembayaran</title>
<div class="container w-full h-auto">
    <div class="flex justify-left items-center" data-aos="fade-up" data-aos-duration="1500">
        <img src="{{ asset('images/roki.png') }}" alt="Maskot" class="w-32 h-30">
        <div class="ml-4 text-left">
            <h1 class="text-5xl font-bold">Hai,</h1>
            <h2 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-blue-500">{{ Auth::user()->firstname }}!</h2>
            <p class="text-gray-600 text-lg">Mau Nugas Apa Hari Ini?</p>
        </div>
    </div>
    <div class="flex justify-start">
        <h1>Pembayaran</h1>
        <div class="flex flex-col w-full md:w-1/2">
            <div>
                <h1>Nama Depan</h1>
                <p>{{ Auth::user()->firstname }}</p>
            </div>
            <div>
                <h1>Nama Belakang</h1>
                <p>{{ Auth::user()->lastname }}</p>
            </div>
        </div>
        <h1>Email</h1>
        <p>{{ Auth::user()->email }}</p>
        <h1>Alamat</h1>
        <p>Jl. Lohbener Lama</p>
    </div>
    <div class="flex">
        <button type="button" id="pay-button" class="flex flex-wrap bg-blue-400">Lanjut</button>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
          // SnapToken acquired from previous step
          snap.pay('{{ $transaction->snap_token }}', {
            // Optional
            onSuccess: function(result){
                window.location.href = "{{ route('payment.checkout.success', $transaction->id) }}";
            },
            // Optional
            onPending: function(result){
              /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onError: function(result){
              /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
          });
        };
      </script>
@endsection