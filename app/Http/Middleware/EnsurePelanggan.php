<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePelanggan
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isPelanggan()) {
            return $next($request);
        }

        abort(403, 'Akses hanya untuk admin.');
    }
}
