<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestUserRole
{
    /**
     * Allow only users with one of the provided roles.
     *
     * Accepts any number of role parameters (e.g. 'TestRole:admin,user').
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Allow everyone to access if no roles are specified
        if (empty($roles)) {
            return $next($request);
        }
        if (! Auth::check() || ! in_array(Auth::user()->role, $roles)) {
            return redirect()->route('dashboard')->with('success', 'You do not have the required role to access this page.');
        }
        return $next($request);
    }
}
