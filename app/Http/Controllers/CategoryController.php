<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\Category\StoreOrUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\UseCases\Category\IndexAction;
use App\UseCases\Category\StoreAction;
use App\UseCases\Category\DestroyAction;
use App\UseCases\Category\UpdateAction;
use App\Exceptions\DatabaseUpdateException;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexAction $action, Category $category): AnonymousResourceCollection
    {
        return CategoryResource::collection($action($category));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrUpdateRequest $request, StoreAction $action): CategoryResource
    {
        $category = $request->make_category();
        return new CategoryResource($action($category));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOrUpdateRequest $request, UpdateAction $action, Category $category, string $id): CategoryResource
    {
        try {
            $category_name = $request->name;
            return new CategoryResource($action($category, $id, $category_name));
        } catch (\Throwable $e) {
            throw new DatabaseUpdateException('カテゴリ');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Category $video, DestroyAction $action): CategoryResource
    {
        return new CategoryResource($action($video, $id));
    }
}
