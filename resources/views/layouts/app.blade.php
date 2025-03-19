<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMEGA</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">
    <nav class="bg-white p-4 flex justify-between items-center">
        <div class="flex items-center">
            <button class="text-2xl mr-4">&#9776;</button> <!-- Hamburger Menu -->
            <span class="font-bold text-lg">SIMEGA</span>

            <a href="/logout" class="border border-red-500 text-red-500 px-4 py-2 rounded-full hover:bg-red-500 hover:text-white transition">Logout</a>
        </div>
    </nav>

    <main class="container mx-auto mt-10">
        @yield('content')
    </main>
</body>
</html>
