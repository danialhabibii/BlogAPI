<?php

namespace App\Http\Controllers;

use App\Action\Category\CreateCategoryAction;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['create']);
    }

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

    public function create(CreateCategoryRequest $request, CreateCategoryAction $createCategoryAction)
    {
        $this->authorize('access', $request->user());
        $newCategory = $createCategoryAction->execute($request->validated());
        return $this->created(
            CategoryResource::make($newCategory),
        );
    }
}
