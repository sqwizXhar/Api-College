<?php

namespace App\Http\Resources\Grade;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class GradeResource extends BaseResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'grade';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request),
            [
                'student' => $this->user ? $this->user->full_name : null,
                'grade' => $this->grade,
                'date' => $this->date ? $this->date->date : null,
                'teacher' => $this->date->lesson->teacher ? $this->date->lesson->teacher->full_name : null,
            ]
        );
    }
}
