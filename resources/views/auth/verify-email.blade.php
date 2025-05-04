<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex items-center justify-center min-h-screen" data-aos="fade-up">
    <div class="bg-white shadow-lg rounded-2xl flex overflow-hidden max-w-2xl">
        <div class="bg-blue-200 p-6 flex items-center justify-center">
            <img src="{{ asset('images/rokiberdiri.png') }}" alt="Rakun" class="h-64">
        </div>

        <div class="p-8 w-80">
            <h2 class="text-2xl font-semibold text-blue-600">Verifikasi Email!</h2>
            <p class="text-gray-600 mb-4">Cek email kamu, Roki udah kirim kamu kode OTP!</p>

            @if(session('success'))
                <div class="flex bg-green-100 text-green-700 p-4 mb-4 rounded-lg" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @elseif ($errors->any())
                <div class="flex bg-red-100 text-red-700 p-4 mb-4 rounded-lg" role="alert">
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif

            <form action="{{ route('verify.otp') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <div class="flex items-center border rounded-full px-4 py-2">
                        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a4 4 0 100 8 4 4 0 000-8zM2 18a8 8 0 1116 0H2z" clip-rule="evenodd"/>
                        </svg>
                        <input type="text" name="otp" class="ml-2 w-full outline-none" placeholder="Masukkan kode OTP">
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-full hover:bg-blue-600">Verifikasi</button>
            </form>

            <p class="mt-4 text-center text-gray-600">Kode belum masuk? <a href="{{ route('resend.otp') }}" class="text-blue-500">Kirim Ulang</a></p>
        </div>
    </div>
</body>
</html>
