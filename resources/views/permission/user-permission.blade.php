<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Permission</title>
</head>
<body>
    <h2>Permission</h2>
    <button>
        <a href="{{ route('home') }}" style="text-decoration: none; color:black">Back</a>
    </button>

    <table>
        <tr>
            <th>Status</th>
            <th>From When</th>
            <th>To When</th>
            <th>Submission Date</th>
            <th>Description</th>
        </tr>
        @foreach ($userPermissions as $userPermission)
        <tr>
            <td>{{ ucfirst ($userPermission->status) }}</td>
            <td>{{ $userPermission->from_when }}</td>
            <td>{{ $userPermission->to_when }}</td>
            <td>{{ $userPermission->submission_date }}</td>
            <td>{{ $userPermission->description }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>