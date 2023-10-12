<?php

namespace App\Http\Controllers;

use App\Action\Post\CreatePostAction;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['create']);
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
            PostResource::make($post->load('category'))
        );
    }

    public function create(CreatePostRequest $request, CreatePostAction $createPostAction)
    {
        $newPost = $createPostAction->execute($request->validated());
        return $this->created(
            PostResource::make($newPost),
        );
    }
}
