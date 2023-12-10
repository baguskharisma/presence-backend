<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create User</title>
</head>
<body>
    {{-- Header --}}
    <h2>Add New Position</h2>
    {{-- Tombol untuk kembali ke halaman admin --}}
    <button>
        <a href="{{ route('admin') }}" style="text-decoration:none; color:black;">Cancel</a>
    </button>
    {{-- Form untuk menambah posisi --}}
    <form action="{{ route('create-position') }}" method="POST">
        @csrf
        <label for="position">New Position:</label>
        <input type="text" name="position" required>

        <button type="submit">Add Position</button>
    </form>
</body>
</html>
