<?php

namespace App\Http\Resources\Cabinet;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class CabinetResource extends BaseResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'cabinet';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request),
            [
                'purpose' => $this->purpose,
                'number' => $this->number,
            ]
        );
    }
}
