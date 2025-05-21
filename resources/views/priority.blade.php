@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<title>Priority</title>
<div class="container w-full h-auto">
  <div class="flex justify-left items-center" data-aos="fade-up" data-aos-duration="1500">
    <img src="{{ asset('images/roki.png') }}" alt="Maskot" class="w-32 h-30">
    <div class="ml-4 text-left">
        <h1 class="text-5xl font-bold">Hai,</h1>
        <h2 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-blue-500">{{ Auth::user()->firstname }}!</h2>
        <p class="text-gray-600 text-lg">Mau Nugas Apa Hari Ini?</p>
    </div>
  </div>
  <div class="bg-white p-6 rounded-2xl shadow-xl flex flex-row items-center justify-between w-full mx-auto" data-aos="fade-up" data-aos-duration="2000">
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
    <div class="flex flex-col mt-6 md:mt-0 md:ml-6 space-y-4 w-500">
    </div>
    <div class="flex flex-col mt-6 md:mt-0 md:ml-6 space-y-4 w-full md:w-1/2">
        <div class="flex items-start justify-start">
            <div class="text-3xl font-extrabold mr-2">{{ $totaltugas }}</div>
            <div class="text-base font-bold text-black">Total tugas</div>
        </div>
        <div class="flex items-center justify-start">
            <div class="text-3xl font-extrabold text-blue-400 mr-2">{{ $listtugasselesai }}</div>
            <div class="text-base font-bold text-blue-400">List tugas diselesaikan</div>
        </div>
        <div class="flex items-center justify-start">
            <div class="text-3xl font-extrabold mr-2">{{ $sisalisttugas11 }}</div>
            <div class="text-base font-bold text-black">Sisa list tugas</div>
        </div>
    </div>
  </div>

  {{-- DIV TUGAS --}}
  <div class="flex flex-row flex-wrap mt-4 p-3 justify-content-start w-full mx-auto gap-4">
    @forelse ($tasks as $task)
    <div class="task-card mt-4 p-6 rounded-2xl shadow-xl w-full md:w-5/12 lg:w-3/12 h-auto bg-white cursor-pointer"
         onclick="window.location='{{ route('task.edit', $task->idtask) }}'"
         data-task-id="{{ $task->idtask }}">
      <div class="flex justify-between items-center">
        <div class="flex items-center gap-2">
          <h1 class="font-bold">{{ $task->name }}</h1>

          <form action="{{ route('task.toggle-priority', $task->idtask) }}" method="POST" class="inline" onclick="event.stopPropagation()">
            @csrf
            @method('PATCH')
            <button type="submit" class="focus:outline-none">
              @if($task->ispriority)
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 text-blue-500 hover:text-blue-700">
                  <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                </svg>
              @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 hover:text-blue-500">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>
              @endif
            </button>
          </form>
        </div>
        <p>{{ $task->status ? '100%' : '0%' }}</p>
      </div>

      <div class="flex justify-between">
        @php
          $today = \Carbon\Carbon::today();
          $deadline = \Carbon\Carbon::parse($task->deadline);
          $isDeadlineToday = $today->isSameDay($deadline);
        @endphp

        @if($isDeadlineToday)
          <h2 class="font-semibold text-red-500 animate-blink">Deadline hari ini</h2>
        @else
          <h2 class="font-semibold text-gray-300">Deadline {{ $deadline->format('d M Y') }}</h2>
        @endif
      </div>

      <div class="flex flex-col mt-2 justify-start p-3 bg-blue-100 rounded-2xl">
        <ul class="list-disc pl-5 space-y-1">
            @forelse ($task->listTasks as $list)
                <li>{{ $list->listname }}</li>
             @empty
                <li>Tidak ada list tugas.</li>
            @endforelse
        </ul>
      </div>

      <div class="flex mt-3 justify-end">
        <form action="{{ route('task.destroy', $task->idtask) }}" method="POST" class="inline" onclick="event.stopPropagation()">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Yakin ingin menghapus?')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>
          </button>
        </form>
      </div>
    </div>
    @empty
      <div class="w-full justify-items-center text-center p-8">
        <img src="{{ asset('images/rokiberdiricutted.png') }}" alt="Maskot" class="w-32 h-30">
        <p class="text-gray-500">Tidak ada tugas yang di prioritaskan!</p>
      </div>
    @endforelse
  </div>

  <script>
    // Ambil data chart dari controller
    const chartData = @json($chartData);

    // Ekstrak label dan data
    const labels = chartData.map(item => item.day);
    const totalData = chartData.map(item => item.total);
    const completedData = chartData.map(item => item.completed);

    // Setup chart
    const ctx = document.getElementById('lineChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Total Tugas',
                    data: totalData,
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    pointRadius: 3,
                    pointBackgroundColor: '#3B82F6',
                    borderWidth: 3,
                    fill: true
                },
                {
                    label: 'List Tugas Diselesaikan',
                    data: completedData,
                    borderColor: '#10B981',
                    backgroundColor: 'transparent',
                    tension: 0.4,
                    pointRadius: 3,
                    pointBackgroundColor: '#10B981',
                    borderWidth: 3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom',
                    labels: {
                        usePointStyle: false,
                        boxWidth: 8
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.9)',
                    titleColor: '#333',
                    bodyColor: '#333',
                    borderColor: '#ddd',
                    borderWidth: 1,
                    callbacks: {
                        title: function(tooltipItems) {
                            // Tampilkan nama hari lengkap
                            const index = tooltipItems[0].dataIndex;
                            return chartData[index].dayFull;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: {
                        color: '#333',
                        font: { size: 10, weight: 'bold' }
                    }
                },
                y: {
                    grid: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        display: true,
                        stepSize: 1,
                        color: '#999',
                        font: { size: 10 }
                    },
                    beginAtZero: true
                }
            }
        }
    });
</script>

  <a href="{{ route('chatbot') }}" class="fixed overflow-clip bottom-0 right-4 flex flex-col items-center z-40 group" data-aos="fade-up">
    <div class="mb-1 px-4 py-1 rounded-full border border-blue-500 text-sm font-semibold drop-shadow-xl-fuchsia-600 text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-blue-600 transition-all group-hover:scale-105">
        Butuh bantuan?
    </div>
    <img src="{{ asset('images/bb.png') }}" alt="Help Bot" class="w-24 h-20 object-contain">
  </a>
</div>

@endsection
