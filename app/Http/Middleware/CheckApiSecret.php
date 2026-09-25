<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiSecret
{
    public function handle(Request $request, Closure $next)
    {
        $secret = $request->header('X-Api-Secret');
        $expected = config('services.api.secret');

        // env() returns null once the config is cached: read it through config()
        // and never accept a request when no secret is configured.
        if (! $expected || ! is_string($secret) || ! hash_equals($expected, $secret)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}