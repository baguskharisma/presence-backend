<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Riwayat</title>
</head>
<body>
    <h2>Riwayat</h2>
    <button>
        <a href="{{ route('home') }}" style="text-decoration: none; color: black;">Back</a>
    </button>
    <h3>Absensi</h3>
    <table>
        <tr>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Status</th>
        </tr>
        @foreach ($presences as $presence)
        <tr>
            <td>{{ $presence->date }}</td>
            <td>{{ $presence->time }}</td>
            <td>{{ $presence->status }}</td>
        </tr>
        @endforeach
    </table>
    <h3>Izin</h3>
    <table>
        <tr>
            <th>From When</th>
            <th>To When</th>
            <th>Submission Date</th>
            <th>Description</th>
            <th>Status</th>
        </tr>
        @foreach ($permissions as $permission)
        <tr>
            <td>{{ $permission->from_when }}</td>
            <td>{{ $permission->to_when }}</td>
            <td>{{ $permission->submission_date }}</td>
            <td>{{ $permission->description }}</td>
            <td>{{ ucfirst($permission->status) }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>