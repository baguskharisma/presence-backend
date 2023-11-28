<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
</head>
<body>
    <h2>User Profile</h2>
    <button>
        <a href="{{ route('home') }}" style="text-decoration: none; color: black;">Back</a>
    </button>

    <table>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Nomor Hp</th>
            <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Jabatan</th>
            <th>Departemen</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone_number }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->birth }}</td>
            <td>{{ $user->gender }}</td>
            <td>{{ $user->role->role }}</td>
            <td>{{ $user->department->department }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>