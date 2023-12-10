<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Permission</title>
</head>
<body>
    {{-- Form untuk membuat izin --}}
    <form action="{{ route('create-permission') }}" method="POST">
        @csrf
        <input type="hidden" name="name" id="name" value="{{ $employee->name }}">
        
        <label for="from_when">From When</label>
        <input type="date" name="from_when" id="from_when">
        
        <label for="to_when">To When</label>
        <input type="date" name="to_when" id="to_when">
        
        <label for="submission_date">Submission Date</label>
        {{-- Nilai dari input berupa tanggal hari ini dalam format tanggal bulan dan tahun --}}
        <input type="date" name="submission_date" id="submission_date" value="{{ now()->format('j F Y') }}">
        
        <label for="description">Description</label>
        <input type="text" name="description" id="description">

        <button type="submit">Submit</button>
        {{-- Tombol untuk kembali ke halaman presence --}}
        <button>
            <a href="{{ route('presence') }}" style="text-decoration: none; color:black">Back</a>
        </button>    
    </form>
</body>
</html>