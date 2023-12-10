<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Schedule Detail</title>
</head>
<body>
    {{-- Header --}}
    <h2>Schedule Detail</h2>
    {{-- Tombol untuk kembali ke halaman schedule --}}
    <button>
        <a href="{{ route('schedule') }}" style="text-decoration:none; color:black;">Back</a>
    </button>
    {{-- Tabel untuk menampilkan jadwal --}}
    <table>
        <tr>
            <th>Day</th>
            <th>Date</th>
            <th>In Time</th>
            <th>Out Time</th>
            <th>Status</th>
            <th>Description</th>
        </tr>
        {{-- Iterasi array $schedules dan simpan setiap elemennya dalam variabel $schedule --}}
        @foreach ($schedules as $schedule)
        <tr>
            <td>{{ $schedule->day }}</td>
            <td>{{ $schedule->date }}</td>
            <td>{{ $schedule->in_time }}</td>
            <td>{{ $schedule->out_time }}</td>
            <td>{{ $schedule->status }}</td>
            <td>{{ $schedule->description }}</td>
        </tr>
        @endforeach
    </table>
    </table>
</body>
</html>