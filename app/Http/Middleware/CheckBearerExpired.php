<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckBearerExpired
{
    public function handle(Request $request, Closure $next)
    {
        if (!JWTAuth::parseToken()->check()) {
            return response()->json([
                'message' => 'Bearer token is expired'
            ], 403);
        }

        return $next($request);
    }
}
