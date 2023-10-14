<?php

namespace App\Action\Post;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class NewCommentAction
{
    public function execute(Post $post, User $user, $data): Comment
    {
        return Comment::query()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'comment' => $data['comment'],
        ]);
    }
}
