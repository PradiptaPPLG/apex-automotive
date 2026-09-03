<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RmMiddleware
{
    /**
     * Only allow Sales RM users to pass through.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() || ! auth()->user()->isRm()) {
            abort(403, 'Akses hanya untuk Sales Relationship Manager.');
        }

        return $next($request);
    }
}
