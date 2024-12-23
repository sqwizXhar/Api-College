<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 *
 * @OA\Post(
 *     path="/api/admin/groups",
 *     summary="Create",
 *     tags={"Group"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *        required=true,
 *        @OA\JsonContent(
 *            required={"name"},
 *            @OA\Property(property="name", type="string", example="OAIp2")
 *        )
 *     ),
 *
 *     @OA\Response(
 *        response=200,
 *        description="Ok",
 *        @OA\JsonContent(
 *               @OA\Property(
 *                   property="group",
 *                   type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="name", type="string", example="OAIp2")
 *               )
 *          )
 *     )
 * ),
 *
 * @OA\Post(
 *      path="/api/admin/group/{group}/user/{user}",
 *      summary="Create",
 *      tags={"Group User"},
 *      security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         description="Group ID",
 *         in="path",
 *         name="group",
 *         required=true,
 *         example=1
 *     ),
 *
 *     @OA\Parameter(
 *          description="User ID",
 *          in="path",
 *          name="user",
 *          required=true,
 *          example=1
 *      ),
 *
 *      @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *                @OA\Property(
 *                    property="group",
 *                    type="object",
 *                    @OA\Property(property="id", type="integer", example=1),
 *                    @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                    @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                    @OA\Property(property="name", type="string", example="OAIp2"),
 *                    @OA\Property(
 *                        property="users",
 *                        type="array",
 *                        @OA\Items(
 *                            @OA\Property(property="first_name", type="string", example="User"),
 *                            @OA\Property(property="last_name", type="string", example="Userov"),
 *                            @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                        ),
 *                    )
 *                )
 *           )
 *      )
 *  ),
 *
 * @OA\Get(
 *      path="/api/admin/groups",
 *      summary="GroupsInfo",
 *      tags={"Group"},
 *      security={{ "bearerAuth": {} }},
 *
 *      @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *            @OA\Property(
 *                property="groups",
 *                type="array",
 *                @OA\Items(
 *                @OA\Property(property="id", type="integer", example=1),
 *                @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="name", type="string", example="OAIp2")
 *              )
 *           )
 *        )
 *     )
 * ),
 *
 * @OA\Get(
 *         path="/api/admin/groups/{group}",
 *         summary="GetGroupID",
 *         tags={"Group"},
 *         security={{ "bearerAuth": {} }},
 *
 *         @OA\Parameter(
 *             description="Group ID",
 *             in="path",
 *             name="group",
 *             required=true,
 *             example=1
 *         ),
 *
 *         @OA\Response(
 *            response=200,
 *            description="Ok",
 *            @OA\JsonContent(
 *               @OA\Property(
 *                   property="group",
 *                   type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="name", type="string", example="OAIp2")
 *               )
 *           )
 *       )
 *   ),
 *
 * @OA\Get(
 *       path="/api/admin/group/users",
 *       summary="GroupsUserInfo",
 *       tags={"Group User"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="Role name",
 *           in="query",
 *           name="role",
 *           required=true,
 *           @OA\Schema(type="string", enum={"student", "teacher"})
 *       ),
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *             @OA\Property(
 *                 property="groups",
 *                 type="array",
 *                 @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="name", type="string", example="OAIp2"),
 *                 @OA\Property(
 *                     property="users",
 *                     type="array",
 *                     @OA\Items(
 *                         @OA\Property(property="first_name", type="string", example="User"),
 *                         @OA\Property(property="last_name", type="string", example="Userov"),
 *                         @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                     ),
 *                  )
 *               )
 *            )
 *         )
 *      )
 *  ),
 *
 * @OA\Put(
 *       path="/api/admin/groups/{group}",
 *       summary="Update",
 *       tags={"Group"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="Group ID",
 *           in="path",
 *           name="group",
 *           required=true,
 *           example=1
 *       ),
 *
 *       @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name"},
 *             @OA\Property(property="name", type="string", example="OAIp2")
 *         )
 *      ),
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *             @OA\Property(
 *                 property="group",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="name", type="string", example="OAIp2")
 *             )
 *         )
 *     )
 * ),
 *
 * @OA\Delete(
 *       path="/api/admin/groups/{group}",
 *       summary="Delete",
 *       tags={"Group"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="Group ID",
 *           in="path",
 *           name="group",
 *           required=true,
 *           example=1
 *        ),
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *       )
 * ),
 *
 * @OA\Delete(
 *        path="/api/admin/group/{group}/user/{user}",
 *        summary="Delete",
 *        tags={"Group User"},
 *        security={{ "bearerAuth": {} }},
 *
 *        @OA\Parameter(
 *             description="Group ID",
 *             in="path",
 *             name="group",
 *             required=true,
 *             example=1
 *          ),
 *
 *         @OA\Parameter(
 *              description="User ID",
 *              in="path",
 *              name="user",
 *              required=true,
 *              example=1
 *           ),
 *
 *        @OA\Response(
 *           response=200,
 *           description="Ok",
 *        )
 *  ),
 */
class GroupController extends Controller
{
    //
}
