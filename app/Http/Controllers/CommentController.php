<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\CommentsStoreRequest;
use App\Http\Requests\Comments\CommentsUpdateRequest;
use App\Http\Resources\CommentsResource;
use App\Http\Resources\IssueResource;
use App\Models\Comments;
use App\Models\Images;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $comments = Comments::with('images')->get();
        return CommentsResource::collection($comments);
    }

    /**
     * @param CommentsStoreRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function store(CommentsStoreRequest $request)
    {
        $comment = Comments::create($request->validated());

        foreach ($request->images as $image)
        {
            Images::create([
                'imagable_id' => $comment->id,
                'imagable_type' => Comments::class,
                'size' => $image['size'],
                'path' => $image['path'],
                'name' => $image['name'],
                'extension' => $image['extension']
            ]);
        }

        return response([
            'data' => new IssueResource(Comments::findOrFail($comment->id))
        ]);

    }

    /**
     * @param CommentsUpdateRequest $request
     * @param Comments $comment
     * @return Application|ResponseFactory|Response
     */
    public function update(CommentsUpdateRequest $request, Comments $comment)
    {
        $comment->update($request->validated());

        foreach ($request->images as $image)
        {
            Images::where('id',$image['id'])
                ->where('imagable_type', Comments::class)
                ->update([
                    'size' => $image['size'],
                    'path' => $image['path'],
                    'name' => $image['name'],
                    'extension' => $image['extension']
                ]);
        }

        return response([
            'data' => new IssueResource(Comments::findOrFail($comment->id))
        ]);

    }

    /**
     * @param $id
     * @return IssueResource
     */
    public function show($id): IssueResource
    {
        $comment = Comments::with('images')->findOrFail($id);
        return new IssueResource($comment);
    }

}
