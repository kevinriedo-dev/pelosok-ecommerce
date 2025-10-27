<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }
        
        // Check if user is admin (by email)
        if (auth()->user()->email !== 'admin@pelosokecommerce.com') {
            return redirect()->route('home')->with('error', 'Access denied. Admin only.');
        }
        
        return $next($request);
    }
}