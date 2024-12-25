<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Date\DateRequest;
use App\Http\Requests\Date\GetDatesRequest;
use App\Http\Requests\Subject\StoreSubjectRequest;
use App\Http\Resources\Date\DateCollection;
use App\Models\Date;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
