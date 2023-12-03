<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
</head>
<body>
    <form action="/admin" method="GET" id="filterForm">
        <label for="position">Filter:</label>
        <select name="position" id="position" required>
            <option value="all" @if ($selectedPosition == "all")
                selected
            @endif>All Position</option>
            <option value="1" @if ($selectedPosition == "1")
                selected
            @endif>HRD</option>
            <option value="2" @if ($selectedPosition == "2")
                selected
            @endif>Marketing</option>
        </select>
        <button>
            <a href="{{ route('create-user') }}" style="text-decoration:none; color:black;">Add User</a>
        </button>
        <button>
            <a href="{{ route('create-schedule') }}" style="text-decoration:none; color:black;">Create Schedule</a>
        </button>
        <button>
            <a href="{{ route('create-position') }}" style="text-decoration:none; color:black;">Create Position</a>
        </button>
        <button>
            <a href="{{ route('create-department') }}" style="text-decoration:none; color:black;">Create Department</a>
        </button>
        <button>
            <a href="{{ route('manage-presence') }}" style="text-decoration:none; color:black;">Manage Presence</a>
        </button>
        <button>
            <a href="{{ route('manage-permission') }}" style="text-decoration:none; color:black;">Manage Permission</a>
        </button>
        <button>
            <a href="{{ route('home') }}" style="text-decoration:none; color:black;">Back</a>
        </button>
    </form>

    <h2>Employee</h2>

    <table>
        <tr>
            <th>Nama</th>
            <th>Posisi</th>
            <th>Departemen</th>
            <th>Akses</th>
        </tr>
        @foreach ($employees as $employee)
        <tr>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->position->position }}</td>
            <td>{{ $employee->department->department }}</td>
            <td>{{ $employee->role->role }}</td>
            <td>
            <button>
                <a href="{{ route('edit-user', $employee->id) }}" style="text-decoration:none; color:black;">Edit</a>
            </button>
            </td>
            <td>
                <form action="{{ route('delete-user', $employee->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach   
    </table>

    <h2>Position</h2>
    <table>
        <tr>
            <th>Posisi</th>
        </tr>
        @foreach ($positions as $position)
        <tr>
            <td>{{ $position->position }}</td>
            <td>
                <form action="{{ route('delete-position', $position->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach   
    </table>

    <h2>Department</h2>
    <table>
        <tr>
            <th>Department</th>
        </tr>
        @foreach ($departments as $department)
        <tr>
            <td>{{ $department->department }}</td>
            <td>
                <form action="{{ route('delete-department', $department->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach   
    </table>

<script>
    document.getElementById('position').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
</script>
</body>
</html>
