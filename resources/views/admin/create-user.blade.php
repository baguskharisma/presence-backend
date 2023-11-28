<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create User</title>
</head>
<body>
    <form action="{{ route('create-user') }}" method="post">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="position_id">Position:</label>
        <input type="integer" name="position_id" required>

        <label for="email">Email:</label>
        <input type="text" name="email" required>

        <label for="password">Password:</label>
        <input type="text" name="password" required>

        <label for="phone_number">Phone Number:</label>
        <input type="integer" name="phone_number" required>

        <label for="address">Address:</label>
        <input type="text" name="address" required>

        <label for="birth">Birth:</label>
        <input type="text" name="birth" required>

        <label for="gender">Gender:</label>
        <input type="text" name="gender" required>

        <label for="department_id">Department:</label>
        <input type="integer" name="department_id" required>

        <label for="role_id">Role:</label>
        <input type="integer" name="role_id" required>

        <button type="submit">Add Employee</button>
        <button type="submit">
            <a href="{{ route('admin') }}" style="text-decoration:none; color:black;">Batal</a>
        </button>
    </form>
</body>
</html>
