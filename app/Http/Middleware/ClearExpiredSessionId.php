<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ClearExpiredSessionId
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        if (!Auth::check()) {
            $sessionId = $request->session()->getId();

            if ($sessionId) {
                User::where('session_id', $sessionId)->update(['session_id' => null]);
            }
        }
    }
}
