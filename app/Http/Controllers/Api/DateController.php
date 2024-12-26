<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Date\DateRequest;
use App\Http\Requests\Date\GetDatesRequest;
use App\Http\Resources\Date\DateCollection;
use App\Models\Date;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Get(
 *      path="/api/admin/dates",
 *      summary="DatesInfo",
 *      tags={"Date"},
 *      security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         name="dates[]",
 *         in="query",
 *         description="Array of dates",
 *         required=true,
 *         @OA\Schema(
 *             type="array",
 *             @OA\Items(type="string", format="date")
 *         ),
 *         explode=true,
 *         example={"2020-10-27"}
 *     ),
 *     @OA\Parameter(
 *         name="semester",
 *         in="query",
 *         description="Semester ID",
 *         required=false,
 *         @OA\Schema(type="integer")
 *     ),
 *
 *      @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *            @OA\Property(
 *                property="dates",
 *                type="array",
 *                @OA\Items(
 *                @OA\Property(property="id", type="integer", example=1),
 *                @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="number_of_lesson", type="integer", example=1),
 *                @OA\Property(property="time", type="string", format="time", example="13:00"),
 *                @OA\Property(property="subject", type="string", example="Math"),
 *                @OA\Property(property="cabinet", type="string", example="21"),
 *                @OA\Property(property="teacher", type="string", example="User Userov Userovich"),
 *              )
 *           )
 *        )
 *     )
 * ),
 *
 * @OA\Get(
 *       path="/api/teacher/dates",
 *       summary="DatesSubjectInfo",
 *       tags={"Date"},
 *       security={{ "bearerAuth": {} }},
 *
 *      @OA\Parameter(
 *          name="subject",
 *          in="query",
 *          description="Subject name",
 *          required=true,
 *          @OA\Schema(type="string")
 *      ),
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *                 type="array",
 *                 @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="date", type="date", example="2024-12-25"),
 *            )
 *         )
 *      )
 *  ),
 *
 */
class DateController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(DateRequest $request)
    {
        $validated = $request->validated();

        $date = $validated['dates'];
        $semester = $validated['semester'] ?? null;

        $dateQuery = Date::whereHas('lesson', function ($query) use ($semester) {
            if ($semester) {
                $query->where('semester_id', $semester);
            }
        })->whereIn('date', $date)
            ->get();

        return new DateCollection($dateQuery);
    }

    public function getDates(GetDatesRequest $request)
    {
        $validated = $request->validated();
        $subject = $validated['subject'];

        $today = Carbon::today();

        $startDayOfMonth = $today->copy()->startOfMonth();

        $dates = Db::table('dates')
            ->join('lessons', 'lessons.id', '=', 'dates.lesson_id')
            ->join('subject_user', 'subject_user.id', '=', 'lessons.subject_user_id')
            ->join('subjects', 'subjects.id', '=', 'subject_user.subject_id')
            ->where('subjects.name','=' ,$subject)
            ->whereBetween('dates.date', [$startDayOfMonth, $today])
            ->select('dates.id', 'dates.date')
            ->get();

        return response()->json($dates);
    }
}
