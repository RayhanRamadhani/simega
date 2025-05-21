<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIMEGA</title>
        @vite(['resources/css/app.css'])
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="min-h-screen">

        <nav class="bg-white px-6 py-4 flex justify-between items-center fixed top-0 left-0 right-0 z-50">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/icon.png') }}" class="w-12 h-12" alt="Logo SIMEGA">
                <span class="text-2xl">SIMEGA</span>
            </div>
            <div class="space-x-3 hidden sm:flex">
                <a href="/login" class="px-5 py-2 text-blue-500 border border-blue-500 rounded-full hover:bg-blue-500 hover:text-white transition duration-300">Login</a>
            </div>
        </nav>

        <section class="pt-32 pb-20 text-center px-4">
            <div class="flex flex-col md:flex-row justify-center items-center gap-6" data-aos="fade-up">
                <img src="{{ asset('images/roki.png') }}" class="w-32 md:w-44" alt="Maskot Roki">
                <div>
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-800">Hai! Kenalin</h1>
                    <h2 class="text-5xl md:text-6xl font-extrabold bg-gradient-to-r from-pink-500 to-blue-500 bg-clip-text text-transparent mt-2">SIMEGA</h2>
                    <p class="text-gray-600 mt-4 text-lg">Sistem Informasi Manajemen Tugas</p>
                    <a href="/register" class="mt-6 inline-block bg-blue-600 text-white px-6 py-3 rounded-full shadow-lg hover:bg-blue-700 transition">Mulai Sekarang</a>
                </div>
            </div>
        </section>

        <section class="max-w-4xl mx-auto text-center px-4 py-10" data-aos="fade-up">
            <p class="text-gray-700 text-lg leading-relaxed">
                SiMega adalah solusi modern untuk mengelola tugas dan aktivitas harian dengan lebih mudah dan terstruktur. Tersedia untuk web dan Android, aplikasi ini dirancang untuk membantu Anda tetap produktif, fokus, dan mencapai target tanpa hambatan.
            </p>
        </section>

        <section class="py-20 bg-white" data-aos="fade-up">
            <h3 class="text-3xl font-bold text-center mb-16">📋 Cara Kerja SIMEGA</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-5xl mx-auto px-4 text-center">
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <span class="text-2xl font-bold text-blue-500">1</span>
                    </div>
                    <h4 class="font-semibold text-lg">Daftar & Login</h4>
                    <p class="text-gray-600 mt-2">Buat akun atau login untuk mulai menggunakan SIMEGA.</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-4">
                        <span class="text-2xl font-bold text-pink-500">2</span>
                    </div>
                    <h4 class="font-semibold text-lg">Tambah Tugas dan List tugas</h4>
                    <p class="text-gray-600 mt-2">Buat daftar tugas dan list tugas, atur waktu, dan aktifkan pengingat (untuk mobile).</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                        <span class="text-2xl font-bold text-purple-500">3</span>
                    </div>
                    <h4 class="font-semibold text-lg">Fokus & Pantau</h4>
                    <p class="text-gray-600 mt-2">Lihat statistik, dapatkan notifikasi (untuk mobile), dan selesaikan target.</p>
                </div>
            </div>
        </section>

        <section class="mt-16">
            <h3 class="text-3xl font-bold text-center text-gray-800 mb-8" data-aos="fade-up">✨ Fitur Unggulan SiMega</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto px-4" data-aos="zoom-in-up">
                <div class="bg-white shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-300 rounded-xl p-6">
                    <h4 class="text-xl font-semibold mb-2 text-blue-600">Chat Bot</h4>
                    <p class="text-gray-600">Roki, chatbot pintar siap membantu Anda menyelesaikan tugas harian dengan cepat dan mudah.</p>
                </div>
                <div class="bg-white shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-300 rounded-xl p-6">
                    <h4 class="text-xl font-semibold mb-2 text-pink-600">Anti Distract</h4>
                    <p class="text-gray-600">Fitur fokus maksimal. Blokir gangguan, capai produktivitas tertinggi. (Eksklusif untuk mobile)</p>
                </div>
                <div class="bg-white shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-300 rounded-xl p-6">
                    <h4 class="text-xl font-semibold mb-2 text-purple-600">Statistik</h4>
                    <p class="text-gray-600">Pantau progres Anda dengan grafik statistik yang informatif dan intuitif.</p>
                </div>
            </div>
        </section>

        <section class="max-w-5xl mx-auto px-4 py-10" data-aos="fade-up" id="support">
            <h3 class="text-2xl font-bold text-center text-gray-800 mb-6">📱 Dukungan Platform</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4">
                    <img src="https://img.icons8.com/ios-filled/50/000000/android.png" alt="Android" class="w-10 h-10">
                    <div>
                        <h4 class="text-lg font-semibold text-green-600">Aplikasi Mobile</h4>
                        <p class="text-gray-600 text-sm">SIMEGA dapat diakses lewat smartphone Android untuk mobilitas tinggi.</p>
                    </div>
                </div>
                <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4">
                    <img src="https://img.icons8.com/ios-filled/50/000000/laptop.png" alt="Web" class="w-10 h-10">
                    <div>
                        <h4 class="text-lg font-semibold text-blue-600">Web Aplikasi</h4>
                        <p class="text-gray-600 text-sm">Versi web dengan pengalaman lengkap untuk pengguna desktop dan laptop.</p>
                    </div>
                </div>
            </div>
        </section>

        <footer class="mt-10 text-center text-gray-500 text-sm py-6">
            &copy; {{ now()->year }} SIMEGA. Mata Kuliah Proyek 2.
        </footer>

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>

    </body>
</html>
