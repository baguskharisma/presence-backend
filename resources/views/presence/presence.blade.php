<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presence</title>
</head>
<body>
    
    <form action="{{ route('check-in') }}" id="presenceIn" method="POST">
        @csrf
       
        <input type="hidden" name="latitudeCheckIn" id="latitudeCheckIn" readonly>
        <input type="hidden" name="longitudeCheckIn" id="longitudeCheckIn" readonly>
        <input type="hidden" name="date" value="{{ now()->format('j F Y') }}" readonly>

        <button type="button" onclick="checkIn()">Absen Masuk</button>
    </form>
    <form action="{{ route('check-out') }}" id="presenceOut" method="POST">
        @csrf
       
        <input type="hidden" name="latitudeCheckOut" id="latitudeCheckOut" readonly>
        <input type="hidden" name="longitudeCheckOut" id="longitudeCheckOut" readonly>
        <input type="hidden" name="date" value="{{ now()->format('j F Y') }}" readonly>

        <button type="button" onclick="checkOut()">Absen Keluar</button>
    </form>
    <button>
        <a href="{{ route('create-permission') }}" style="text-decoration: none; color:black">Izin</a>
    </button>
    <button>
        <a href="{{ route('home') }}" style="text-decoration: none; color:black">Back</a>
    </button>

    <script>
        function checkIn() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Isi nilai input dengan koordinat GPS yang diperoleh
                    document.getElementById('latitudeCheckIn').value = position.coords.latitude;
                    document.getElementById('longitudeCheckIn').value = position.coords.longitude;

                    // Kirim formulir setelah mendapatkan lokasi
                    document.getElementById('presenceIn').submit();
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
       
        function checkOut() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Isi nilai input dengan koordinat GPS yang diperoleh
                    document.getElementById('latitudeCheckOut').value = position.coords.latitude;
                    document.getElementById('longitudeCheckOut').value = position.coords.longitude;

                    // Kirim formulir setelah mendapatkan lokasi
                    document.getElementById('presenceOut').submit();
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
    </script>
</body>
</html>