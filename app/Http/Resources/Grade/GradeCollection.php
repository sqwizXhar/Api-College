<?php

namespace App\Http\Resources\Grade;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GradeCollection extends ResourceCollection
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'grades';

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
