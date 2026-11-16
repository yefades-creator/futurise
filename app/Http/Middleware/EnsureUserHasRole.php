<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu.');
        }

        $user = auth()->user();

        // Super admin bypasses all role gates
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        if (in_array('panitia', $roles) && $user->isPanitia()) {
            return $next($request);
        }

        if ($user->hasRole($roles)) {
            return $next($request);
        }

        abort(403, 'Akses Ditolak: Peran Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
