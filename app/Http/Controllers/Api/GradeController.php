<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Grade\GradeRequest;
use App\Http\Requests\Grade\StoreGradeRequest;
use App\Http\Resources\Grade\GradeResource;
use App\Http\Resources\Grade\GradeCollection;
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

        $user = $validated['user'];
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

        return new GradeCollection($grade);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradeRequest $request)
    {
        $validated = $request->validated();

        $user = User::find($validated['user_id']);
        $date = Date::find($validated['date_id']);

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
    public function update(StoreGradeRequest $request, Grade $grade)
    {
        $validated = $request->validated();

        $grade->user()->associate($validated['user_id']);
        $grade->date()->associate($validated['date_id']);

        $grade->update($validated);

        return new GradeResource($grade);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();

        return response()->json();
    }
}
