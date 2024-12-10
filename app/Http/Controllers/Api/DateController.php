<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DateRequest;
use App\Http\Requests\DateStoreRequest;
use App\Http\Resources\DateResource;
use App\Models\Date;
use Illuminate\Http\Request;

class DateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DateRequest $request)
    {
        $validated = $request->validated();

        $day = $validated['day'];
        $group = $validated['group'];
        $date = $validated['dates'];
        $semester = $validated['semester'] ?? null;

        $dateQuery = Date::whereHas('lesson', function ($query) use ($day, $group, $semester) {
            $query->where('day_of_week', $day)
                ->whereHas('group', function ($query) use ($group) {
                    $query->where('name', $group);
                })
                ->where('semester', $semester);
        })->whereIn('date', $date);


        $dates = $dateQuery->with('lesson.group')->get();

        return DateResource::collection($dates);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DateStoreRequest $request)
    {
        $validated = $request->validated();

        $lesson = $validated['lesson_id'];

        $date = new Date();
        $date->fill($validated);

        $date->lesson()->associate($lesson);

        $date->save();

        return new DateResource($date);
    }

    /**
     * Display the specified resource.
     */
    public function show(Date $date)
    {
        return new DateResource($date);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DateStoreRequest $request, Date $date)
    {
        return new DateResource($date->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Date $date)
    {
        $date->delete();

        return response()->json(['message' => 'Date deleted successfully']);
    }
}
