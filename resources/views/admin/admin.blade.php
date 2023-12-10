<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
</head>
<body>
    {{-- Form untuk filter posisi --}}
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
        {{-- Tombol untuk masuk ke halaman create-user --}}
        <button>
            <a href="{{ route('create-user') }}" style="text-decoration:none; color:black;">Add User</a>
        </button>
        {{-- Tombol untuk masuk ke halaman create-schedule --}}
        <button>
            <a href="{{ route('create-schedule') }}" style="text-decoration:none; color:black;">Create Schedule</a>
        </button>
        {{-- Tombol untuk masuk ke halaman create-position --}}
        <button>
            <a href="{{ route('create-position') }}" style="text-decoration:none; color:black;">Create Position</a>
        </button>
        {{-- Tombol untuk masuk ke halaman create-department --}}
        <button>
            <a href="{{ route('create-department') }}" style="text-decoration:none; color:black;">Create Department</a>
        </button>
        {{-- Tombol untuk masuk ke halaman manage-presence --}}
        <button>
            <a href="{{ route('manage-presence') }}" style="text-decoration:none; color:black;">Manage Presence</a>
        </button>
        {{-- Tombol untuk masuk ke halaman manage-permission --}}
        <button>
            <a href="{{ route('manage-permission') }}" style="text-decoration:none; color:black;">Manage Permission</a>
        </button>
        {{-- Tombol untuk kembali ke halaman home --}}
        <button>
            <a href="{{ route('home') }}" style="text-decoration:none; color:black;">Back</a>
        </button>
    </form>

    {{-- Header --}}
    <h2>Employees</h2>

    {{-- Tabel untuk menampilkan data karyawan --}}
    <table>
        {{-- Kepala baris --}}
        <tr>
            {{-- Kolom dari kepala baris --}}
            <th>Name</th>
            <th>Position</th>
            <th>Department</th>
            <th>Role</th>
        </tr>
        {{-- Iterasi array $employees dan simpan setiap elemennya dalam variabel $employee --}}
        @foreach ($employees as $employee)
        {{-- Buat baris baru untuk setiap data yang ada --}}
        <tr>
            {{-- Kolom dari tiap nilai yang didapat dari hasil iterasi --}}
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->position->position }}</td>
            <td>{{ $employee->department->department }}</td>
            <td>{{ $employee->role->role }}</td>
            {{-- Tombol untuk masuk ke halaman edit-user --}}
            <td>
            <button>
                <a href="{{ route('edit-user', $employee->id) }}" style="text-decoration:none; color:black;">Edit</a>
            </button>
            {{-- Tombol untuk menghapus karyawan --}}
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

    {{-- Header --}}
    <h2>Positions</h2>

    {{-- Tabel untuk menampilkan data posisi --}}
    <table>
        {{-- Kepala baris --}}
        <tr>
            {{-- Kolom dari kepala baris --}}
            <th>Position</th>
        </tr>
        {{-- Iterasi array $positions dan simpan setiap elemennya dalam variabel $position --}}
        @foreach ($positions as $position)
        {{-- Buat baris baru untuk setiap data yang ada --}}
        <tr>
            {{-- Kolom dari tiap nilai yang didapat dari hasil iterasi --}}
            <td>{{ $position->position }}</td>
            {{-- Tombol untuk menghapus posisi --}}
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

    {{-- Header --}}
    <h2>Departments</h2>

    {{-- Tabel untuk menampikan data departemen --}}
    <table>
        {{-- Kepala baris --}}
        <tr>
            {{-- Kolom dari kepala baris --}}
            <th>Department</th>
        </tr>
        {{-- Iterasi array $departments dan simpan setiap elemennya dalam variabel $department --}}
        @foreach ($departments as $department)
        {{-- Buat baris baru untuk setiap data yang ada --}}
        <tr>
            {{-- Kolom dari tiap nilai yang didapat dari hasil iterasi --}}
            <td>{{ $department->department }}</td>
            {{-- Tombol untuk menghapus departemen --}}
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

{{-- Kode javascript untuk memfilter posisi --}}
<script>
    document.getElementById('position').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
</script>
</body>
</html>
