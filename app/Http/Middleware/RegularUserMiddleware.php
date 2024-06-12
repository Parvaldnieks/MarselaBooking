<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RegularUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Logic to check if the user is a regular user
        if (!auth()->check() || auth()->user()->is_admin) {
            // If the user is not logged in or is an admin, proceed with the request
            return $next($request);
        }

        // For regular users, you might want to handle access restrictions differently
        // For now, let's just return without redirection
        return $next($request);
    }
}