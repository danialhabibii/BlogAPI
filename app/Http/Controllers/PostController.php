<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
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
}
