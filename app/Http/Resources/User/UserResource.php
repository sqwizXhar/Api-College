<?php

namespace App\Http\Resources\User;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class UserResource extends BaseResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'user';

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
                'login' => $this->login,
                'role' => $this->role ? $this->role->name : '',
                $this->mergeWhen(!$this->role->isAdmin() && $this->groups->isNotEmpty(), [
                    'groups' => $this->groups->pluck('name')->toArray(),
                ])
            ]
        );
    }
}
