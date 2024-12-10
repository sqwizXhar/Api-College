<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CabinetStoreRequest;
use App\Http\Resources\CabinetResource;
use App\Models\Cabinet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CabinetResource::collection(Cabinet::with('lessons')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CabinetStoreRequest $request)
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
    public function update(CabinetStoreRequest $request, Cabinet $cabinet)
    {
        return new CabinetResource($cabinet->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cabinet $cabinet)
    {
        $cabinet->delete();

        return response()->json(['message' => 'Cabinet deleted successfully']);
    }
}
