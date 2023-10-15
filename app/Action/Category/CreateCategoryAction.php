<?php

namespace App\Action\Category;

use App\Models\Category;

class CreateCategoryAction
{
    public function execute(array $data): Category
    {
        return Category::query()->create([
            'title' => $data['title'],
        ]);
    }
}
