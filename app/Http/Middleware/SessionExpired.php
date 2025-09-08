<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SessionExpired
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (!$user->is_logged_in) {
                Auth::logout();
                return redirect('/login')->with('message', 'Session expired');
            }
        }
        
        return $next($request);
    }
}