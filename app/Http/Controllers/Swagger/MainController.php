<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     title="Backend API",
 *     version="1.0.0",
 * )
 *
 * @OA\PathItem(
 *     path="/api/"
 * )
 *
 * @OA\Components(
 *     @OA\SecurityScheme(
 *         securityScheme="bearerAuth",
 *         in="header",
 *         name="Authorization",
 *         type="http",
 *         scheme="bearer",
 *         bearerFormat="JWT"
 *     )
 * )
 */
class MainController extends Controller
{
    //
}
