<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Grade\GradeRequest;
use App\Http\Requests\Grade\GradeStoreRequest;
use App\Http\Resources\Grade\GradeResource;
use App\Models\Date;
use App\Models\Grade;
use App\Models\User;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GradeRequest $request)
    {
        $validated = $request->validated();

        $user = $validated['user'] ?? null;
        $date = $validated['date'] ?? null;

        $grade = Grade::whereHas('user', function ($query) use ($user) {
                $query->where('id', $user);
            })
            ->whereHas('date', function ($query) use ($date) {
                if (isset($date)) {
                    $query->where('date', $date);
                }
            })
            ->get();

        return GradeResource::collection($grade);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GradeStoreRequest $request)
    {
        $validated = $request->validated();

        $user = User::find($validated['user_id']);
        $date = Date::find($validated['date']);

        $grade = new Grade();
        $grade->fill($validated);
        $grade->user()->associate($user);
        $grade->date()->associate($date);
        $grade->save();

        return new GradeResource($grade);
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        return new GradeResource($grade);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GradeStoreRequest $request, Grade $grade)
    {
        $grade->update($request->validated());

        return new GradeResource($grade);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();

        return response()->json('Grade deleted successfully');
    }
}
