<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return $this->ok(
            new CategoryCollection(Category::all()),
        );
    }

    public function search(Category $category)
    {
        return $this->ok(
            CategoryResource::make($category->posts),
        );
    }
}
