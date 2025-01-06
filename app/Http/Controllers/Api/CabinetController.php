<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\StoreCabinetRequest;
use App\Http\Resources\Cabinet\CabinetCollection;
use App\Http\Resources\Cabinet\CabinetResource;
use App\Models\Cabinet;
use App\Services\CabinetService;

/**
 *
 * @OA\Post(
 *     path="/api/admin/cabinets",
 *     summary="Create",
 *     tags={"Cabinet"},
 *     security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *        required=true,
 *        @OA\JsonContent(
 *            required={"number", "purpose"},
 *            @OA\Property(property="number", type="string", example="21"),
 *            @OA\Property(property="purpose", type="string", example="Russian")
 *        )
 *     ),
 *
 *     @OA\Response(
 *        response=201,
 *        description="Created",
 *        @OA\JsonContent(
 *               @OA\Property(
 *                   property="cabinet",
 *                   type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="purpose", type="string", example="Russian"),
 *                   @OA\Property(property="number", type="string", example="21"),
 *               )
 *          )
 *     )
 * ),
 *
 * @OA\Get(
 *      path="/api/admin/cabinets",
 *      summary="CabinetsInfo",
 *      tags={"Cabinet"},
 *      security={{ "bearerAuth": {} }},
 *
 *      @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *            @OA\Property(
 *                property="cabinets",
 *                type="array",
 *                @OA\Items(
 *                @OA\Property(property="id", type="integer", example=1),
 *                @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                @OA\Property(property="purpose", type="string", example="Russian"),
 *                @OA\Property(property="number", type="string", example="21"),
 *              )
 *           )
 *        )
 *     )
 * ),
 *
 * @OA\Get(
 *         path="/api/admin/cabinets/{cabinet}",
 *         summary="GetCabinetID",
 *         tags={"Cabinet"},
 *         security={{ "bearerAuth": {} }},
 *
 *         @OA\Parameter(
 *             description="Cabinet ID",
 *             in="path",
 *             name="cabinet",
 *             required=true,
 *             example=1
 *         ),
 *
 *         @OA\Response(
 *            response=200,
 *            description="Ok",
 *            @OA\JsonContent(
 *               @OA\Property(
 *                   property="cabinet",
 *                   type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                   @OA\Property(property="purpose", type="string", example="Russian"),
 *                   @OA\Property(property="number", type="string", example="21"),
 *               )
 *           )
 *       )
 *   ),
 *
 * @OA\Put(
 *       path="/api/admin/cabinets/{cabinet}",
 *       summary="Update",
 *       tags={"Cabinet"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="Cabinet ID",
 *           in="path",
 *           name="cabinet",
 *           required=true,
 *           example=1
 *       ),
 *
 *       @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"number", "purpose"},
 *             @OA\Property(property="number", type="string", example="21"),
 *             @OA\Property(property="purpose", type="string", example="Russian")
 *         )
 *      ),
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *             @OA\Property(
 *                 property="cabinet",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="updated_at", type="string", example="2024-12-20 17:49:36"),
 *                 @OA\Property(property="purpose", type="string", example="Russian"),
 *                 @OA\Property(property="number", type="string", example="21"),
 *             )
 *         )
 *     )
 * ),
 *
 * @OA\Delete(
 *       path="/api/admin/cabinets/{cabinet}",
 *       summary="Delete",
 *       tags={"Cabinet"},
 *       security={{ "bearerAuth": {} }},
 *
 *       @OA\Parameter(
 *           description="Cabinet ID",
 *           in="path",
 *           name="cabinet",
 *           required=true,
 *           example=1
 *        ),
 *
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *       )
 * ),
 */
class CabinetController extends Controller
{
    protected $cabinetService;

    public function __construct(CabinetService $cabinetService)
    {
        $this->cabinetService = $cabinetService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CabinetCollection(Cabinet::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCabinetRequest $request)
    {
        return new CabinetResource($this->cabinetService->create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cabinet $cabinet)
    {
        return new CabinetResource($cabinet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCabinetRequest $request, Cabinet $cabinet)
    {
        $this->cabinetService->update($cabinet, $request->validated());

        return new CabinetResource($cabinet);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cabinet $cabinet)
    {
        $this->cabinetService->delete($cabinet->id);

        return response()->json();
    }
}
