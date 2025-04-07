<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-2xl flex overflow-hidden max-w-2xl">
        <div class="bg-blue-200 p-6 flex items-center justify-center">
            <img src="{{ asset('images/rokiberdiri.png') }}" alt="Raccoon" class="h-64">
        </div>

        <div class="p-8 w-80">
            <h2 class="text-2xl font-semibold text-blue-600">Daftar</h2>
            <p class="text-gray-600 mb-4">Yuk daftar akun kamu dulu</p>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <div class="flex items-center border rounded-full px-4 py-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                          </svg>
                        <input type="text" name="firstname" class="ml-2 w-full outline-none" placeholder="Masukkan nama depan" required>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="flex items-center border rounded-full px-4 py-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                          </svg>
                        <input type="text" name="lastname" class="ml-2 w-full outline-none" placeholder="Masukkan nama belakang" required>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="flex items-center border rounded-full px-4 py-2">
                        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a4 4 0 100 8 4 4 0 000-8zM2 18a8 8 0 1116 0H2z" clip-rule="evenodd"/>
                        </svg>
                        <input type="text" name="email" class="ml-2 w-full outline-none" placeholder="Masukkan email">
                    </div>
                </div>
                <div class="mb-4">
                    <div class="flex items-center border rounded-full px-4 py-2">
                        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5 8V6a5 5 0 0110 0v2h1a1 1 0 011 1v7a1 1 0 01-1 1H4a1 1 0 01-1-1V9a1 1 0 011-1h1zm2-2a3 3 0 016 0v2H7V6zm3 5a1 1 0 100 2 1 1 0 000-2z"
                                clip-rule="evenodd"/>
                        </svg>
                        <input type="password" name="password" class="ml-2 w-full outline-none" placeholder="Masukkan password" required>
                    </div>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-full hover:bg-blue-600">Daftar</button>
            </form>
        </div>
    </div>
</body>
</html>
