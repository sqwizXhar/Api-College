<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 *
 * @OA\Post(
 *     path="/api/admin/semesters",
 *     summary="Create",
 *     tags={"Semester"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *        required=true,
 *        @OA\JsonContent(
 *            required={"number", "start_date", "end_date"},
 *            @OA\Property(property="number", type="integer", example=1),
 *            @OA\Property(property="start_date", type="string", format="date", example="1994-10-11"),
 *            @OA\Property(property="end_date", type="string", format="date", example="2002-01-19"),
 *            @OA\Property(property="group_id", type="integer", example=1)
 *        )
 *     ),
 *
 *     @OA\Response(
 *        response=200,
 *        description="Ok",
 *        @OA\JsonContent(
 *               @OA\Property(
 *                   property="semester",
 *                   type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="number", type="integer", example=1),
 *                   @OA\Property(property="start_date", type="string", format="date", example="1994-10-11"),
 *                   @OA\Property(property="end_date", type="string", format="date", example="2002-01-19")
 *               )
 *          )
 *     )
 * ),
 *
 * @OA\Get(
 *      path="/api/admin/semesters",
 *      summary="SemestersInfo",
 *      tags={"Semester"},
 *      security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *          name="group",
 *          in="query",
 *          description="Group name",
 *          required=true,
 *          @OA\Schema(type="string"),
 *          example="OAIp2"
 *     ),
 *
 *      @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *            @OA\Property(
 *                property="semesters",
 *                type="array",
 *                @OA\Items(
 *                @OA\Property(property="id", type="integer", example=1),
 *                @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="number", type="integer", example=1),
 *                @OA\Property(property="start_date", type="string", format="date", example="1994-10-11"),
 *                @OA\Property(property="end_date", type="string", format="date", example="2002-01-19")
 *              )
 *           )
 *        )
 *     )
 * ),
 *
 * @OA\Put(
 *       path="/api/admin/semesters/{semester}",
 *       summary="Update",
 *       tags={"Semester"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="Semester ID",
 *           in="path",
 *           name="semester",
 *           required=true,
 *           example=1
 *       ),
 *
 *       @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"number", "start_date", "end_date"},
 *             @OA\Property(property="number", type="integer", example=1),
 *             @OA\Property(property="start_date", type="string", format="date", example="1994-10-11"),
 *             @OA\Property(property="end_date", type="string", format="date", example="2002-01-19"),
 *             @OA\Property(property="group_id", type="integer", example=1)
 *         )
 *      ),
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *             @OA\Property(
 *                 property="semester",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="number", type="integer", example=1),
 *                 @OA\Property(property="start_date", type="string", format="date", example="1994-10-11"),
 *                 @OA\Property(property="end_date", type="string", format="date", example="2002-01-19")
 *             )
 *         )
 *     )
 * ),
 *
 * @OA\Delete(
 *       path="/api/admin/semesters/{semester}",
 *       summary="Delete",
 *       tags={"Semester"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="Semester ID",
 *           in="path",
 *           name="semester",
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
class SemesterController extends Controller
{
    //
}
