<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Riwayat</title>
</head>
<body>
    {{-- Header --}}
    <h2>Riwayat</h2>
    {{-- Tombol untuk kembali ke halaman home --}}
    <button>
        <a href="{{ route('home') }}" style="text-decoration: none; color: black;">Back</a>
    </button>
    {{-- Header --}}
    <h3>Absensi</h3>
    {{-- Tabel untuk menampilkan data absensi pengguna --}}
    <table>
        <tr>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Status</th>
        </tr>
        {{-- Iterasi array $presences dan simpan setiap elemennya dalam variabel $presence --}}
        @foreach ($presences as $presence)
        <tr>
            <td>{{ $presence->date }}</td>
            <td>{{ $presence->time }}</td>
            <td>{{ $presence->status }}</td>
        </tr>
        @endforeach
    </table>
    {{-- Header --}}
    <h3>Izin</h3>
    {{-- Tabel untuk menampilkan data izin pengguna --}}
    <table>
        <tr>
            <th>From When</th>
            <th>To When</th>
            <th>Submission Date</th>
            <th>Description</th>
            <th>Status</th>
        </tr>
        {{-- Iterasi array $permissions dan simpan setiap elemennya dalam variabel $permission --}}
        @foreach ($permissions as $permission)
        <tr>
            <td>{{ $permission->from_when }}</td>
            <td>{{ $permission->to_when }}</td>
            <td>{{ $permission->submission_date }}</td>
            <td>{{ $permission->description }}</td>
            {{-- ucfirst() adalah fungsi dalam PHP yang digunakan untuk mengubah huruf pertama dari suatu string menjadi huruf kapital --}}
            <td>{{ ucfirst($permission->status) }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>