<?php

namespace App\Action\Post;

use App\Models\Post;
use Illuminate\Support\Str;

class CreatePostAction
{
    public function execute(array $data): Post
    {
        $randomSlug = Str::random(4);
        return Post::create([
            'slug' => $randomSlug,
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
        ]);
    }
}
