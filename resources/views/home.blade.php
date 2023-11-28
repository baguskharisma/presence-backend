<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @auth
    @can('admin')
        <h2>This is Admin view</h2>
    @endcan
    @can('user')
        <h2>This is User view</h2>
    @endcan
    <button>
        <a href="{{ route('presence') }}" style="text-decoration: none; color:black">Absen</a>
    </button>
    <button>
        <a href="{{ route('history') }}" style="text-decoration: none; color:black">Riwayat</a>
    </button>
    @can('admin')
        <button>
            <a href="{{ route('admin') }}" style="text-decoration:none; color:black;">Dashboard</a>
        </button>
    @endcan
    <button style="margin-bottom: 10px;">
        <a href="{{ route('profile') }}" style="text-decoration: none; color: black;">Profil</a>
    </button>
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