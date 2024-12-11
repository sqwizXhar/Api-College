<?php

namespace App\Http\Resources\AdminResources;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class AdminResource extends BaseResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'admin';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request),
            [
                'login' => $this->login,
            ],
        );
    }
}
