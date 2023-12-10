<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Schedule</title>
</head>
<body>
    {{-- Header  --}}
    <h2>List Schedule</h2>
    {{-- Blok ini hanya dijalankan jika role pengguna adalah admin --}}
    @can('admin')
    {{-- Tombol untuk masuk ke halaman create-schedule --}}
    <button>
        <a href="{{ route('create-schedule') }}" style="text-decoration:none; color:black;">Create Schedule</a>
    </button>
    @endcan
    {{-- Tombol untuk kembali ke halaman profile --}}
    <button>
        <a href="{{ route('profile') }}" style="text-decoration:none; color:black;">Back</a>
    </button>
    {{-- Tabel untuk menampilkan jadwal --}}
    <table>
        <tr>
            <th>Day</th>
            <th>Date</th>
            <th>In Time</th>
            <th>Out Time</th>
            <th>Status</th>
        </tr>
        {{-- Iterasi array $schedules dan simpan setiap elemennya dalam variabel $schedule --}}
        @foreach ($schedules as $schedule)
        <tr>
            <td>{{ $schedule->day }}</td>
            <td>{{ $schedule->date }}</td>
            <td>{{ $schedule->in_time }}</td>
            <td>{{ $schedule->out_time }}</td>
            <td>{{ $schedule->status }}</td>
            {{-- Tombol untuk masuk ke halaman schedule-detail --}}
            <td>
                <button>
                    <a href="{{ route('schedule-detail', $schedule->id) }}" style="text-decoration:none; color:black;">Detail</a>
                </button>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>