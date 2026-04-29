<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesion para acceder.');
        }

        if (! in_array($user->role, $roles, true)) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para acceder a esta URL.');
        }

        return $next($request);
    }
}
