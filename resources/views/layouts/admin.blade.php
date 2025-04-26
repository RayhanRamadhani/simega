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
            <nav class="text-base font-semibold">
                <ul>
                    <li class="p-3 hover:bg-blue-200 rounded"><a href="/admin/dashboard" class="inline-flex items-center"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                      </svg>
                      Dashboard</a></li>
                    <li class="p-3 hover:bg-blue-200 rounded"><a href="/pengguna" class="inline-flex items-center"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                      </svg>
                      Kelola Pengguna</a></li>
                    <li class="p-3 hover:bg-blue-200 rounded"><a href="/packages" class="inline-flex items-center"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>
                      Kelola Paket</a></li>
                    <li class="p-3"><a href="/logout" class="flex items-center text-red-600 hover:text-red-800">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 24 24"
                             fill="currentColor"
                             class="w-5 h-5">
                            <path fill-rule="evenodd" d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                        <span>Logout</span>
                    </a></li>
                </ul>
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
                    <div class="flex items-center mr-6 gap-3">
                        <p class="text-xl text-blue-500">{{ Auth::user()->role }}</p>
                    </div>
                </div>
            </header>
            <main id="main-container" class="main-container flex-1 transition-all duration-300 ease-in-out p-5 mt-16">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        const mainContainer = document.getElementById('main-container');
        const body = document.body;

        menuBtn.addEventListener('click', () => {
            body.classList.toggle('sidebar-open');
        });
    </script>
</body>
</html>
