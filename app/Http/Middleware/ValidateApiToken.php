<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class ValidateApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if token exists
        if(PersonalAccessToken::findToken($request->headers->get('Token')))
            return $next($request);
        
        // Return a response
        return response()->json([
            'message' => 'Unauthorized',
            'data' => null
        ], 401);
    }
}
