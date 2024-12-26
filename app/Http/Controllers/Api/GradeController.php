<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Grade\GradeRequest;
use App\Http\Requests\Grade\StoreGradeRequest;
use App\Http\Requests\Grade\UpdateGradeRequest;
use App\Http\Resources\Grade\GradeCollection;
use App\Http\Resources\Grade\GradeResource;
use App\Models\Date;
use App\Models\Grade;
use App\Models\User;

/**
 *
 * @OA\Post(
 *     path="/api/teacher/grades",
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
 *                   @OA\Property(property="student", type="string", example="User Userov Userovich"),
 *                   @OA\Property(property="grade", type="integer", example=5),
 *                   @OA\Property(property="date", type="string", format="date", example="2024-12-20"),
 *                   @OA\Property(property="teacher", type="string", example="User Userov Userovich"),
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
 *                 @OA\Property(property="student", type="string", example="User Userov Userovich"),
 *                 @OA\Property(property="grade", type="integer", example=5),
 *                 @OA\Property(property="date", type="string", format="date", example="2024-12-20"),
 *                 @OA\Property(property="teacher", type="string", example="User Userov Userovich"),
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
 *                @OA\Property(property="student", type="string", example="User Userov Userovich"),
 *                @OA\Property(property="grade", type="integer", example=5),
 *                @OA\Property(property="date", type="string", format="date", example="2024-12-20"),
 *                @OA\Property(property="teacher", type="string", example="User Userov Userovich"),
 *              )
 *           )
 *        )
 *     )
 * ),
 *
 *
 * @OA\Put(
 *       path="/api/teacher/grades/user/{user}/date/{date}",
 *       summary="Update",
 *       tags={"Grade"},
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
 *       @OA\Parameter(
 *            description="Date",
 *            in="path",
 *            name="date",
 *            required=false,
 *            example="2024-12-26"
 *        ),
 *
 *       @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"grade"},
 *             @OA\Property(property="grade", type="integer", example=5)
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
 *                 @OA\Property(property="student", type="string", example="User Userov Userovich"),
 *                 @OA\Property(property="grade", type="integer", example=5),
 *                 @OA\Property(property="date", type="string", format="date", example="2024-12-20"),
 *                 @OA\Property(property="teacher", type="string", example="User Userov Userovich"),
 *             )
 *         )
 *     )
 * )
 *
 * @OA\Delete(
 *       path="/api/tecaher/grades/{grade}",
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
    /**
     * Display a listing of the resource.
     */
    public function index(GradeRequest $request)
    {
        $validated = $request->validated();

        $user = $validated['user'];
        $date = $validated['date'] ?? null;

        $grade = Grade::whereHas('user', function ($query) use ($user) {
            $query->where('id', $user);
        })
            ->whereHas('date', function ($query) use ($date) {
                if (isset($date)) {
                    $query->where('date', $date);
                }
            })
            ->get();

        return new GradeCollection($grade);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradeRequest $request)
    {
        $validated = $request->validated();

        $user = User::find($validated['user_id']);
        $date = Date::find($validated['date_id']);

        $grade = new Grade();
        $grade->fill($validated);
        $grade->user()->associate($user);
        $grade->date()->associate($date);
        $grade->save();

        return new GradeResource($grade);
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        return new GradeResource($grade);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGradeRequest $request, User $user, string $date)
    {
        $validated = $request->validated();

        $grade = Grade::where('user_id', $user->id)
            ->whereHas('date', function ($query) use ($date) {
                $query->where('date', $date);
            })
              ->first();

        $grade->update(['grade' => $validated['grade']]);

        return new GradeResource($grade);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();

        return response()->json();
    }
}
