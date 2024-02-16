<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next) // : Response
    {
        $user = Auth::user();
        
        if ($user && $user->is_admin) {
            return $next($request);
        }
        return response()->json(['message' => 'Unauthorized. Admin acces required.'], 403);
    }
}
