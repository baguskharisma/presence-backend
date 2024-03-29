<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presence</title>
    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
</head>
<body>
    {{-- Form untuk melakukan absen masuk --}}
    <form action="{{ route('check-in') }}" id="presenceIn" method="POST">
        @csrf
        {{-- Nilai dari input ini akan dikirim ke middleware CheckGPSLocation terlebih dahulu --}}
        <input type="hidden" name="latitudeCheckIn" id="latitudeCheckIn" readonly>
        {{-- Nilai dari input ini akan dikirim ke middleware CheckGPSLocation terlebih dahulu --}}
        <input type="hidden" name="longitudeCheckIn" id="longitudeCheckIn" readonly>
        {{-- Nilai dari input ini langsung dikirim ke fungsi checkIn dalam PresenceController --}}
        <input type="hidden" name="date" value="{{ now()->format('j F Y') }}" readonly>

        {{-- Tombol untuk melakukan absen masuk --}}
        <button type="button" onclick="checkIn()">Check In</button>
    </form>
    {{-- Form untuk melakukan absen keluar --}}
    <form action="{{ route('check-out') }}" id="presenceOut" method="POST">
        @csrf
        {{-- Nilai dari input ini akan dikirim ke middleware CheckOutGPSLocation terlebih dahulu --}}
        <input type="hidden" name="latitudeCheckOut" id="latitudeCheckOut" readonly>
        {{-- Nilai dari input ini akan dikirim ke middleware CheckOutGPSLocation terlebih dahulu --}}
        <input type="hidden" name="longitudeCheckOut" id="longitudeCheckOut" readonly>
        {{-- Nilai dari input ini langsung dikirim ke fungsi checkOut dalam PresenceController --}}
        <input type="hidden" name="date" value="{{ now()->format('j F Y') }}" readonly>

        {{-- Tombol untuk melakukan absen keluar --}}
        <button type="button" onclick="checkOut()">Check Out</button>
    </form>
    {{-- Map --}}
    <div id="map" style="height: 200px; width: 200px"></div>
    {{-- Tombol untuk masuk ke halaman create-permission --}}
    <button>
        <a href="{{ route('create-permission') }}" style="text-decoration: none; color:black">Permission</a>
    </button>
    {{-- Tombol untuk kembali ke halaman home --}}
    <button>
        <a href="{{ route('home') }}" style="text-decoration: none; color:black">Back</a>
    </button>

{{-- Kode javascript untuk mendapatkan titik koordinat untuk input dalam form check in dan check out--}}
<script>
    function checkIn() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('latitudeCheckIn').value = position.coords.latitude;
                document.getElementById('longitudeCheckIn').value = position.coords.longitude;

                document.getElementById('presenceIn').submit();
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }
       
    function checkOut() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('latitudeCheckOut').value = position.coords.latitude;
                document.getElementById('longitudeCheckOut').value = position.coords.longitude;

                document.getElementById('presenceOut').submit();
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }
</script>
{{-- Leaflet JS --}}
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
{{-- Kode javascript untuk menampilkan lokasi pengguna saat ini di map --}}
<script>
    var map = L.map('map');

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    navigator.geolocation.getCurrentPosition(function(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        var circle = L.circle([0.498443, 101.490217], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 100
        }).addTo(map);

        map.setView([latitude, longitude], 17);

        L.marker([latitude, longitude]).addTo(map);
    }, function(error) {
        console.error('Gagal mengambil posisi:', error);
    });
</script>
</body>
</html>