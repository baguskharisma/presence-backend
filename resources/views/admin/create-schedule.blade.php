<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Schedule</title>
</head>
<body>
    <h2>Create Schedule</h2>

    <form action="{{ route('create-schedule') }}" method="POST">
        @csrf

        <label for="day">Day</label>
        <input type="text" name="day" required>
        <label for="date">Date</label>
        <input type="date" name="date" required>
        <label for="in_time">In Time</label>
        <input type="time" name="in_time" required>
        <label for="out_time">Out Time</label>
        <input type="time" name="out_time" required>
        <select name="status" required>
            <option selected >Status</option>
            <option value="hari kerja">Hari Kerja</option>
            <option value="tanggal merah">Tanggal Merah</option>
            <option value="libur">Libur</option>
        </select>
        <label for="description">Description</label>
        <input type="text" name="description">

        <button type="submit">Submit</button>
        <button>
        <a href="{{ route('admin') }}" style="text-decoration: none; color:black">Batal</a>
    </button
    </form>
</body>
</html>