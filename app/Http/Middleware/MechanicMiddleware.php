<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MechanicMiddleware
{
    /**
     * Only allow Mechanic / Service Advisor users to pass through.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() || ! auth()->user()->isMechanic()) {
            abort(403, 'Akses hanya untuk Mekanik & Service Advisor.');
        }

        return $next($request);
    }
}
