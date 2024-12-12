<?php

namespace App\Http\Resources\Date;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class DateResource extends BaseResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'date';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request),
            [
                'date' => $this->date,
                'semester' => $this->lesson->semester,
                'number_of_lesson' => $this->lesson->number_of_lesson,
                'time' => $this->lesson->time,
                'cabinet' => $this->lesson->cabinet->number,
                'teacher' => $this->lesson->teacher->full_name,
                'subject' => $this->lesson->subject->name,
            ]
        );
    }
}
