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
use App\Models\User;
use App\Services\GroupService;

/**
 *
 * @OA\Post(
 *     path="/api/admin/groups",
 *     summary="Create",
 *     tags={"Group"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *        required=true,
 *        @OA\JsonContent(
 *            required={"name"},
 *            @OA\Property(property="name", type="string", example="OAIp2")
 *        )
 *     ),
 *
 *     @OA\Response(
 *        response=201,
 *        description="Created",
 *        @OA\JsonContent(
 *               @OA\Property(
 *                   property="group",
 *                   type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="name", type="string", example="OAIp2")
 *               )
 *          )
 *     )
 * ),
 *
 * @OA\Post(
 *      path="/api/admin/group/{group}/user/{user}",
 *      summary="Create",
 *      tags={"Group User"},
 *      security={{ "bearerAuth": {} }},
 *
 *     @OA\Parameter(
 *         description="Group ID",
 *         in="path",
 *         name="group",
 *         required=true,
 *         example=1
 *     ),
 *
 *     @OA\Parameter(
 *          description="User ID",
 *          in="path",
 *          name="user",
 *          required=true,
 *          example=1
 *      ),
 *
 *      @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(
 *                @OA\Property(
 *                    property="group",
 *                    type="object",
 *                    @OA\Property(property="id", type="integer", example=1),
 *                    @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                    @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                    @OA\Property(property="name", type="string", example="OAIp2"),
 *                    @OA\Property(
 *                        property="users",
 *                        type="array",
 *                        @OA\Items(
 *                            @OA\Property(property="id", type="integer", example=1),
 *                            @OA\Property(property="first_name", type="string", example="User"),
 *                            @OA\Property(property="last_name", type="string", example="Userov"),
 *                            @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                        ),
 *                    )
 *                )
 *           )
 *      )
 *  ),
 *
 * @OA\Get(
 *      path="/api/admin/groups",
 *      summary="GroupsInfo",
 *      tags={"Group"},
 *      security={{ "bearerAuth": {} }},
 *
 *      @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *            @OA\Property(
 *                property="groups",
 *                type="array",
 *                @OA\Items(
 *                @OA\Property(property="id", type="integer", example=1),
 *                @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="name", type="string", example="OAIp2")
 *              )
 *           )
 *        )
 *     )
 * ),
 *
 * @OA\Get(
 *         path="/api/admin/groups/{group}",
 *         summary="GetGroupID",
 *         tags={"Group"},
 *         security={{ "bearerAuth": {} }},
 *
 *         @OA\Parameter(
 *             description="Group ID",
 *             in="path",
 *             name="group",
 *             required=true,
 *             example=1
 *         ),
 *
 *         @OA\Response(
 *            response=200,
 *            description="Ok",
 *            @OA\JsonContent(
 *               @OA\Property(
 *                   property="group",
 *                   type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="name", type="string", example="OAIp2")
 *               )
 *           )
 *       )
 *   ),
 *
 * @OA\Get(
 *       path="/api/admin/group/users",
 *       summary="GroupsUserInfo",
 *       tags={"Group User"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="Role name",
 *           in="query",
 *           name="role",
 *           required=true,
 *           @OA\Schema(type="string", enum={"student", "teacher"})
 *       ),
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *             @OA\Property(
 *                 property="groups",
 *                 type="array",
 *                 @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="name", type="string", example="OAIp2"),
 *                 @OA\Property(
 *                     property="users",
 *                     type="array",
 *                     @OA\Items(
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="first_name", type="string", example="User"),
 *                         @OA\Property(property="last_name", type="string", example="Userov"),
 *                         @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                     ),
 *                  )
 *               )
 *            )
 *         )
 *      )
 *  ),
 *
 * @OA\Put(
 *       path="/api/admin/groups/{group}",
 *       summary="Update",
 *       tags={"Group"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="Group ID",
 *           in="path",
 *           name="group",
 *           required=true,
 *           example=1
 *       ),
 *
 *       @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name"},
 *             @OA\Property(property="name", type="string", example="OAIp2")
 *         )
 *      ),
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *             @OA\Property(
 *                 property="group",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="name", type="string", example="OAIp2")
 *             )
 *         )
 *     )
 * ),
 *
 * @OA\Delete(
 *       path="/api/admin/groups/{group}",
 *       summary="Delete",
 *       tags={"Group"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="Group ID",
 *           in="path",
 *           name="group",
 *           required=true,
 *           example=1
 *        ),
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *       )
 * ),
 *
 * @OA\Delete(
 *        path="/api/admin/group/{group}/user/{user}",
 *        summary="Delete",
 *        tags={"Group User"},
 *        security={{ "bearerAuth": {} }},
 *
 *        @OA\Parameter(
 *             description="Group ID",
 *             in="path",
 *             name="group",
 *             required=true,
 *             example=1
 *          ),
 *
 *         @OA\Parameter(
 *              description="User ID",
 *              in="path",
 *              name="user",
 *              required=true,
 *              example=1
 *           ),
 *
 *        @OA\Response(
 *           response=200,
 *           description="Ok",
 *        )
 *  ),
 */
class GroupController extends Controller
{
    protected $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

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

        $groups = $this->groupService->getGroupUsers($validated['role']);

        return new GroupUserCollection($groups);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request)
    {
        return new GroupResource($this->groupService->create($request->validated()));
    }

    public function storeGroupUser(Group $group, User $user)
    {
        $group = $this->groupService->storeGroupUser($group, $user);

        if (!$group) {
            return response()->json(['error' => __('error.invalid_role')], 400);
        }

        return new GroupUserResource($group);
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
        $this->groupService->update($group, $request->validated());

        return new GroupResource($group);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $this->groupService->delete($group->id);

        return response()->json();
    }

    public function destroyGroupUser(Group $group, User $user)
    {
        $this->groupService->destroyGroupUser($group, $user->id);

        return response()->json();
    }
}
