<?php

namespace App\Services\Auth;

class LoginService
{
    /**
     * @param $credentials
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function execute($credentials)
    {
        if (!$token = auth()->setTTL(5)->attempt($credentials))
            return response()->json(['error' => 'Unauthorized'], 401);

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL(),
            'use' => auth()->user()
        ];
    }
}
