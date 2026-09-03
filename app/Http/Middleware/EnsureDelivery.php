<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureDelivery
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isDelivery()) {
            abort(403, 'Akses terbatas hanya untuk Delivery Escort Apex.');
        }

        return $next($request);
    }
}
