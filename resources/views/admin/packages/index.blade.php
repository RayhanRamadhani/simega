@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-6">Paket Berlangganan</h2>

    <div class="bg-white shadow-md rounded-xl p-6">
        <h3 class="text-xl font-semibold mb-6">Daftar Paket</h3>

        <div class="flex gap-6">
            @foreach ($packages as $package)
                <div class="relative w-1/2 p-4 rounded-xl shadow {{ $package->name == 'Pro' ? 'border-2 border-pink-400' : 'border border-gray-200' }}">
                    <h4 class="text-2xl font-bold">
                        @if ($package->name == 'Pro')
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-blue-500">
                                {{ $package->name }}
                            </span>
                        @else
                            <span class="text-gray-800">
                                {{ $package->name }}
                            </span>
                        @endif
                        @if ($package->price > 0)
                            <span class="text-gray-400 text-sm font-normal block">
                                Rp. {{ number_format($package->price, 0, ',', '.') }}/ 12 Bln
                            </span>
                        @endif
                    </h4>
                    <ul class="mt-4 space-y-2">
                        @foreach ($package->features as $feature)
                            <li class="flex items-start gap-2">
                                @if ($package->name == 'Pro')
                                    <svg class="w-5 h-5 text-pink-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                @else
                                    <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                @endif
                                <span class="text-gray-800">{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <a onclick="openModal({{ $package }})" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>

        <div id="modalEdit" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 hidden z-50">
            <div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-md relative">
                <form id="modalForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <h2 class="text-2xl font-bold">Nama paket</h2>
                        <p id="modalName" class="mt-2 text-gray-800"></p>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Durasi paket (bulan)</label>
                        <div class="flex items-center space-x-2 text-gray-800">
                            <span id="modalDuration"></span>
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
                            id="modalPrice"
                            class="w-full text-gray-800 bg-transparent focus:outline-none border-b border-gray-300 focus:border-blue-500"
                            required
                        />
                    </div>

                    <div class="mb-6">
                        <label class="block font-semibold mb-1">Deskripsi</label>
                        <div id="modalFeatures" class="text-gray-800 whitespace-pre-line"></div>
                    </div>

                    <div class="flex justify-between items-center pt-4">
                        <button type="button" onclick="closeModal()" class="text-gray-700 font-semibold">Batal</button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-12 rounded-xl">
                            Selesai
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
    function openModal(packageData) {
        document.getElementById('modalName').innerText = packageData.name;
        document.getElementById('modalDuration').innerText = packageData.duration_month;
        document.getElementById('modalPrice').value = packageData.price;

        let featuresHtml = "";
        if(packageData.features){
            packageData.features.forEach(f => {
                featuresHtml += f + '\n';
            });
        }
        document.getElementById('modalFeatures').innerText = featuresHtml;

        const form = document.getElementById('modalForm');
        form.action = `/packages/${packageData.id}`;

        document.getElementById('modalEdit').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modalEdit').classList.add('hidden');
    }
    </script>
    </div>
</div>
@endsection
