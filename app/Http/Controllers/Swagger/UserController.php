<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 *
 * @OA\Post(
 *     path="/api/admin/users",
 *     summary="Create",
 *     tags={"User"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *        required=true,
 *        @OA\JsonContent(
 *            required={"first_name", "last_name", "middle_name", "login", "password", "role_id"},
 *            @OA\Property(property="first_name", type="string", example="User"),
 *            @OA\Property(property="last_name", type="string", example="Userov"),
 *            @OA\Property(property="middle_name", type="string", example="Userovich"),
 *            @OA\Property(property="login", type="string", example="user23"),
 *            @OA\Property(property="password", type="string", example="12345678"),
 *            @OA\Property(property="role_id", type="integer", example=2),
 *            @OA\Property(property="group_id", type="integer", example=1, nullable=true)
 *        )
 *     ),
 *
 *     @OA\Response(
 *        response=200,
 *        description="Ok",
 *        @OA\JsonContent(
 *               @OA\Property(
 *                   property="user",
 *                   type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="first_name", type="string", example="User"),
 *                   @OA\Property(property="last_name", type="string", example="Userov"),
 *                   @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                   @OA\Property(property="login", type="string", example="user23"),
 *                   @OA\Property(property="role_id", type="integer", example=2),
 *                   @OA\Property(property="group_id", type="integer", example=1, nullable=true)
 *               )
 *          )
 *     )
 * ),
 *
 * @OA\Get(
 *      path="/api/admin/users",
 *      summary="UsersInfo",
 *      tags={"User"},
 *      security={{ "bearerAuth": {} }},
 *
 *      @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *            @OA\Property(
 *                property="users",
 *                type="array",
 *                @OA\Items(
 *                @OA\Property(property="id", type="integer", example=1),
 *                @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="first_name", type="string", example="User"),
 *                @OA\Property(property="last_name", type="string", example="Userov"),
 *                @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                @OA\Property(property="login", type="string", example="user23"),
 *                @OA\Property(property="role_id", type="integer", example=2),
 *                @OA\Property(property="group_id", type="integer", example=1, nullable=true)
 *              )
 *           )
 *        )
 *     )
 * ),
 *
 * @OA\Get(
 *        path="/api/admin/users/{user}",
 *        summary="GetUserID",
 *        tags={"User"},
 *        security={{ "bearerAuth": {} }},
 *
 *        @OA\Parameter(
 *            description="User ID",
 *            in="path",
 *            name="user",
 *            required=true,
 *            example=1
 *        ),
 *
 *        @OA\Response(
 *           response=200,
 *           description="Ok",
 *           @OA\JsonContent(
 *              @OA\Property(
 *                  property="user",
 *                  type="object",
 *                  @OA\Property(property="id", type="integer", example=1),
 *                  @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                  @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                  @OA\Property(property="first_name", type="string", example="User"),
 *                  @OA\Property(property="last_name", type="string", example="Userov"),
 *                  @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                  @OA\Property(property="login", type="string", example="user23"),
 *                  @OA\Property(property="role_id", type="integer", example=2),
 *                  @OA\Property(property="group_id", type="integer", example=1, nullable=true)
 *              )
 *          )
 *      )
 *  ),
 *
 * @OA\Put(
 *       path="/api/admin/users/{user}",
 *       summary="Update",
 *       tags={"User"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="User ID",
 *           in="path",
 *           name="user",
 *           required=true,
 *           example=1
 *       ),
 *
 *       @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"first_name", "last_name", "middle_name", "login", "password", "role_id"},
 *             @OA\Property(property="first_name", type="string", example="User"),
 *             @OA\Property(property="last_name", type="string", example="Userov"),
 *             @OA\Property(property="middle_name", type="string", example="Userovich"),
 *             @OA\Property(property="login", type="string", example="user23"),
 *             @OA\Property(property="password", type="string", example="12345678"),
 *             @OA\Property(property="role_id", type="integer", example=2),
 *             @OA\Property(property="group_id", type="integer", example=1, nullable=true)
 *         )
 *      ),
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *             @OA\Property(
 *                 property="user",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="first_name", type="string", example="User"),
 *                 @OA\Property(property="last_name", type="string", example="Userov"),
 *                 @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                 @OA\Property(property="login", type="string", example="user23"),
 *                 @OA\Property(property="role_id", type="integer", example=2),
 *                 @OA\Property(property="group_id", type="integer", example=1, nullable=true)
 *             )
 *         )
 *     )
 * ),
 *
 * @OA\Delete(
 *       path="/api/admin/users/{user}",
 *       summary="Delete",
 *       tags={"User"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="User ID",
 *           in="path",
 *           name="user",
 *           required=true,
 *           example=1
 *        ),
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *       )
 * ),
 */
class UserController extends Controller
{
    //
}
