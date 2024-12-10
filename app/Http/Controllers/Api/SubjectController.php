<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectStoreRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Illuminate\Http\Response;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SubjectResource::collection(Subject::with('users')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectStoreRequest $request)
    {
        $subject = Subject::create($request->validated());

        return new SubjectResource($subject);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return new SubjectResource($subject->load('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectStoreRequest $request, Subject $subject)
    {
        return new SubjectResource($subject->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return response()->json(['message' => 'Subject deleted successfully.']);
    }
}
