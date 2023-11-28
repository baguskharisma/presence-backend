<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Permission</title>
</head>
<body>
    <h1>Permission</h1>
    <button>
        <a href="{{ route('admin') }}" style="text-decoration: none; color:black">Back</a>
    </button>
    <table>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>From When</th>
            <th>To When</th>
            <th>Submission Date</th>
            <th>Description</th>
        </tr>
        @foreach ($permissions as $permission)
        <tr>
            <td>{{ $permission->name }}</td>
            <td>{{ ucfirst ($permission->status) }}</td>
            <td>{{ $permission->from_when }}</td>
            <td>{{ $permission->to_when }}</td>
            <td>{{ $permission->submission_date }}</td>
            <td>{{ $permission->description }}</td>
                @if ($permission->status == "pending")
                <td>
                    <form action="{{ route('manage-permission',$permission->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success" name="status" value="accepted" style="text-decoration: none; color: black;">Accept</button>
                        <button type="submit" class="btn btn-danger" name="status" value="declined" style="text-decoration: none; color: black;">Decline</button>
                    </form>
                </td> 
                @endif
        </tr>
        @endforeach
    </table>
</body>
</html>