<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        .sidebar-open .sidebar {
            transform: translateX(0);
        }
        .sidebar-open .main-container {
            margin-left: 12rem;
            width: calc(100% - 16rem);
        }
    </style>
</head>
<body>
    <div class="flex h-screen overflow-hidden">
        <div id="sidebar" class="sidebar fixed top-0 left-0 w-48 h-full bg-white shadow-md transform -translate-x-full transition-transform duration-300 ease-in-out">
            <div class="p-5 flex items-center">
                <img src="logo.png" alt="Logo" class="w-10 h-10 mr-1">
                <span class="text-xl">SIMEGA</span>
            </div>
            <nav class="mt-5 text-base font-semibold">
                <ul>
                    <li class="p-3"><a href="{{ route('task.create') }}" class="bg-blue-200 px-6 py-2 rounded hover:bg-blue-300 transition inline-flex items-center w-fit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                      </svg>
                      Buat</a></li>
                    <li class="p-3"><a href="{{ route('priority') }}" class="inline-flex items-center"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                      </svg>
                      Prioritas</a></li>
                    <li class="p-3"><a href="{{ route('dashboard') }}" class="bg-blue-200 px-6 py-1 rounded-full hover:bg-blue-300 transition inline-flex items-center w-fit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                      </svg>
                      Semua tugas</a></li>
                    <li class="p-3"><a href="{{ route("chatbot") }}" class="px-6 py-1 rounded-full shadow-md bg-white border border-blue-500 bg-gradient-to-r from-pink-500 to-blue-500 text-transparent bg-clip-text inline-flex items-center w-fit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="url(#gradient)" class="size-6">
                        <defs>
                          <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#ec4899"/>
                            <stop offset="100%" stop-color="#3b82f6"/>
                          </linearGradient>
                        </defs>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                      </svg>
                      Tanya Roki!</a></li>
                </ul>
                <div class="relative inline-block text-left">
                    <button id="dropdownButton" class="px-4 py-2 text-gray-800 rounded-md inline-flex items-center w-fit gap-6">
                        Daftar Tugas
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                        </svg>
                    </button>
                    <div id="dropdownMenu" class="hidden absolute w-48 h-64 bg-gray-200 rounded-md shadow-md mt-2">
                        @forelse($tasks as $task)
                            <a href="{{ route('task.edit', $task->idtask) }}" class="block px-4 py-2 hover:bg-gray-300">
                                {{ $task->name }}
                            </a>
                        @empty
                            <span class="block px-4 py-2 text-gray-500">Tidak ada tugas</span>
                        @endforelse
                    </div>
                </div>
            </nav>
        </div>
        <div class="flex-1 flex flex-col">
            <header class="bg-white p-2 fixed top-0 left-0 w-full z-10">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <button id="menu-btn" class="text-2xl">☰</button>
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('images/icon.png')}}" class="w-16 h-16">
                            <span class="text-xl">SIMEGA</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route("payment.process") }}">
                            <button class="border border-blue-500 text-blue-500 px-4 py-1 rounded-lg">{{ Auth::user()->tier }}</button>
                        </a>
                        <a href="/profile"><img src="{{ Auth::user()->photo }}" alt="photo profile" class="w-10 h-10 rounded-full"></a>
                    </div>
                </div>
            </header>
            <main id="main-container" class="main-container overflow-scroll flex-1 transition-all duration-300 ease-in-out p-5 mt-16">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
         document.getElementById('dropdownButton').addEventListener('click', function () {
        document.getElementById('dropdownMenu').classList.toggle('hidden');
        });

        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        const mainContainer = document.getElementById('main-container');
        const body = document.body;

        menuBtn.addEventListener('click', () => {
            body.classList.toggle('sidebar-open');
        });
    </script>

    @yield('scripts')
</body>

</html>
