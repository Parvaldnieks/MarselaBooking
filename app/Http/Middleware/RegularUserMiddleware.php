<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RegularUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        \Log::info('RegularUserMiddleware executed');
        
        if (!auth()->check() || !auth()->user()->is_admin) {
            \Log::info('User is not an admin');
            return redirect()->route('home');
        }

        return $next($request);
    }
}