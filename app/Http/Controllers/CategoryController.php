<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Resources\CategoryResource;
use App\UseCases\Category\StoreAction;
use App\UseCases\Category\DestroyAction;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, StoreAction $action): CategoryResource
    {
        $category = $request->make_category();
        return new CategoryResource($action($category));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Category $video, DestroyAction $action): CategoryResource
    {
        return new CategoryResource($action($video, $id));
    }
}
