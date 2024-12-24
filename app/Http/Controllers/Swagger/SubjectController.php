<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 *
 * @OA\Post(
 *     path="/api/admin/subjects",
 *     summary="Create",
 *     tags={"Subject"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *        required=true,
 *        @OA\JsonContent(
 *            required={"name"},
 *            @OA\Property(property="name", type="string", example="Math")
 *        )
 *     ),
 *
 *     @OA\Response(
 *        response=200,
 *        description="Ok",
 *        @OA\JsonContent(
 *               @OA\Property(
 *                   property="subject",
 *                   type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="name", type="string", example="Math")
 *               )
 *          )
 *     )
 * ),
 *
 * @OA\Get(
 *      path="/api/admin/subjects",
 *      summary="SubjectsInfo",
 *      tags={"Subject"},
 *      security={{ "bearerAuth": {} }},
 *
 *      @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *            @OA\Property(
 *                property="subjects",
 *                type="array",
 *                @OA\Items(
 *                @OA\Property(property="id", type="integer", example=1),
 *                @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="name", type="string", example="Math")
 *              )
 *           )
 *        )
 *     )
 * ),
 *
 * @OA\Get(
 *         path="/api/admin/subjects/{subject}",
 *         summary="GetSubjectID",
 *         tags={"Subject"},
 *         security={{ "bearerAuth": {} }},
 *
 *         @OA\Parameter(
 *             description="Subject ID",
 *             in="path",
 *             name="subject",
 *             required=true,
 *             example=1
 *         ),
 *
 *         @OA\Response(
 *            response=200,
 *            description="Ok",
 *            @OA\JsonContent(
 *               @OA\Property(
 *                   property="subject",
 *                   type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="name", type="string", example="Math")
 *               )
 *           )
 *       )
 *   ),
 *
 * @OA\Put(
 *       path="/api/admin/subjects/{subject}",
 *       summary="Update",
 *       tags={"Subject"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="Subject ID",
 *           in="path",
 *           name="subject",
 *           required=true,
 *           example=1
 *       ),
 *
 *       @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name"},
 *             @OA\Property(property="name", type="string", example="Math")
 *         )
 *      ),
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *             @OA\Property(
 *                 property="subject",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="name", type="string", example="Math")
 *             )
 *         )
 *     )
 * ),
 *
 * @OA\Delete(
 *       path="/api/admin/subjects/{subject}",
 *       summary="Delete",
 *       tags={"Subject"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="Subject ID",
 *           in="path",
 *           name="subject",
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
class SubjectController extends Controller
{
    //
}
