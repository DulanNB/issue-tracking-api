<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\CategoryPostRequest;
use App\Http\Requests\Categories\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Categories;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Throwable;

class CategoryController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection(Categories::all());
    }

    /**
     * @throws Throwable
     */
    public function store(CategoryPostRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $a;
            $category = Categories::create($request->validated());
            return new CategoryResource($category);
        });
    }

    /**
     * @param Categories $category
     * @return CategoryResource
     */
    public function show(Categories $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    /**
     * @param CategoryUpdateRequest $request
     * @param Categories $category
     * @return mixed
     * @throws Throwable
     */
    public function update(CategoryUpdateRequest $request, Categories $category): mixed
    {
        return DB::transaction(function () use ($request,$category) {
            $category->update($request->validated());
            return new CategoryResource($category);
        });
    }

    /**
     * @param Categories $category
     * @return JsonResponse
     */
    public function destroy(Categories $category): JsonResponse
    {
        $category->delete();
        return response()->json(['success' => 'category deleted!'], '200');
    }

}
