<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 1. Check if the user is currently logged in
        if (Auth::check()) {
            
            // 2. Check if the logged-in user has Admin privileges.
            // Note: This requires an 'isAdmin()' method in your 'App\User' model.
            if (Auth::user()->isAdmin()) {
                return $next($request);       
            }
        }

        // 3. If user is not logged in OR is not an admin, redirect them.
        // You can also add ->with('error', 'Access Denied') if you have alert messages set up.
        return redirect('/login');
    }
}