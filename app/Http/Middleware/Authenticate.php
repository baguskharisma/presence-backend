<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // Kondisi jika pengguna belum login.
        if (! $request->expectsJson()) {
            // Arahkan pengguna kembali ke halaman login.
            return route('login');
        }
    }
}
