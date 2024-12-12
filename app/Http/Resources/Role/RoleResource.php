<?php

namespace App\Http\Resources\Role;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class RoleResource extends BaseResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'role';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request),
            [
                'id' => $this->id,
                'name' => $this->name,
                'users' => $this->users->select('first_name', 'last_name', 'middle_name'),
                'created_at' => $this->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            ]
        );
    }
}
