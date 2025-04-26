@extends('layouts.admin')

@section('content')
<title>Dashboard</title>

<div class="px-4 py-6 md:px-8 md:py-8">
    <div class="flex flex-row items-center justify-start mb-8">
        <img src="{{ asset('images/roki.png') }}" alt="Maskot" class="w-32 h-auto mb-4 md:mb-0">
        <div class="ml-6 md:ml-6 text-left md:text-left">
            <h1 class="text-4xl md:text-5xl font-bold">Hai,</h1>
            <h2 class="text-4xl md:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-blue-500">{{ Auth::user()->username }}!</h2>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-xl flex flex-row items-center justify-between w-full mx-auto">
        <div class="flex flex-col w-full md:w-1/2">
            <h2 class="text-xl font-semibold mb-4">Statistik Mingguan</h2>
            <div class="relative w-full h-32">
                <canvas id="lineChart" class="absolute top-0 left-0 w-full h-full"></canvas>
            </div>
            <div class="flex justify-between mt-2 text-xs font-medium text-gray-600">
                <span>S</span>
                <span>S</span>
                <span>R</span>
                <span>K</span>
                <span>J</span>
                <span>S</span>
                <span class="text-blue-500 font-bold">M</span>
            </div>
        </div>
        <div class="flex flex-col mt-6 md:mt-0 md:ml-6 space-y-4 w-full md:w-1/2">
            <div class="flex items-center justify-end">
                <div class="text-3xl font-extrabold mr-2">{{ $totalpengguna }}</div>
                <div class="text-base font-bold text-black">Total pengguna</div>
            </div>
            <div class="flex items-center justify-end">
                <div class="text-3xl font-extrabold text-blue-400 mr-2">{{ $penggunapro }}</div>
                <div class="text-base font-bold text-blue-400">Pengguna Pro</div>
            </div>
            <div class="flex items-center justify-end">
                <div class="text-3xl font-extrabold mr-2">{{ $penggunamendaftar }}</div>
                <div class="text-base font-bold text-black">Pengguna mendaftar diminggu ini</div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      const ctx = document.getElementById('lineChart').getContext('2d');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['S', 'S', 'R', 'K', 'J', 'S', 'M'],
          datasets: [{
            data: @json($pendaftarperhari),
            borderColor: '#3B82F6',
            backgroundColor: 'transparent',
            tension: 0.5,
            pointRadius: 0,
            borderWidth: 2,
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { display: false },
          },
          scales: {
            x: { display: false },
            y: { display: false },
          }
        }
      });
    </script>
</div>
@endsection
