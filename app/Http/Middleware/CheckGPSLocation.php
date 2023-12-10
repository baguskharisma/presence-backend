<?php

namespace App\Http\Middleware;

use Closure;

// Impor kelas Request untuk mewakili dan memproses data permintaan HTTP.
use Illuminate\Http\Request;

class CheckGPSLocation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Variabel untuk menyimpan nilai radius yang diizinkan yaitu 100 meter.
        $allowedDistance = 0.1;

        // Variabel untuk menyimpan nilai yang diterima dari permintaan HTTP.
        $latitude = $request->input('latitudeCheckIn');
        $longitude = $request->input('longitudeCheckIn');

        // Variabel untuk menyimpan nilai titik koordinat kantor.
        $officeLatitude = 0.498443;
        $officeLongitude = 101.490217;

        // Variabel untuk menyimpan nilai yang diterima dari hasil yang dikembalikan fungsi calculateDistance.
        $distance = $this->calculateDistance($latitude, $longitude, $officeLatitude, $officeLongitude);

        // Kondisi jika titik koordinat pengguna saat ini diluar dari radius yang diizinkan.
        if($distance > $allowedDistance) {
            // Kembalikan dalam bentuk respon JSON.
            return response()->json(['error' => 'Lokasi diluar jarak yang diinginkan'], 403);
        }

        // Lanjut ke fungsi checkIn.
        return $next($request);
    }

    // Fungsi untuk menghitung titik koordinat pengguna saat ini. Fungsi ini hanya dapat diakses dari dalam kelas tempat ini dideklarasikan. 
    private function calculateDistance($lat1, $lon1, $lat2, $lon2){
        // Rumus Haversine.
        $earthRadius = 6371;

        $lat1Rad = deg2rad($lat1);
        $lon1Rad = deg2rad($lon1);
        $lat2Rad = deg2rad($lat2);
        $lon2Rad = deg2rad($lon2);

        $latDiff = $lat2Rad - $lat1Rad;
        $lonDiff = $lon2Rad - $lon1Rad;

        $a = sin($latDiff / 2) * sin($latDiff / 2) +
         cos($lat1Rad) * cos($lat2Rad) *
         sin($lonDiff / 2) * sin($lonDiff / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        // Kembalikan nilai dari variabel $distance.
        return $distance;
    }
}
