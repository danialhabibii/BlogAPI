<?php

namespace App\Http\Controllers;

use App\Action\Post\CreatePostAction;
use App\Action\Post\NewCommentAction;
use App\Action\Post\UpdatePostAction;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\NewCommentRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['create', 'update', 'comment']);
    }

    public function index()
    {
        return $this->ok(
            new PostCollection(Post::paginate(10)),
        );
    }

    public function search(Post $post)
    {
        return $this->ok(
            PostResource::make($post->load('category', 'comments.user'))
        );
    }

    public function create(CreatePostRequest $request, CreatePostAction $createPostAction)
    {
        $this->authorize('access', $request->user());
        $newPost = $createPostAction->execute($request->user(), $request->validated());
        return $this->created(
            PostResource::make($newPost),
        );
    }

    public function update(Post $post, UpdatePostRequest $request, UpdatePostAction $updatePostAction)
    {
        $this->authorize('access', $request->user());
        $updatePostAction->execute($post, $request->validated());
        return $this->ok(
            PostResource::make($post)
        );
    }

    public function comment(Post $post, NewCommentRequest $request, NewCommentAction $newCommentAction)
    {
        $newCommentAction->execute($post, $request->user(), $request->validated());
        return $this->created();
    }
}
