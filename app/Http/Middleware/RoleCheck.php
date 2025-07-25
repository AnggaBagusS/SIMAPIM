<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if ($role == 'admin' && $user->type == 1) {
            return $next($request);
        }

        if ($role == 'staff' && $user->type == 2) {
            return $next($request);
        }

        return abort(403, 'Unauthorized');
    }
}
