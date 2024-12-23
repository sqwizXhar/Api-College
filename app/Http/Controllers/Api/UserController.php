<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserSubjectCollection;
use App\Http\Resources\User\UserSubjectResource;
use App\Models\Group;
use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new UserCollection(User::all());
    }

    public function getStudents()
    {
        $students = User::whereHas('role', function ($query) {
            $query->where('name', 'student');
        })->get();

        return new UserCollection($students);
    }

    public function getTeachers()
    {
        $teachers = User::whereHas('role', function ($query) {
            $query->where('name', 'teacher');
        })->get();

        return new UserCollection($teachers);
    }

    public function getAdmins()
    {
        $admins = User::whereHas('role', function ($query) {
            $query->where('name', 'admin');
        })->get();

        return new UserCollection($admins);
    }

    public function getUserSubjects()
    {
        $user = User::has('subjects')->get();

        return new UserSubjectCollection($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $role = Role::find($validated['role_id']);

        $user = new User();
        $user->fill($validated);
        $user->role()->associate($role);
        $user->save();

        if ($role->id != Role::adminRole()->id && isset($validated['group_id'])) {
            $group = Group::find($validated['group_id']);
            if ($group) {
                $user->groups()->sync($group->id);
            }
        } elseif ($role->isAdmin() && isset($validated['group_id'])) {
            return response()->json(['error' => __('error.role_cannot_have_groups')], 400);
        }

        $user->createToken('authToken')->plainTextToken;

        return new UserResource($user);
    }

    public function storeUserSubject(User $user, Subject $subject)
    {
        if ($user?->role->name === 'teacher') {
            $user->subjects()->attach($subject->id);
            $user->save();

            return new UserSubjectResource($user);
        }

        return response()->json(['error' => __('error.invalid_role')], 400);
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
    public function update(StoreUserRequest $request, User $user)
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

        return response()->json([]);
    }

    public function destroyUserSubject(User $user, Subject $subject)
    {
        $user->subjects()->detach($subject->id);

        return response()->json([]);
    }
}
