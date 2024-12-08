<?php

namespace App\Http\Resources;

use App\Models\Cabinet;
use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends BaseResource
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
        return array_merge(parent::toArray($request),
            [
                'date' => $this->dates->pluck('date')->first(),
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
