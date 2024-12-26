<?php

namespace App\Http\Controllers;

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
abstract class Controller
{
    //
}
