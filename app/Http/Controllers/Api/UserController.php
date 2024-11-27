<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::with('group', 'role')->get());
    }

    public function getStudents()
    {
        $students = User::whereHas('role', function ($query) {
            $query->where('name', 'student');
        })->get();

        return UserResource::collection($students);
    }

    public function getTeachers()
    {
        $teachers = User::whereHas('role', function ($query) {
            $query->where('name', 'teacher');
        })->get();

        return UserResource::collection($teachers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $validated = $request->validated();

        $user = new User();

        $user->fill($validated);

        $user->role()->associate($validated['role_id']);

        if ($validated['role_id'] != Role::getTeacherRole()->id) {
            $user->group()->associate($validated['group_id']);
        }

        $user->save();

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return UserResource::collection($user);
    }

    /**чсвс
     * Update the specified resource in storage.
     */
    public function update(UserStoreRequest $request, User $user)
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
