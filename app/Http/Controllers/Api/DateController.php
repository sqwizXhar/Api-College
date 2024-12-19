<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Date\DateRequest;
use App\Http\Requests\Date\StoreDateRequest;
use App\Http\Resources\Date\DateResource;
use App\Models\Date;

class DateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DateRequest $request)
    {
        $validated = $request->validated();

        $dates = $validated['dates'];
        $semester = $validated['semester'] ?? null;

        $dateQuery = (new Date())($dates, $semester);

        return DateResource::collection($dateQuery);
    }
}
