<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create User</title>
</head>
<body>
    <h2>Add New Department</h2>
    <button>
        <a href="{{ route('admin') }}" style="text-decoration:none; color:black;">Back</a>
    </button>
    <form action="{{ route('create-department') }}" method="POST">
        @csrf
        <label for="department">New Department:</label>
        <input type="text" name="department" required>

        <button type="submit">Add Department</button>
    </form>
</body>
</html>
