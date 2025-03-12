<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
    </head>
    <body>
        <h3>Register Akun</h3>
        <form action="#" method="POST">
            @csrf
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" required placeholder="masukan nama lengkap">
            <br><br>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="masukan email">
            <br><br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="masukan password">
            <br><br>
            <button type="submit">Login</button>
            <button><a href="/login">Kembali</a></button>
        </form>
    </body>
</html>
