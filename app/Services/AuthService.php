<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            return ['error' => 'Unauthorized'];
        }

        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;

        return ['token' => $token];
    }
}
