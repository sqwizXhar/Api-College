<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Date\DateRequest;
use App\Http\Requests\Date\GetDatesRequest;
use App\Http\Resources\Date\DateCollection;
use App\Services\DateService;

/**
 *
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
    protected $dateService;

    public function __construct(DateService $dateService)
    {
        $this->dateService = $dateService;
    }

    /**
     * Display a listing of the resource.
     */

    public function index(DateRequest $request)
    {
        return new DateCollection($this->dateService->getDates($request->validated()));
    }

    public function getDatesSubject(GetDatesRequest $request)
    {
        $dates = $this->dateService->getDatesSubject($request->validated());

        return response()->json($dates);
    }
}
