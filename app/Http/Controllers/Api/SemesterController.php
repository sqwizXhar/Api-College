<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Semester\SemesterRequest;
use App\Http\Requests\Semester\StoreSemesterRequest;
use App\Http\Resources\Semester\SemesterCollection;
use App\Http\Resources\Semester\SemesterResource;
use App\Models\Group;
use App\Models\Semester;

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
    /**
     * Display a listing of the resource.
     */
    public function index(SemesterRequest $request)
    {
        $validated = $request->validated();
        $group = $validated['group'];

        $semester = Semester::whereHas('group', function ($query) use ($group) {
                $query->where('name', $group);
            })
            ->orderBy('number')
            ->get();

        return new SemesterCollection($semester);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSemesterRequest $request)
    {
        $validated = $request->validated();

        $group = Group::find($validated['group_id']);

        $semester = new Semester();
        $semester->fill($validated);
        $semester->group()->associate($group);
        $semester->save();

        return new SemesterResource($semester);
    }

    /**
     * Display the specified resource.
     */
    public function show(Semester $semester)
    {
        return new SemesterResource($semester);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSemesterRequest $request, Semester $semester)
    {
        $validated = $request->validated();

        $semester->group()->associate($validated['group_id']);

        $semester->update($validated);

        return new SemesterResource($semester);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semester $semester)
    {
        $semester->delete();

        return response()->json();
    }
}
