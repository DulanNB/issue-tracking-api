<?php

namespace App\Http\Controllers;

use App\Http\Requests\Issues\IssuePostRequest;
use App\Http\Requests\Issues\IssueUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\IssueResource;
use App\Models\Images;
use App\Models\IssueCategories;
use App\Models\Issues;
use App\Models\IssueSubCategories;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class IssueController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $issues = Issues::with('images','categories','subcategories')->get();
        return CategoryResource::collection($issues);
    }

    /**
     * @param IssuePostRequest $request
     * @return Response|Application|ResponseFactory
     */
    public function store(IssuePostRequest $request): Response|Application|ResponseFactory
    {
        $last_issue = Issues::orderBy('created_at', 'DESC')->first();
        $next_id = ($last_issue) ? $last_issue->id : 0;
        $issue = Issues::create(collect($request->validated())
            ->put('uuid', '#ISSUE-' . ($next_id + 1))
            ->toArray());

        foreach ($request->images as $image)
        {
            Images::create([
                'imagable_id' => $issue->id,
                'imagable_type' => Issues::class,
                'size' => $image['size'],
                'path' => $image['path'],
                'name' => $image['name'],
                'extension' => $image['extension']
            ]);
        }

        foreach($request->categories as $category)
        {
            IssueCategories::create([
                'issue_id' => $issue->id,
                'category_id' => $category['category_id']
            ]);
        }

        foreach($request->sub_categories as $subcategory)
        {
            IssueSubCategories::create([
                'issue_id' => $issue->id,
                'subcategory_id' => $subcategory['sub_category_id']
            ]);
        }

        return response([
            'data' => new IssueResource($issue)
        ]);

    }


    public function update(IssueUpdateRequest $request, Issues $issue)
    {
        $issue->update($request->validated());

        foreach ($request->images as $image)
        {
            Images::where('id',$image['id'])
                ->where('imagable_type', Issues::class)
                ->update([
                'size' => $image['size'],
                'path' => $image['path'],
                'name' => $image['name'],
                'extension' => $image['extension']
            ]);
        }

        foreach($request->categories as $category)
        {
            IssueCategories::where('id',$category['id'])->update([
                'category_id' => $category['category_id']
            ]);
        }

        foreach($request->sub_categories as $subcategory)
        {
            IssueSubCategories::where('id', $subcategory['id'])->update([
                'subcategory_id' => $subcategory['sub_category_id']
            ]);
        }

        return response([
            'data' => new IssueResource(Issues::findOrFail($issue->id))
        ]);

    }


    /**
     * @param $id
     * @return IssueResource
     */
    public function show($id): IssueResource
    {
        $issues = Issues::with('images','categories','subcategories')->findOrFail($id);
        return new IssueResource($issues);
    }

}
