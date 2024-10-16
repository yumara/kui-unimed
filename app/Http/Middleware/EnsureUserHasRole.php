<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if ($request->user()->hasRole($role)) {
            return $next($request);
        }

        abort(403, "Anda tidak memiliki akses halaman ini.");
    }
}
