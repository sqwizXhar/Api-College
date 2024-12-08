<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SemesterRequest;
use App\Http\Requests\SemesterStoreRequest;
use App\Http\Resources\SemesterResource;
use App\Models\Group;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SemesterResource::collection(Semester::with('lessons', 'group')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SemesterStoreRequest $request)
    {
        $validated = $request->validated();

        $group = Group::find($validated['group_id']);

        $semester = new Semester();
        $semester->fill($validated);

        $semester->group()->associate($group);

        $semester->save();

        return new SemesterResource($semester);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SemesterStoreRequest $request, Semester $semester)
    {
        $semester->update($request->validated());

        return new SemesterResource($semester);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semester $semester)
    {
        $semester->delete();

        return response()->json(['message' => 'Semester deleted successfully']);
    }
}
