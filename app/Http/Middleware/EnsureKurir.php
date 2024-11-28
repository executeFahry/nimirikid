<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureKurir
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isKurir()) {
            return $next($request);
        }

        abort(403, 'Akses hanya untuk kurir.');
    }
}
