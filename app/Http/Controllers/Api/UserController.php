<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserSubjectCollection;
use App\Http\Resources\User\UserSubjectResource;
use App\Models\Subject;
use App\Models\User;
use App\Services\UserService;

/**
 *
 * @OA\Post(
 *     path="/api/admin/users",
 *     summary="Create",
 *     tags={"User"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *        required=true,
 *        @OA\JsonContent(
 *            required={"first_name", "last_name", "middle_name", "login", "password", "role_id"},
 *            @OA\Property(property="first_name", type="string", example="User"),
 *            @OA\Property(property="last_name", type="string", example="Userov"),
 *            @OA\Property(property="middle_name", type="string", example="Userovich"),
 *            @OA\Property(property="login", type="string", example="user23"),
 *            @OA\Property(property="password", type="string", example="12345678"),
 *            @OA\Property(property="role_id", type="integer", example=2),
 *            @OA\Property(property="group_id", type="integer", example=1, nullable=true)
 *        )
 *     ),
 *
 *     @OA\Response(
 *        response=200,
 *        description="Ok",
 *        @OA\JsonContent(
 *               @OA\Property(
 *                   property="user",
 *                   type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="first_name", type="string", example="User"),
 *                   @OA\Property(property="last_name", type="string", example="Userov"),
 *                   @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                   @OA\Property(property="login", type="string", example="user23"),
 *                   @OA\Property(property="role", type="string", example="student"),
 *               )
 *          )
 *     )
 * ),
 *
 * @OA\Post(
 *         path="/api/admin/user/{user}/subject/{subject}",
 *         summary="Create",
 *         tags={"User Subject"},
 *         security={{ "bearerAuth": {} }},
 *
 *        @OA\Parameter(
 *            description="User ID",
 *            in="path",
 *            name="user",
 *            required=true,
 *            example=1
 *        ),
 *
 *        @OA\Parameter(
 *             description="Subject ID",
 *             in="path",
 *             name="subject",
 *             required=true,
 *             example=1
 *         ),
 *
 *         @OA\Response(
 *            response=200,
 *            description="Ok",
 *            @OA\JsonContent(
 *                   @OA\Property(
 *                       property="user",
 *                       type="object",
 *                       @OA\Property(property="id", type="integer", example=1),
 *                       @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                       @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                       @OA\Property(property="first_name", type="string", example="User"),
 *                       @OA\Property(property="last_name", type="string", example="Userov"),
 *                       @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                       @OA\Property(
 *                           property="subjects",
 *                           type="array",
 *                           @OA\Items(
 *                               @OA\Property(property="id", type="integer", example=1),
 *                               @OA\Property(property="name", type="string", example="Russian"),
 *                           ),
 *                       )
 *                   )
 *              )
 *         )
 *     ),
 *
 * @OA\Get(
 *      path="/api/admin/users",
 *      summary="UsersInfo",
 *      tags={"User"},
 *      security={{ "bearerAuth": {} }},
 *
 *      @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *            @OA\Property(
 *                property="users",
 *                type="array",
 *                @OA\Items(
 *                @OA\Property(property="id", type="integer", example=1),
 *                @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="first_name", type="string", example="User"),
 *                @OA\Property(property="last_name", type="string", example="Userov"),
 *                @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                @OA\Property(property="login", type="string", example="user23"),
 *                @OA\Property(property="role", type="string", example="student"),
 *              )
 *           )
 *        )
 *     )
 * ),
 *
 * @OA\Get(
 *       path="/api/teachers",
 *       summary="TeachersInfo",
 *       tags={"User"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *             @OA\Property(
 *                 property="users",
 *                 type="array",
 *                 @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="first_name", type="string", example="User"),
 *                 @OA\Property(property="last_name", type="string", example="Userov"),
 *                 @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                 @OA\Property(property="login", type="string", example="user23"),
 *               )
 *            )
 *         )
 *      )
 *  ),
 *
 * @OA\Get(
 *        path="/api/admin/students",
 *        summary="StudentsInfo",
 *        tags={"User"},
 *        security={{ "bearerAuth": {} }},
 *
 *        @OA\Response(
 *           response=200,
 *           description="Ok",
 *           @OA\JsonContent(
 *              @OA\Property(
 *                  property="users",
 *                  type="array",
 *                  @OA\Items(
 *                  @OA\Property(property="id", type="integer", example=1),
 *                  @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                  @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                  @OA\Property(property="first_name", type="string", example="User"),
 *                  @OA\Property(property="last_name", type="string", example="Userov"),
 *                  @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                  @OA\Property(property="login", type="string", example="user23"),
 *                )
 *             )
 *          )
 *       )
 *   ),
 *
 * @OA\Get(
 *        path="/api/admin/admins",
 *        summary="AdminsInfo",
 *        tags={"User"},
 *        security={{ "bearerAuth": {} }},
 *
 *        @OA\Response(
 *           response=200,
 *           description="Ok",
 *           @OA\JsonContent(
 *              @OA\Property(
 *                  property="users",
 *                  type="array",
 *                  @OA\Items(
 *                  @OA\Property(property="id", type="integer", example=1),
 *                  @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                  @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                  @OA\Property(property="first_name", type="string", example="User"),
 *                  @OA\Property(property="last_name", type="string", example="Userov"),
 *                  @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                  @OA\Property(property="login", type="string", example="user23")
 *                )
 *             )
 *          )
 *       )
 *   ),
 *
 * @OA\Get(
 *        path="/api/admin/users/{user}",
 *        summary="GetUserID",
 *        tags={"User"},
 *        security={{ "bearerAuth": {} }},
 *
 *        @OA\Parameter(
 *            description="User ID",
 *            in="path",
 *            name="user",
 *            required=true,
 *            example=1
 *        ),
 *
 *        @OA\Response(
 *           response=200,
 *           description="Ok",
 *           @OA\JsonContent(
 *              @OA\Property(
 *                  property="user",
 *                  type="object",
 *                  @OA\Property(property="id", type="integer", example=1),
 *                  @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                  @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                  @OA\Property(property="first_name", type="string", example="User"),
 *                  @OA\Property(property="last_name", type="string", example="Userov"),
 *                  @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                  @OA\Property(property="login", type="string", example="user23"),
 *                  @OA\Property(property="role", type="string", example="student"),
 *              )
 *          )
 *      )
 *  ),
 *
 * @OA\Get(
 *         path="/api/admin/user/subjects",
 *         summary="UserSubjectsInfo",
 *         tags={"User Subject"},
 *         security={{ "bearerAuth": {} }},
 *
 *         @OA\Response(
 *            response=200,
 *            description="Ok",
 *            @OA\JsonContent(
 *                   @OA\Property(
 *                       property="users",
 *                       type="object",
 *                       @OA\Property(property="id", type="integer", example=1),
 *                       @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                       @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                       @OA\Property(property="first_name", type="string", example="User"),
 *                       @OA\Property(property="last_name", type="string", example="Userov"),
 *                       @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                       @OA\Property(
 *                           property="subjects",
 *                           type="array",
 *                           @OA\Items(
 *                               @OA\Property(property="id", type="integer", example=1),
 *                               @OA\Property(property="name", type="string", example="Russian"),
 *                           ),
 *                       )
 *                   )
 *              )
 *         )
 *     ),
 *
 * @OA\Get(
 *         path="/api/admin/user/{user}/subjects",
 *         summary="GetUserSubjectsID",
 *         tags={"User Subject"},
 *         security={{ "bearerAuth": {} }},
 *
 *        @OA\Parameter(
 *            description="User ID",
 *            in="path",
 *            name="user",
 *            required=true,
 *            example=1
 *        ),
 *
 *         @OA\Response(
 *            response=200,
 *            description="Ok",
 *            @OA\JsonContent(
 *                   @OA\Property(
 *                       property="user",
 *                       type="object",
 *                       @OA\Property(property="id", type="integer", example=1),
 *                       @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                       @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                       @OA\Property(property="first_name", type="string", example="User"),
 *                       @OA\Property(property="last_name", type="string", example="Userov"),
 *                       @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                       @OA\Property(
 *                           property="subjects",
 *                           type="array",
 *                           @OA\Items(
 *                               @OA\Property(property="id", type="integer", example=1),
 *                               @OA\Property(property="name", type="string", example="Russian"),
 *                           ),
 *                       )
 *                   )
 *              )
 *         )
 *     ),
 *
 * @OA\Put(
 *       path="/api/admin/users/{user}",
 *       summary="Update",
 *       tags={"User"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="User ID",
 *           in="path",
 *           name="user",
 *           required=true,
 *           example=1
 *       ),
 *
 *       @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"first_name", "last_name", "middle_name", "login", "password", "role_id"},
 *             @OA\Property(property="first_name", type="string", example="User"),
 *             @OA\Property(property="last_name", type="string", example="Userov"),
 *             @OA\Property(property="middle_name", type="string", example="Userovich"),
 *             @OA\Property(property="login", type="string", example="user23"),
 *             @OA\Property(property="password", type="string", example="12345678"),
 *             @OA\Property(property="role", type="string", example="student"),
 *             @OA\Property(property="group_id", type="integer", example=1, nullable=true)
 *         )
 *      ),
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *             @OA\Property(
 *                 property="user",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="first_name", type="string", example="User"),
 *                 @OA\Property(property="last_name", type="string", example="Userov"),
 *                 @OA\Property(property="middle_name", type="string", example="Userovich"),
 *                 @OA\Property(property="login", type="string", example="user23"),
 *                 @OA\Property(property="role", type="string", example="student"),
 *             )
 *         )
 *     )
 * ),
 *
 * @OA\Delete(
 *       path="/api/admin/users/{user}",
 *       summary="Delete",
 *       tags={"User"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="User ID",
 *           in="path",
 *           name="user",
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
 *        path="/api/admin/user/{user}/subject/{subject}",
 *        summary="Delete",
 *        tags={"User Subject"},
 *        security={{ "bearerAuth": {} }},
 *
 *        @OA\Parameter(
 *            description="User ID",
 *            in="path",
 *            name="user",
 *            required=true,
 *            example=1
 *         ),
 *
 *       @OA\Parameter(
 *             description="Subject ID",
 *             in="path",
 *             name="subject",
 *             required=true,
 *             example=1
 *          ),
 *
 *        @OA\Response(
 *           response=200,
 *           description="Ok",
 *        )
 *  ),
 */
class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new UserCollection(User::all());
    }

    public function getStudents()
    {
        return new UserCollection($this->userService->getStudents());
    }

    public function getTeachers()
    {
        return new UserCollection($this->userService->getTeachers());
    }

    public function getAdmins()
    {
        return new UserCollection($this->userService->getAdmins());
    }

    public function getUserSubjects()
    {
        return new UserSubjectCollection($this->userService->getUserSubjects());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $result = $this->userService->createUser($validated);

        if(isset($result['error'])){
            return response()->json($result, 400);
        }

        return new UserResource($result);
    }

    public function storeUserSubject(User $user, Subject $subject)
    {
        $result = $this->userService->storeUserSubject($user, $subject);

        if(!$result){
            return response()->json(['error' => __('error.invalid_role')]);
        }

        return new UserSubjectResource($result);
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
        $this->userService->update($user, $request->validated());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->userService->delete($user->id);

        return response()->json();
    }

    public function destroyUserSubject(User $user, Subject $subject)
    {
        $this->userService->destroyUserSubject($user, $subject);

        return response()->json();
    }
}
