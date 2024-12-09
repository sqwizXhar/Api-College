<?php

namespace App\Http\Controllers\Api;

use App\Events\GroupAssigned;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequests\GroupStoreRequest;
use App\Http\Requests\GroupRequests\GroupUserStoreRequest;
use App\Http\Resources\GroupResources\GroupResource;
use App\Http\Resources\GroupResources\GroupUserResource;
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
        return GroupResource::collection(Group::with('users')->get());
    }

    public function getGroupUsers(GroupUserStoreRequest $request)
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

        return GroupUserResource::collection($groups);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupStoreRequest $request)
    {
        $group = Group::create($request->validated());

        return new GroupResource($group);
    }

    public function storeGroupUser(Group $group, User $user)
    {
        if ($user && $user->role && $user->role->id != Role::getAdminRole()->id) {

            $group->users()->attach($user->id);

            $group->save();

            return new GroupUserResource($group);
        }

        return response()->json(['message' => 'Invalid role'], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        return new GroupResource($group);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupStoreRequest $request, Group $group)
    {
        return new GroupResource($group->update($request->validated()));
    }

    public function updateGroupUser(Group $group, User $user)
    {
        return new GroupUserResource($group->users()->sync([$user->id]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return response()->json(['message' => 'Group deleted successfully']);
    }

    public function destroyGroupUser(Group $group)
    {
        $group->users()->detach();

        return response()->json(['message' => 'Group user deleted successfully']);
    }
}
