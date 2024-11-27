<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonStoreRequest;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LessonResource::collection(Lesson::with('cabinet', 'subject', 'group', 'user')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LessonStoreRequest $request)
    {
        $lesson = Lesson::create([$request->validated()]);

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

        return response(null, 204);
    }
}
