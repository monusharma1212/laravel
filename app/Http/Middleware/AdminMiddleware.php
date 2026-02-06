<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Agar login hi nahi hai
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Agar role admin nahi hai
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Access Denied - Admin Only');
        }

        return $next($request);
    }
}
