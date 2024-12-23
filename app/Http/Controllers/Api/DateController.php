<?php

namespace App\Http\Controllers\Api;

use App\Http\Collections\DateCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Date\DateRequest;
use App\Models\Date;

class DateController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __invoke(DateRequest $request)
    {
        $validated = $request->validated();

        $date = $validated['dates'];
        $semester = $validated['semester'] ?? null;

        $dateQuery = Date::whereHas('lesson', function ($query) use ($semester) {
            if($semester) {
                $query->where('semester_id', $semester);
            }
        })->whereIn('date', $date)
            ->get();

        return new DateCollection($dateQuery);
    }
}
