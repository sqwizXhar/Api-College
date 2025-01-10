<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Services\AuthService;

/**
 *
 * @OA\Post(
 *     path="/api/login",
 *     summary="Login",
 *     tags={"Auth"},
 *
 *     @OA\RequestBody(
 *        required=true,
 *        @OA\JsonContent(
 *            required={"login", "password"},
 *            @OA\Property(property="login", type="string", example="admin"),
 *            @OA\Property(property="password", type="string", example="password")
 *        )
 *     ),
 *
 *     @OA\Response(
 *        response=200,
 *        description="Ok",
 *        @OA\JsonContent(
 *               @OA\Property(property="token", type="string", example="your_token_here"),
 *          )
 *     )
 * ),
 */
class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request->validated());

        if (isset($result['error'])) {
            return response()->json($result, 401);
        }

        return response()->json($result);
    }

    public function logout()
    {
        $this->authService->logout();

        return response()->json(['message' => __('error.successfully_logged_out')]);
    }
}
