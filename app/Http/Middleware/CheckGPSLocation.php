<?php

namespace App\Http\Middleware;

use Closure;
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
        $allowedDistance = 0.1;

        $latitude = $request->input('latitudeCheckIn');
        $longitude = $request->input('longitudeCheckIn');

        $officeLatitude = 0.498443;
        $officeLongitude = 101.490217;

        $distance = $this->calculateDistance($latitude, $longitude, $officeLatitude, $officeLongitude);

        if($distance > $allowedDistance) {
            return response()->json(['error' => 'Lokasi diluar jarak yang diinginkan'], 403);
        }

        return $next($request);
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2){
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

        return $distance;
    }
}
