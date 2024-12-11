<?php

namespace App\Http\Resources\GroupResources;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class GroupResource extends BaseResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'group';

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
            ]
        );
    }
}
