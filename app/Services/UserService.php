<?php

namespace App\Services;

use App\Models\Group;
use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function getStudents()
    {
        return User::whereHas('role', function ($query) {
            $query->where('name', 'student');
        })->get();
    }

    public function getTeachers()
    {
        return User::whereHas('role', function ($query) {
            $query->where('name', 'teacher');
        })->get();
    }

    public function getAdmins()
    {
        return User::whereHas('role', function ($query) {
            $query->where('name', 'admin');
        })->get();
    }

    public function getUserSubjects()
    {
        return User::has('subjects')->get();
    }

    public function createUser(array $validated)
    {
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
            return ['error' => __('error.role_cannot_have_groups')];
        }

        $user->createToken('authToken')->plainTextToken;

        return $user;
    }

    public function storeUserSubject(User $user, Subject $subject)
    {
        if ($user->role?->name === 'teacher') {
            $user->subjects()->attach($subject->id);
            $user->save();

            return $user;
        }

        return null;
    }

    public function destroyUserSubject(User $user, Subject $subject)
    {
        $user->subjects()->detach($subject->id);
    }
}