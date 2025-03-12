<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h3>Login</h3>
    @if ($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required placeholder="masukan email">
        <br><br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required placeholder="masukan password">
        <br><br>
        <button type="submit">Login</button>
    </form>
    <p>Belum punya akun? <a href="/register">Daftar</a></p>
</body>
</html>
