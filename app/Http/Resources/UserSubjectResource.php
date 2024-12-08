<?php

namespace App\Http\Resources;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSubjectResource extends BaseResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'userSubject';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request),
            [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'middle_name' => $this->middle_name,
                'role' => $this->role->name,
                'subjects' => SubjectResource::collection($this->subjects),
            ]
        );
    }
}
