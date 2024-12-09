<?php

namespace App\Http\Controllers\Api;

use App\Events\GroupAssigned;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\UserStoreRequest;
use App\Http\Resources\AdminResources\AdminResource;
use App\Http\Resources\UserResources\UserResource;
use App\Http\Resources\UserResources\UserSubjectResource;
use App\Models\Group;
use App\Models\Role;
use App\Models\Subject;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::with('groups', 'role', 'grades')->get());
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

    public function getAdmins()
    {
        $admins = User::whereHas('role', function ($query) {
            $query->where('name', 'admin');
        })->get();

        return AdminResource::collection($admins);
    }

    public function getUserSubjects(User $user)
    {
        $user= User::has('subjects')->get();

        return UserSubjectResource::collection($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $validated = $request->validated();

        $role = Role::find($validated['role_id']);

        $user = new User();
        $user->fill($validated);
        $user->role()->associate($role);

        $user->save();

        if ($role->id != Role::getAdminRole()->id && isset($validated['group_id'])) {
            $group = Group::find($validated['group_id']);
            if ($group) {
                $user->groups()->sync($group->id);
            }
        } elseif ($role->isAdmin() && isset($validated['group_id'])) {
            return response()->json(['message' => 'This role cannot have a group'], 400);
        }

        return new UserResource($user->load('groups'));
    }

    public function storeUserSubject( User $user, Subject $subject)
    {
        if ($user && $user->role && $user->role->id == Role::getTeacherRole()->id) {

            $user->subjects()->sync($subject->id);

            $user->save();

            return new UserSubjectResource($user);
        }

        return response()->json(['message' => 'Invalid role'], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function showUserSubjects(User $user)
    {
        return new UserSubjectResource($user);
    }

    /**чсвс
     * Update the specified resource in storage.
     */
    public function update(UserStoreRequest $request, User $user)
    {
        return new UserResource($user->update($request->validated()));
    }

    public function updateUserSubject(User $user, Subject $subject)
    {
        return new UserSubjectResource($user->subjects()->sync([$subject->id]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    public function destroyUserSubject(User $user)
    {
        $user->subjects()->detach();

        return response()->json(['message' => 'User subjects deleted successfully']);
    }
}
