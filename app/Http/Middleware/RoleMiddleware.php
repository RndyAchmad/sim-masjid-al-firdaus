<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {
        $user = $request->user();

        // Pastikan pengguna sudah login
        if (!$user) {
            return redirect()->guest(route('login'));
        }

        // Pastikan role pengguna valid dan diizinkan
        $userRole = $user->role;

        if ($userRole instanceof UserRole) {
            $userRole = $userRole->value;
        }

        $allowedRoles = array_map(
            fn(UserRole $role) => $role->value,
            array_filter(
                UserRole::cases(),
                fn(UserRole $role) => in_array(
                    $role->value,
                    $roles,
                    true
                )
            )
        );

        if (!in_array($userRole, $allowedRoles, true)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
