<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\StoreCabinetRequest;
use App\Http\Resources\Cabinet\CabinetResource;
use App\Models\Cabinet;

class CabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CabinetResource::collection(Cabinet::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCabinetRequest $request)
    {
        $cabinet = Cabinet::create($request->validated());

        return new CabinetResource($cabinet);
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
        $cabinet->update($request->validated());

        return new CabinetResource($cabinet);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cabinet $cabinet)
    {
        $cabinet->delete();

        return response()->json([]);
    }
}
