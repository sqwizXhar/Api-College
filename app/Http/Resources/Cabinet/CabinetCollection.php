<?php

namespace App\Http\Resources\Cabinet;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CabinetCollection extends ResourceCollection
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'cabinets';

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
