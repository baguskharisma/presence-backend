<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
</head>
<body>
    <form action="{{ route('update-user', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="name">Nama:</label>
        <input type="text" name="name" value="{{ $employee->name }}" required>

        <label for="position_id">Posisi:</label>
        <input type="integer" name="position_id" value="{{ $employee->position_id }}" required>

        <label for="email">Email:</label>
        <input type="text" name="email" value="{{ $employee->email }}" required>

        <label for="password">Password:</label>
        <input type="text" name="password" value="{{ $employee->password }}" required>

        <label for="phone_number">Phone Number:</label>
        <input type="integer" name="phone_number" value="{{ $employee->phone_number }}" required>

        <label for="address">Address:</label>
        <input type="text" name="address" value="{{ $employee->address }}" required>

        <label for="birth">Birth:</label>
        <input type="text" name="birth" value="{{ $employee->birth }}" required>

        <label for="gender">Gender:</label>
        <input type="text" name="gender" value="{{ $employee->gender }}" required>

        <label for="department_id">Department:</label>
        <input type="integer" name="department_id" value="{{ $employee->department_id }}" required>

        <label for="role_id">Role:</label>
        <input type="integer" name="role_id" value="{{ $employee->role_id }}" required>

        <button type="submit">Update</button>
        <button type="submit">
            <a href="{{ route('admin') }}" style="text-decoration:none; color:black;">Batal</a>
        </button>
    </form>
</body>
</html>