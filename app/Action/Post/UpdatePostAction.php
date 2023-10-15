<?php

namespace App\Action\Post;

use App\Models\User;
use App\Models\Post;

class UpdatePostAction
{
    public function execute(Post $post, $data): void
    {
        $post->update($data);
    }
}
