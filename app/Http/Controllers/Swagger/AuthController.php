<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

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
 *            @OA\Property(property="login", type="string", example="user23"),
 *            @OA\Property(property="password", type="string", example="12345678")
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
    //
}
