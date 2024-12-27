<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lesson\LessonRequest;
use App\Http\Requests\Lesson\StoreLessonRequest;
use App\Http\Resources\Lesson\LessonResource;
use App\Models\Lesson;
use App\Services\LessonService;

/**
 *
 * @OA\Post(
 *     path="/api/admin/lessons",
 *     summary="Create",
 *     tags={"Lesson"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *        required=true,
 *        @OA\JsonContent(
 *            required={"day_of_week", "time", "number_of_lesson", "cabinet_id", "subject_user_id", "semester_id"},
 *            @OA\Property(property="day_of_week", type="string", example="Понедельник"),
 *            @OA\Property(property="time", type="string", format="time", example="13:00"),
 *            @OA\Property(property="number_of_lesson", type="integer", example=1),
 *            @OA\Property(property="cabinet_id", type="integer", example=1),
 *            @OA\Property(property="subject_user_id", type="integer", example=1),
 *            @OA\Property(property="semester_id", type="integer", example=1)
 *        )
 *     ),
 *
 *     @OA\Response(
 *        response=200,
 *        description="Ok",
 *        @OA\JsonContent(
 *               @OA\Property(
 *                   property="lesson",
 *                   type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="time", type="string", format="time", example="13:00"),
 *                   @OA\Property(property="number_of_lesson", type="integer", example=1),
 *                   @OA\Property(property="cabinet", type="string", example="21"),
 *                   @OA\Property(property="subject", type="string", example="Russian"),
 *                   @OA\Property(property="teacher", type="string", example="User Userov Userovich"),
 *               )
 *          )
 *     )
 * ),
 *
 * @OA\Get(
 *      path="/api/lessons",
 *      summary="LessonsInfo",
 *      tags={"Lesson"},
 *      security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         name="has_weekly_schedule",
 *         in="query",
 *         description="Weekly Schedule (1 for true, 0 for false)",
 *         required=true,
 *         @OA\Schema(type="integer", enum={0, 1}, example=1)
 *     ),
 *
 *     @OA\Parameter(
 *          name="semester",
 *          in="query",
 *          description="Semester ID",
 *          required=false,
 *          @OA\Schema(type="intger")
 *      ),
 *
 *     @OA\Parameter(
 *           name="date",
 *           in="query",
 *           description="Date",
 *           required=false,
 *           @OA\Schema(type="date", format="date")
 *       ),
 *
 *      @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *            @OA\Property(
 *                property="Понедельник",
 *                type="array",
 *                @OA\Items(
 *                @OA\Property(property="id", type="integer", example=1),
 *                @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="time", type="string", format="time", example="13:00"),
 *                @OA\Property(property="number_of_lesson", type="integer", example=1),
 *                @OA\Property(property="cabinet", type="string", example="21"),
 *                @OA\Property(property="subject", type="string", example="Russian"),
 *                @OA\Property(property="teacher", type="string", example="User Userov Userovich"),
 *              )
 *           )
 *        )
 *     )
 * ),
 *
 * @OA\Put(
 *       path="/api/admin/lessons/{lesson}",
 *       summary="Update",
 *       tags={"Lesson"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="Lesson ID",
 *           in="path",
 *           name="lesson",
 *           required=true,
 *           example=1
 *       ),
 *
 *       @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"day_of_week", "time", "number_of_lesson", "cabinet_id", "subject_user_id", "semester_id"},
 *             @OA\Property(property="day_of_week", type="string", example="Понедельник"),
 *             @OA\Property(property="time", type="string", format="time", example="13:00"),
 *             @OA\Property(property="number_of_lesson", type="integer", example=1),
 *             @OA\Property(property="cabinet_id", type="integer", example=1),
 *             @OA\Property(property="subject_user_id", type="integer", example=1),
 *             @OA\Property(property="semester_id", type="integer", example=1)
 *         )
 *      ),
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *             @OA\Property(
 *                 property="lesson",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="time", type="string", format="time", example="13:00"),
 *                 @OA\Property(property="number_of_lesson", type="integer", example=1),
 *                 @OA\Property(property="cabinet", type="string", example="21"),
 *                 @OA\Property(property="subject", type="string", example="Russian"),
 *                 @OA\Property(property="teacher", type="string", example="User Userov Userovich"),
 *             )
 *         )
 *     )
 * ),
 *
 * @OA\Delete(
 *       path="/api/admin/lessons/{lesson}",
 *       summary="Delete",
 *       tags={"Lesson"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="Lesson ID",
 *           in="path",
 *           name="lesson",
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
class LessonController extends Controller
{
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(LessonRequest $request)
    {
        $validated = $request->validated();

        $weeklySchedule = $this->lessonService->getWeeklySchedule($validated);

        return response()->json($weeklySchedule);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequest $request)
    {
        return new LessonResource($this->lessonService->store($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        return new LessonResource($lesson);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreLessonRequest $request, Lesson $lesson)
    {
        $this->lessonService->update($lesson, $request->validated());

        return new LessonResource($lesson);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        return response()->json(['error' => __('error.lesson_cannot_be_deleted')], 400);
    }
}
