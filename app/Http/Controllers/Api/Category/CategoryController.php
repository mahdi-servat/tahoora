<?php

namespace App\Http\Controllers\Api\Category;


use App\Actions\Category\FindCategoryAction;
use App\Actions\Category\GetAllCategoryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\Api\FindCategoryRequest;
use App\Http\Requests\Category\Api\GetAllCategoryRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryTypeResource;
use App\Models\Category\CategoryType;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(GetAllCategoryRequest $request)
    {
        $data = app(GetAllCategoryAction::class)->handle($request);

        return new CategoryCollection($data);
    }


    public function find(FindCategoryRequest $request)
    {
        $data = app(FindCategoryAction::class)->handle($request);

        return new CategoryResource($data);
    }

    public function getAllType(Request $request)
    {
        return CategoryTypeResource::collection(CategoryType::all());
    }
}
