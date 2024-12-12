<?php

namespace App\Http\Resources\Semester;

use App\Http\Resources\BaseResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SemesterResource extends BaseResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'semester';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request),
            [
                'number' => $this->number,
                'start_date' => Carbon::parse($this->start_date)->format('Y-m-d'),
                'end_date' => $this->end_date,
                'group' => $this->group->name,
            ]
        );
    }
}
