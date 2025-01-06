<?php

namespace App\Services;

use App\Http\Resources\Lesson\LessonResource;
use App\Models\Cabinet;
use App\Models\Lesson;
use App\Models\Semester;
use Illuminate\Database\Eloquent\Model;

class LessonService extends BaseService
{
    public function __construct(Lesson $lesson)
    {
        parent::__construct($lesson);
    }

    public function getWeeklySchedule(array $validated)
    {
        $date = $validated['date'] ?? null;
        $semester = $validated['semester'] ?? null;

        $daysOfWeek = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница'];
        $weeklySchedule = [];

        foreach ($daysOfWeek as $day) {
            $scheduleQuery = Lesson::where('day_of_week', $day);

            if ($date) {
                $scheduleQuery->whereHas('dates', function ($query) use ($date) {
                    $query->where('date', $date);
                });
            }

            if ($semester) {
                $scheduleQuery->whereHas('semester', function ($query) use ($semester) {
                    $query->where('semester_id', $semester);
                });
            }

            $schedule = $scheduleQuery->get();

            $weeklySchedule[$day] = LessonResource::collection($schedule);
        }

        return $weeklySchedule;
    }

    public function create(array $validated)
    {
        $lesson = new Lesson();
        $lesson->fill($validated);
        $lesson->subject_user_id = $validated['subject_user_id'];
        $lesson->cabinet()->associate(Cabinet::find($validated['cabinet_id']));
        $lesson->semester()->associate(Semester::find($validated['semester_id']));
        $lesson->save();

        return $lesson;
    }

    public function update(Model $lesson, array $validated)
    {
        $lesson->cabinet()->associate($validated['cabinet_id']);
        $lesson->semester()->associate($validated['semester_id']);
        $lesson->subject_user_id = $validated['subject_user_id'];

        parent::update($lesson, $validated);
    }
}
