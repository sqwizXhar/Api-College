<?php

namespace App\Services;

use App\Models\Date;
use App\Models\Grade;
use Carbon\Carbon;

class DateService extends BaseService
{
    public function __construct(Grade $grade)
    {
        parent::__construct($grade);
    }

    public function getDates(array $validated)
    {
        $date = $validated['dates'];
        $semester = $validated['semester'] ?? null;

        $date = Date::whereIn('date', $date);

        if ($semester) {
            $date->whereHas('lesson', function ($query) use ($semester) {
                if ($semester) {
                    $query->where('semester_id', $semester);
                }
            });
        }

        return $date->get();
    }

    public function getDatesSubject(array $validated)
    {
        $subject = $validated['subject'];

        $today = Carbon::today();

        $startDayOfMonth = $today->copy()->startOfMonth();

        return Date::join('lessons', 'lessons.id', '=', 'dates.lesson_id')
            ->join('subject_user', 'subject_user.id', '=', 'lessons.subject_user_id')
            ->join('subjects', 'subjects.id', '=', 'subject_user.subject_id')
            ->where('subjects.name', '=', $subject)
            ->whereBetween('date', [$startDayOfMonth, $today])
            ->select('dates.id', 'dates.date')
            ->get();
    }
}
