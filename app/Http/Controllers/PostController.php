<?php

namespace App\Http\Controllers;

use App\Action\Post\CreatePostAction;
use App\Action\Post\NewCommentAction;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\NewCommentRequest;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['create','comment']);
    }

    public function index()
    {
        return $this->ok(
            new PostCollection(Post::all()),
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
        $newPost = $createPostAction->execute($request->validated());
        return $this->created(
            PostResource::make($newPost),
        );
    }

    public function comment(Post $post, NewCommentRequest $request, NewCommentAction $newCommentAction)
    {
        $newCommentAction->execute($post, $request->user(), $request->validated());
        return $this->created();
    }
}
