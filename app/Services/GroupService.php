<?php

namespace App\Services;

use App\Models\Group;
use App\Models\Role;
use App\Models\User;

class GroupService extends BaseService
{
    public function __construct(Group $group)
    {
        parent::__construct($group);
    }

    public function getGroupUsers(string $role)
    {
        return Group::whereHas('users.role', function ($query) use ($role) {
            $query->where('name', $role);
        })->with(['users' => function ($query) use ($role) {
            $query->whereHas('role', function ($UserRole) use ($role) {
                $UserRole->where('name', $role);
            });
        }])->get();
    }

    public function storeGroupUser(Group $group, User $user)
    {
        if ($user?->role?->id != Role::adminRole()->id) {
            $group->users()->attach($user->id);
            $group->save();

            return $group;
        }

        return false;
    }

    public function destroyGroupUser(Group $group, $userId)
    {
        $group->users()->detach($userId);
    }
}
