<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOrganizationOwnership
{
    /**
     * Prevent Insecure Direct Object References (IDOR) - Acceptance 01
     * PIC cannot view or modify data of another organization
     */
    public function handle(Request $request, Closure $next, ?string $paramName = 'organization_id'): Response
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Panitia & Super Admin can manage all organizations
        if ($user->isPanitia()) {
            return $next($request);
        }

        // Get organization ID from route param or request body
        $requestedOrgId = $request->route($paramName) 
            ?? $request->route('organization')?->id 
            ?? $request->input($paramName);

        if ($requestedOrgId) {
            $userOrgIds = $user->organizations()->pluck('organizations.id')->toArray();

            if (!in_array((int)$requestedOrgId, $userOrgIds)) {
                abort(403, 'Akses Ditolak (Acceptance 01 IDOR Protection): Anda tidak memiliki izin untuk melihat atau mengubah data institusi/organisasi lain.');
            }
        }

        return $next($request);
    }
}
