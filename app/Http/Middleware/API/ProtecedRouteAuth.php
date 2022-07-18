<?php

namespace App\Http\Middleware\API;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProtecedRouteAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e)
        {
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
                return response()->json(['message' => 'Token inválido', 'type' => 'error'], 401);
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
                return response()->json(['message' => 'Token expirado', 'type' => 'error'], 401);

            return response()->json(['message' => 'Token não encontrado.', 'type' => 'error'], 401);
        }
        return $next($request);
    }
}
