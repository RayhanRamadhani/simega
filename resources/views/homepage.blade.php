<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIMEGA</title>
        @vite(['resources/css/app.css'])
    </head>
    <body>
        <nav class="bg-white p-4 flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{ asset('images/icon.png')}}" class="w-16 h-16">
                <span class="font-bold text-lg text-left">SIMEGA</span>
            </div>
            <a href="/login" class="border border-blue-500 text-blue-500 px-4 py-2 rounded-full hover:bg-blue-500 hover:text-white transition">Login</a>
        </nav>
        <main class="container mx-auto mt-10">
            <div class="text-center">
                <div class="flex justify-center items-center">
                    <img src="{{ asset('images/roki.png') }}" alt="Maskot" class="w-32 h-30">
                    <div class="ml-4 text-left">
                        <h1 class="text-5xl font-bold">Hai!</h1>
                        <h2 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-blue-500">Kenalin SIMEGA</h2>
                        <p class="text-gray-600 text-lg">Sistem Informasi Manajemen Tugas</p>
                    </div>
                </div>

                <div class="flex justify-center items-center text-left mt-6">
                    <p class="text-gray-700 max-w-lg">
                        SiMega adalah solusi modern untuk mengelola tugas dan aktivitas harian dengan lebih mudah dan terstruktur.
                        Tersedia untuk web dan Android, aplikasi ini dirancang untuk membantu Anda tetap produktif, fokus,
                        dan mencapai target tanpa hambatan.
                    </p>
                    <img src="{{ asset('images/roki.png') }}" alt="Maskot" class="w-32 h-30">
                </div>

                <h3 class="text-2xl font-bold mt-10">Fitur Unggulan SiMega</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 justify-center mt-10 max-w-4xl mx-auto">
                    <div class="bg-white shadow-lg rounded-xl p-6">
                        <h3 class="text-lg font-bold">Chat Bot</h3>
                        <p class="text-gray-600">Lorem ipsum odor amet, consectetuer adipiscing elit. Maecenas rutrum donec euismod euismod imperdiet sollicitudin. Tempus egestas augue, ad class phasellus ex laoreet.<p>
                    </div>
                    <div class="bg-white shadow-lg rounded-xl p-6">
                        <h3 class="text-lg font-bold">Anti Distract</h3>
                        <p class="text-gray-600">Lorem ipsum odor amet, consectetuer adipiscing elit. Maecenas rutrum donec euismod euismod imperdiet sollicitudin. Tempus egestas augue, ad class phasellus ex laoreet.</p>
                    </div>
                    <div class="bg-white shadow-lg rounded-xl p-6">
                        <h3 class="text-lg font-bold">Statistik</h3>
                        <p class="text-gray-600">Lorem ipsum odor amet, consectetuer adipiscing elit. Maecenas rutrum donec euismod euismod imperdiet sollicitudin. Tempus egestas augue, ad class phasellus ex laoreet.</p>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
