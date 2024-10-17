<?php

namespace App\Http\Controllers\web\Category;

use App\Actions\Category\CreateCategoryAction;
use App\Actions\Category\DeleteCategoryAction;
use App\Actions\Category\FindCategoryAction;
use App\Actions\Category\GetAllCategoryAction;
use App\Actions\Category\UpdateCategoryAction;
use App\Http\Requests\Category\Web\CreateCategoryRequest;
use App\Http\Requests\Category\Web\DeleteCategoryRequest;
use App\Http\Requests\Category\Web\FindCategoryRequest;
use App\Http\Requests\Category\Web\GetAllCategorysRequest;
use App\Http\Requests\Category\Web\StoreCategoryRequest;
use App\Http\Requests\Category\Web\UpdateCategoryRequest;
use Illuminate\Support\Facades\DB;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class CategoryController extends AutoWebController
{

    public function getClass() : array
    {
        return [
            'indexRequest' => GetAllCategorysRequest::class ,
            'createRequest' => CreateCategoryRequest::class ,
            'editRequest' => FindCategoryRequest::class ,
            'storeRequest' => StoreCategoryRequest::class ,
            'updateRequest' => UpdateCategoryRequest::class ,
            'deleteRequest' => DeleteCategoryRequest::class ,
            'indexAction' => GetAllCategoryAction::class ,
            'createAction' => CreateCategoryAction::class ,
            'deleteAction' => DeleteCategoryAction::class,
            'findAction' => FindCategoryAction::class,
            'updateAction' => UpdateCategoryAction::class,
            'form' => CategoryForm::class,
            'viewPath' => 'admin.layouts.category',
            'routePrefix' => 'category',
            'list_title' => 'دسته بندی ها',
            'add_title' => 'دسته بندی',
        ];
    }
}
