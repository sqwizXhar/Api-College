<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Group\StoreGroupRequest;
use App\Http\Requests\Group\StoreGroupUserRequest;
use App\Http\Resources\Group\GroupCollection;
use App\Http\Resources\Group\GroupResource;
use App\Http\Resources\Group\GroupUserCollection;
use App\Http\Resources\Group\GroupUserResource;
use App\Models\Group;
use App\Models\Role;
use App\Models\User;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new GroupCollection(Group::all());
    }

    public function getGroupUsers(StoreGroupUserRequest $request)
    {
        $validated = $request->validated();
        $role = $validated['role'];

        $groups = Group::whereHas('users.role', function ($query) use ($role) {
            $query->where('name', $role);
        })->with(['users' => function ($query) use ($role) {
            $query->whereHas('role', function ($UserRole) use ($role) {
                $UserRole->where('name', $role);
            });
        }])->get();

        return new GroupUserCollection($groups);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request)
    {
        $group = Group::create($request->validated());

        return new GroupResource($group);
    }

    public function storeGroupUser(Group $group, User $user)
    {
        if ($user && $user->role && $user->role->id != Role::adminRole()->id) {
            $group->users()->attach($user->id);
            $group->save();

            return new GroupUserResource($group);
        }

        return response()->json(['error' => __('error.invalid_role')], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        return new GroupResource($group);
    }

    public function showGroupUsers(Group $group)
    {
        return new GroupUserResource($group);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGroupRequest $request, Group $group)
    {
        $group->update($request->validated());

        return new GroupResource($group);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return response()->json([]);
    }

    public function destroyGroupUser(Group $group, User $user)
    {
        $group->users()->detach($user->id);

        return response()->json([]);
    }
}
