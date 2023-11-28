<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Presence</title>
</head>
<body>
    <h2>Manage Presence</h2>
    <button>
        <a href="{{ route('admin') }}" style="text-decoration: none; color:black">Back</a>
    </button>

    <table>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
        </tr>
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