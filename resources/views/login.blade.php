<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-2xl flex overflow-hidden max-w-2xl">
        <div class="bg-blue-200 p-6 flex items-center justify-center">
            <img src="{{ asset('images/rokiberdiri.png') }}" alt="Raccoon" class="h-64">
        </div>

        <div class="p-8 w-80">
            <h2 class="text-2xl font-semibold text-blue-600">Selamat Datang!</h2>
            <p class="text-gray-600 mb-4">Yuk login ke akun kamu dulu</p>

            @if(session('success'))
                <div class="flex bg-green-100 text-green-700 p-4 mb-4 rounded-lg" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <p class="text-red-500 text-sm">{{ $errors->first() }}</p>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <div class="flex items-center border rounded-full px-4 py-2">
                        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a4 4 0 100 8 4 4 0 000-8zM2 18a8 8 0 1116 0H2z" clip-rule="evenodd"/>
                        </svg>
                        <input type="text" name="email" class="ml-2 w-full outline-none" placeholder="Masukkan username / email">
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

                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-full hover:bg-blue-600">Login</button>
            </form>

            <p class="mt-4 text-center text-gray-600">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-500">Daftar</a></p>
        </div>
    </div>
</body>
</html>
