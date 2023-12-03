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

        <select name="position_id" id="position_id" required>
            <option selected >Select Position</option>
            <option value="1">HRD</option>
            <option value="2">Marketing</option>
        </select>

        <select name="department_id" id="department_id" required>
            <option selected >Select Department</option>
            <option value="1">Sumber Daya Manusia</option>
            <option value="2">Pemasaran</option>
        </select>

        <select name="role_id" id="role_id" required>
            <option selected >Select Position</option>
            <option value="1">Admin</option>
            <option value="2">User</option>
        </select>

        <button type="submit">Add Employee</button>
        <button type="submit">
            <a href="{{ route('admin') }}" style="text-decoration:none; color:black;">Batal</a>
        </button>
    </form>
</body>
</html>
