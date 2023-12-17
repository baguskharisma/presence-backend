<?php

namespace App\Http\Middleware;

use Closure;

// Impor kelas Request untuk mewakili dan memproses data permintaan HTTP.
use Illuminate\Http\Request;

class IsAdmin
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
        // Kondisi jika pengguna yang login berstatus user.
        if(auth()->guest() || auth()->user()->position_id !== 1){
            // Tolak akses.
            abort(403);
        }

        // Lanjut ke fungsi yang diizinkan.
        return $next($request);
    }
}
