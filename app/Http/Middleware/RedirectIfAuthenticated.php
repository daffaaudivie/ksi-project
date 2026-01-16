<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return $this->redirectBasedOnRole();
            }
        }

        return $next($request);
    }

    protected function redirectBasedOnRole(): Response
    {
        $user = auth()->user();

        return match ($user->role) {
            Role::ADMIN => redirect()->route('admin.dashboard'),
            Role::STAFF => redirect()->route('staff.dashboard'),
            default => redirect('/'),
        };
    }
}
