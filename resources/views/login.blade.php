<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- Kondisi jika ada kunci sesi dengan nama loginError --}}
    @if (session()->has('loginError'))
        {{-- Tampilkan jika ada --}}
        {{ session('loginError') }}
    @endif
    {{-- Form untuk login --}}
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Login</button>
</form>
</body>
</html>