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
                'number_of_lesson' => $this->lesson ? $this->lesson->number_of_lesson : null,
                'time' => $this->lesson ? $this->lesson->time : null,
                'subject' => $this->lesson->subject ? $this->lesson->subject->name : null,
                'cabinet' => $this->lesson->cabinet ? $this->lesson->cabinet->number : null,
                'teacher' => $this->lesson->teacher ? $this->lesson->teacher->full_name : null,
            ]
        );
    }
}
