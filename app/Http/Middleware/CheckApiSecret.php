<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiSecret
{
    public function handle(Request $request, Closure $next)
    {
        $secret = $request->header('X-Api-Secret');

        if ($secret !== env('API_SECRET')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}