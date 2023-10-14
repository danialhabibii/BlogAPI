<?php

namespace App\Action\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

class CreatePostAction
{
    public function execute(User $user, array $data): Post
    {
        $randomSlug = Str::random(4);
        return Post::query()->create([
            'slug' => $randomSlug,
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

    }
}
