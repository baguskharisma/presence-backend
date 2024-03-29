<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    {{-- Blok ini hanya dijalankan jika pengguna sedang terautentikasi --}}
    @auth
    {{-- Blok ini hanya dijalankan jika role pengguna adalah admin --}}
    @can('admin')
        <h2>This is Admin view</h2>
    @endcan
    {{-- Blok ini hanya dijalankan jika role pengguna adalah user --}}
    @can('user')
        <h2>This is User view</h2>
    @endcan
    {{-- Tombol untuk masuk ke halaman presence --}}
    <button>
        <a href="{{ route('presence') }}" style="text-decoration: none; color:black">Absen</a>
    </button>
    {{-- Tombol untuk masuk ke halaman history --}}
    <button>
        <a href="{{ route('history') }}" style="text-decoration: none; color:black">Riwayat</a>
    </button>
    {{-- Blok ini hanya dijalankan jika role pengguna adalah admin --}}
    @can('admin')
        {{-- Tombol untuk masuk ke halaman admin --}}
        <button>
            <a href="{{ route('admin') }}" style="text-decoration:none; color:black;">Dashboard</a>
        </button>
    @endcan
    {{-- Tombol untuk masuk ke halaman profile --}}
    <button style="margin-bottom: 10px;">
        <a href="{{ route('profile') }}" style="text-decoration: none; color: black;">Profil</a>
    </button>
    {{-- Form untuk logout --}}
    <form action="/logout" method="POST">
        @csrf
        <button type="submit">
            Logout
        </button>
    </form>
        @else
    <h1>Home</h1>
    <a href="/login">Login</a>
    @endauth
</body>
</html>