<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lesson\LessonRequest;
use App\Http\Requests\Lesson\LessonStoreRequest;
use App\Http\Resources\Lesson\LessonResource;
use App\Models\Cabinet;
use App\Models\Lesson;
use App\Models\Semester;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LessonRequest $request)
    {
        $validated = $request->validated();

        $date = $validated['date'] ?? null;
        $day_of_week = $validated['day_of_week'];
        $semester = $validated['semester'] ?? null;

        if ($day_of_week == 'true') {
            $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
            $weeklySchedule = [];

            foreach ($daysOfWeek as $day) {
                $schedule = Lesson::where('day_of_week', $day)
                    ->where('semester_id', $semester)
                    ->get();
                $weeklySchedule[$day] = LessonResource::collection($schedule);
            }

            return response()->json($weeklySchedule);
        }
        else if($day_of_week) {
            $schedule = Lesson::whereHas('dates', function ($query) use ($date) {
                    $query->where('date', $date);
                })
                ->where('semester_id', $semester)
                ->get();

            return LEssonResource::collection($schedule);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LessonStoreRequest $request)
    {
        $validated = $request->validated();

        $cabinet = Cabinet::find($validated['cabinet_id']);
        $semester = Semester::find($validated['semester_id']);

        $lesson = new Lesson();
        $lesson->fill($validated);
        $lesson->subject_user_id = $validated['subject_user_id'];
        $lesson->cabinet()->associate($cabinet);
        $lesson->semester()->associate($semester);
        $lesson->save();

        return new LessonResource($lesson);
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
    public function update(LessonStoreRequest $request, Lesson $lesson)
    {
        $lesson->update($request->validated());

        return new LessonResource($lesson);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return response()->json(['message' => 'Lesson deleted successfully']);
    }
}
