<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * 
     * SECURITY: Validates admin access and logs unauthorized attempts
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            // Log unauthorized access attempt
            Log::warning('Unauthorized admin access attempt', [
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
                'user_agent' => $request->userAgent(),
            ]);
            abort(403, 'Access denied. Authentication required.');
        }

        if (auth()->user()->role !== 'admin') {
            // Log unauthorized admin access attempt
            Log::warning('Non-admin user attempted admin access', [
                'user_id' => auth()->id(),
                'user_email' => auth()->user()->email,
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
                'user_agent' => $request->userAgent(),
            ]);
            abort(403, 'Access denied. Admins only.');
        }

        return $next($request);
    }
}
