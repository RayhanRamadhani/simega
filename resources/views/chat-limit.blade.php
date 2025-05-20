@extends('layouts.app')

@section('content')
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-[90%] p-6 text-center relative">
        <h2 class="text-2xl font-bold text-red-600 mb-4">Kuota Chat Habis!</h2>
        <img src="{{ asset('images/roki1.png') }}" alt="Rakun" class="w-28 mx-auto my-4">
        <p class="mb-6 text-gray-700">Kamu telah mencapai batas penggunaan fitur chatbot. Dengan berlangganan paket premium, kamu bisa mengobrol dengan Roki tanpa batas!</p>
        
        <div class="flex justify-center gap-4 text-left text-sm">
            @foreach ($packages as $package)
                <div class="border {{ $package->name === 'Pro' ? 'border-blue-500' : '' }} rounded-xl p-4 w-1/2 shadow">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-bold text-lg
                            {{ $package->name === 'Pro' ? 'bg-gradient-to-r from-pink-500 to-blue-500 text-transparent bg-clip-text' : '' }}">
                            {{ $package->name }}
                            @if ($package->price > 0)
                                <span class="line-through text-sm text-gray-400">
                                    Rp. {{ number_format($package->price, 0, ',', '.') }}/12 bln
                                </span>
                            @endif
                        </h3>
                        @if ($package->name === 'Pro')
                            <button onclick="openModal()" class="bg-pink-500 text-white px-4 py-1 rounded-full text-sm hover:bg-pink-600">
                                Beli
                            </button>
                        @endif
                    </div>

                    <ul class="mt-4 space-y-2">
                        @foreach ($package->features as $feature)
                            <li class="flex items-start gap-2">
                                @if ($package->name === 'Pro')
                                    <svg class="w-5 h-5 text-pink-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                @endif
                                <span class="text-gray-800">{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <a href="{{ route('dashboard') }}" class="mt-6 inline-block text-gray-600 hover:underline font-bold">Kembali ke Dashboard</a>
    </div>
</div>

<div id="checkoutModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-[90%] p-6 text-center relative">
        <h2 class="text-2xl font-bold bg-gradient-to-r from-pink-500 to-blue-500 text-transparent bg-clip-text">Pro</h2>
        <img src="{{ asset('images/roki1.png') }}" alt="Rakun" class="w-28 mx-auto my-4">
        <p class="text-gray-700 text-sm mb-4">
            Dengan berlangganan paket Pro SIMEGA, kamu akan mendapatkan:
            <br>- Chat dengan Roki tanpa batas
            <br>- Lebih banyak tugas yang bisa dibuat
            <br>- Fitur premium lainnya
        </p>
        <a href="{{ route("payment.process")}}" class="border border-blue-500 inline-block w-40 py-2 rounded-full font-bold bg-gradient-to-r from-pink-500 to-blue-500 text-transparent bg-clip-text shadow hover:opacity-90 transition">
            Checkout
        </a>
        <button onclick="closeModal()" class="block mt-4 mx-auto hover:underline">Kembali</button>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('checkoutModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('checkoutModal').classList.add('hidden');
    }
</script>
@endsection