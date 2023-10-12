<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return ['posts'=>$this->collection];
    }
}
