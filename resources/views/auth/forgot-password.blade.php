<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body class="flex items-center justify-center min-h-screen" data-aos="fade-up">
    <div class="bg-white shadow-lg rounded-2xl flex overflow-hidden max-w-2xl">
        <div class="bg-blue-200 p-6 flex items-center justify-center">
            <img src="{{ asset('images/rokiberdiri.png') }}" alt="Raccoon" class="h-64">
        </div>

        <div class="p-8 w-80">
            <h2 class="text-2xl font-semibold text-blue-600">Lupa Password</h2>
            <p class="text-gray-600 mb-4">Masukan email kamu yang terdaftar untuk mereset password</p>

           @if(session('success')) <div>{{ session('success') }}</div> @endif
            @if(session('error')) <div>{{ session('error') }}</div> @endif

            <form action="{{ route('forgot.send') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <div class="flex items-center border rounded-full px-4 py-2">
                        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a4 4 0 100 8 4 4 0 000-8zM2 18a8 8 0 1116 0H2z" clip-rule="evenodd"/>
                        </svg>
                        <input type="text" name="email" class="ml-2 w-full outline-none" placeholder="Masukkan Email">
                    </div>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-full hover:bg-blue-600">Kirim Link Reset</button>
            </form>
        </div>
    </div>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
