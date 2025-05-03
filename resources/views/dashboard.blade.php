@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<title>Dashboard</title>
<div class="container">
    <div class="flex justify-left items-center">
        <img src="{{ asset('images/roki.png') }}" alt="Maskot" class="w-32 h-30">
        <div class="ml-4 text-left">
            <h1 class="text-5xl font-bold">Hai,</h1>
            <h2 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-blue-500">{{ Auth::user()->firstname }}!</h2>
            <p class="text-gray-600 text-lg">Mau Nugas Apa Hari Ini?</p>
        </div>
    </div>
    <div class="grid align-center row-span-2 items-center mt-8 rounded-xl shadow-xl bg-red-100">
        <div>
            <h1 class="text-5xl justify-left">Statistik Mingguan</h1>
        </div>
        <div class="grid justify-center col-span-full items-center mt-8 bg-green-300">
            <div class="bg-gray-500 rounded-xl">
                <canvas id="myChart"></canvas>
            </div>
            <div class="bg-gray-200">
                <li>3 Total Tugas</li>
                <li>3 List tugas diselesaikan</li>
                <li>3 Sisa list tugas</li>
            </div>
            <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                  type: 'line',
                  data: {
                    labels: ['S', 'S', 'R', 'K', 'J', 'S', 'M'],
                    datasets: [{
                      label: 'Eoeoeoeo',
                      data: [12, 19, 3, 5, 2, 3],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }
                });
              </script>
        </div>

    </div>
</div>

<a href="{{ route('chatbot') }}" class="fixed bottom-0 right-4 flex flex-col items-center z-40 group">
    <div class="mb-1 px-4 py-1 rounded-full border border-blue-500 text-sm font-semibold shadow bg-white text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-blue-600 transition-all group-hover:scale-105">
        Butuh bantuan?
    </div>
    <img src="{{ asset('images/bb.png') }}" alt="Help Bot" class="w-24 h-20 object-contain">
</a>

@endsection
