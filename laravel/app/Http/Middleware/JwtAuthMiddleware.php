<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Utils\Auth\JwtService;

class JwtAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token ) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        try {

            $decoded = JwtService::decode($token);
            $request->attributes->set('jwt_user_id', $decoded['sub']);
            $request->attributes->set('jwt_user_name', $decoded['userName']);

        } catch (\Firebase\JWT\ExpiredException $e) {
            return response()->json(['error' => 'Token expired'], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid token: ' . $e->getMessage()], 401);
        }

        return $next($request);
    }
}
