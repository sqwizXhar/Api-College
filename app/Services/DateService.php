<?php

namespace App\Services;

use App\Models\Date;

class DateService
{
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
}
