@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <div class="flex justify-between items-center w-full">
        <h1 class="text-2xl font-bold flex items-center space-x-2">
            <span>Pembayaran</span>
        </h1>
    </div>
    <br>
    <br>
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
    <br>
    <div class="flex flex-col">
        <p class="text-lg font-semibold">Email</p>
        <p>{{ Auth::user()->email }}</p>
    </div>
    <br>
    <div class="flex flex-col">
        <p class="text-lg font-semibold">Alamat</p>
        <p>{{ Auth::user()->email }}</p>
    </div>
    <br>

    @php
    $pro = \App\Models\Package::where('name', 'Pro')->first();
    @endphp

    @if ($pro)
        <div class="flex flex-col items-end text-right text-blue-500">
            <p class="text-lg font-bold">Harga</p>
            @if ($pro->price > 0)
                <span>
                    Rp. {{ number_format($pro->price, 0, ',', '.') }}
                </span>
            @endif
        </div>
    @endif
    <br>
    <div class="flex items-center gap-x-4 justify-end w-full">
        <a href="/dashboard" class="text-black font-semibold">Batal</a>
        <button id="pay-button" type="submit" class="relative inline-flex items-center justify-center px-6 py-2 font-bold bg-gradient-to-r from-pink-500 to-blue-500 text-transparent bg-clip-text border border-blue-500 rounded-md hover:opacity-90">
            Lanjut
        </button>
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