<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckOutGPSLocation
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

        $latitude = $request->input('latitudeCheckOut');
        $longitude = $request->input('longitudeCheckOut');

        $officeLatitude = 0.498443;
        $officeLongitude = 101.490217;

        $distance = $this->calculateDistance($latitude, $longitude, $officeLatitude, $officeLongitude);

        if($distance > $allowedDistance) {
            return response()->json(['error' => 'Lokasi di luar jarak yang diizinkan'], 403);
        }

        return $next($request);
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2){
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $kilometers = $miles * 1.609344;

        return $kilometers;
    }
}
