<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradeStoreRequest;
use App\Http\Requests\GroupStoreRequest;
use App\Http\Resources\GradeResource;
use App\Models\Date;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return GradeResource::collection(Grade::with('user', 'date')->get());
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
        return new GradeResource($grade->load(['user', 'date']));
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
