<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonStoreRequest;
use App\Http\Resources\LessonResource;
use App\Models\Cabinet;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LessonResource::collection(Lesson::with('cabinet', 'semester')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LessonStoreRequest $request)
    {
        $validated = $request->validated();

        $cabinet = Cabinet::find($validated['cabinet_id']);
        $semester = Semester::find($validated['semester_id']);

        $lesson = new Lesson();
        $lesson->fill($validated);

        $lesson->subject_user_id = $validated['subject_user_id'];

        $lesson->cabinet()->associate($cabinet);
        $lesson->semester()->associate($semester);

        $lesson->save();

        return new LessonResource($lesson);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        return new LessonResource($lesson);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LessonStoreRequest $request, Lesson $lesson)
    {
        $lesson->update($request->validated());

        return new LessonResource($lesson);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return response()->json(['message' => 'Lesson deleted successfully']);
    }
}
