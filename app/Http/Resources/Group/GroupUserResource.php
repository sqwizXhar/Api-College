<?php

namespace App\Http\Resources\Group;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class GroupUserResource extends BaseResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'groupUser';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request),
            [
                'name' => $this->name,
                'users' => $this->users ? $this->users->select('id','first_name', 'last_name', 'middle_name') : null,
            ]
        );
    }
}
