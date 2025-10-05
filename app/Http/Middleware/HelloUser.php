<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HelloUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Share for views (optional)
            view()->share('hello_user_name', Auth::user()->name);
        }

        $response = $next($request);

        // Append a helpful header
        if (method_exists($response, 'header')) {
            $response->header('X-Hello-User', Auth::check() ? Auth::user()->name : 'Guest');
        }

        return $response;
    }
}
