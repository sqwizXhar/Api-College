<?php

namespace App\Http\Resources;

use App\Models\Cabinet;
use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'lessons';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'day_of_week' => $this->day_of_week,
            'time' => Carbon::parse($this->time)->format('H:i'),
            'number_of_lesson' => $this->number_of_lesson,
            'cabinet' => $this->cabinet ? $this->cabinet->number : null,
            'group' => $this->group ? $this->group->name : null,
            'subject' => $this->subject ? $this->subject->title : null,
            'teacher' => $this->teacher ? $this->teacher->first_name . ' ' .$this->teacher->last_name . ' ' . $this->teacher->middle_name : null,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
