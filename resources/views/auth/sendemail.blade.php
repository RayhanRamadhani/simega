<!DOCTYPE html>
<html>
<head>
    <title>SIMEGA</title>
</head>
<body>
    <h4>{{ $data['body'] }}</h4>
    <h1>{{ Auth::user()->otp }}</h1>
    <div></div>
    <p>{{  $data['body2'] }}</p>
    <p>Tidak membuat permintaan ini? abaikan saja email ini!</p>
    <p>Terimakasih</p>
</body>
</html>