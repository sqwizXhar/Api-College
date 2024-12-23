<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 *
 * @OA\Post(
 *     path="/api/grades",
 *     summary="Create",
 *     tags={"Grade"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *        required=true,
 *        @OA\JsonContent(
 *            required={"grade", "user_id", "date_id"},
 *            @OA\Property(property="grade", type="integer", example=5),
 *            @OA\Property(property="user_id", type="integer", example=2),
 *            @OA\Property(property="date_id", type="integer", example=2),
 *        )
 *     ),
 *
 *     @OA\Response(
 *        response=200,
 *        description="Ok",
 *        @OA\JsonContent(
 *               @OA\Property(
 *                   property="grade",
 *                   type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="grade", type="integer", example=5),
 *                   @OA\Property(property="user", type="string", example="User Userov Userovich"),
 *                   @OA\Property(property="date", type="string", format="date", example="2024-12-20"),
 *               )
 *          )
 *     )
 * ),
 *
 * @OA\Get(
 *       path="/api/grades",
 *       summary="GradesInfo for Students",
 *       tags={"Grade"},
 *       security={{ "bearerAuth": {} }},
 *
 *
 *      @OA\Parameter(
 *          description="User ID",
 *          in="query",
 *          name="user",
 *          required=true,
 *          @OA\Schema(type="integer"),
 *          example=1
 *      ),
 *
 *      @OA\Parameter(
 *           description="Date ID",
 *           in="query",
 *           name="date",
 *           required=false,
 *           @OA\Schema(type="string", format="date"),
 *       ),
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *             @OA\Property(
 *                 property="grades",
 *                 type="array",
 *                 @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="grade", type="integer", example=5),
 *                 @OA\Property(property="user", type="string", example="User Userov Userovich"),
 *                 @OA\Property(property="date", type="string", format="date", example="2024-12-20")
 *               )
 *            )
 *         )
 *      )
 *  ),
 *
 * @OA\Get(
 *      path="/api/teacher/grades",
 *      summary="GradesInfo for Teachers",
 *      tags={"Grade"},
 *      security={{ "bearerAuth": {} }},
 *
 *
 *     @OA\Parameter(
 *         description="User ID",
 *         in="query",
 *         name="user",
 *         required=true,
 *         @OA\Schema(type="integer"),
 *         example=1
 *     ),
 *
 *     @OA\Parameter(
 *          description="Date ID",
 *          in="query",
 *          name="date",
 *          required=false,
 *          @OA\Schema(type="string", format="date"),
 *      ),
 *
 *      @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *            @OA\Property(
 *                property="grades",
 *                type="array",
 *                @OA\Items(
 *                @OA\Property(property="id", type="integer", example=1),
 *                @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="grade", type="integer", example=5),
 *                @OA\Property(property="user", type="string", example="User Userov Userovich"),
 *                @OA\Property(property="date", type="string", format="date", example="2024-12-20")
 *              )
 *           )
 *        )
 *     )
 * ),
 *
 *
 * @OA\Put(
 *       path="/api/grades/{grade}",
 *       summary="Update",
 *       tags={"Grade"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="Grade ID",
 *           in="path",
 *           name="grade",
 *           required=true,
 *           example=1
 *       ),
 *
 *       @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"grade", "user_id", "date_id"},
 *             @OA\Property(property="grade", type="integer", example=5),
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="date_id", type="integer", example=1),
 *         )
 *      ),
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *             @OA\Property(
 *                 property="grade",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="grade", type="integer", example=5),
 *                 @OA\Property(property="user", type="string", example="User Userov Userovich"),
 *                 @OA\Property(property="date", type="string", format="date", example="2024-12-20"),
 *             )
 *         )
 *     )
 * )
 *
 * @OA\Delete(
 *       path="/api/grades/{grade}",
 *       summary="Delete",
 *       tags={"Grade"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="Grade ID",
 *           in="path",
 *           name="grade",
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
class GradeController extends Controller
{
    //
}
