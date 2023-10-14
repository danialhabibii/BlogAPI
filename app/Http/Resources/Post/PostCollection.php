<?php

namespace App\Http\Resources\Post;

use App\Enum\WebInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return ['posts' => $this->collection];
    }

    public function paginationInformation($request, $paginated, $default)
    {
        $default['links']['myBlog'] = WebInfo::address;
        return $default;
    }
}
