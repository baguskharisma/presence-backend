<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Presence</title>
</head>
<body>
    {{-- Header --}}
    <h2>Manage Presence</h2>
    {{-- Tombol untuk kembali ke halaman admin --}}
    <button>
        <a href="{{ route('admin') }}" style="text-decoration: none; color:black">Back</a>
    </button>
    {{-- Tabel untuk menampilkan data absensi --}}
    <table>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
        </tr>
        {{-- Iterasi array $presences dan simpan setiap elemennya dalam variabel $presence --}}
        @foreach ($presences as $presence)
        <tr>
            <td>{{ $presence->name }}</td>
            <td>{{ $presence->date }}</td>
            <td>{{ $presence->time }}</td>
            <td>{{ $presence->status }}</td>
        </tr>  
        @endforeach
    </table>
</body>
</html>