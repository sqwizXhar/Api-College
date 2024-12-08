<?php

namespace App\Http\Resources;

use App\Models\Grade;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

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
                'groups' => $this->when(!$this->role->isAdmin(), $this->groups->select('id', 'name')),
                'grade' => $this->when(!$this->role->isAdmin() && !$this->role->isTeacher(), $this->grades->select('grade')),
            ]
        );
    }
}
