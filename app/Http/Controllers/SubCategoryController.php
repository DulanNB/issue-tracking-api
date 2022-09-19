<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategories\SubCategoryPostRequest;
use App\Http\Requests\SubCategories\SubCategoryUpdateRequest;
use App\Http\Resources\SubCategoryResource;
use App\Models\SubCategories;
use Illuminate\Support\Facades\DB;
use Throwable;

class SubCategoryController extends Controller
{
    public function index()
    {
        return SubCategoryResource::collection(SubCategories::all());
    }

    /**
     * @throws Throwable
     */
    public function store(SubCategoryPostRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $sub_category = SubCategories::create($request->validated());
            return new SubCategoryResource($sub_category);
        });
    }

    /**
     * @param SubCategories $sub_category
     * @return SubCategoryResource
     */
    public function show(SubCategories $sub_category): SubCategoryResource
    {
        return new SubCategoryResource($sub_category);
    }


    /**
     * @param SubCategoryUpdateRequest $request
     * @param SubCategories $category
     * @return mixed
     * @throws Throwable
     */
    public function update(SubCategoryUpdateRequest $request, SubCategories $category): mixed
    {
        return DB::transaction(function () use ($request,$category) {
            $category->update($request->validated());
            return new SubCategoryResource($category);
        });
    }

}
