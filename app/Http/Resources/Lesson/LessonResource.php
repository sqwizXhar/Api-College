<?php

namespace App\Http\Resources\Lesson;

use App\Http\Resources\BaseResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LessonResource extends BaseResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'lesson';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request),
            [
                'time' => Carbon::parse($this->time)->format('H:i'),
                'number_of_lesson' => $this->number_of_lesson,
                'cabinet' => $this->cabinet ? $this->cabinet->number : null,
                'group' => $this->semester->group ? $this->semester->group->name : null,
                'subject' => $this->subject ? $this->subject->name : null,
                'teacher' => $this->teacher ? $this->teacher->full_name : null,
            ]
        );
    }
}
