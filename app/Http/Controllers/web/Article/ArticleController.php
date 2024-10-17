<?php

namespace App\Http\Controllers\web\Article;

use App\Actions\Article\CreateArticleAction;
use App\Actions\Article\DeleteArticleAction;
use App\Actions\Article\FindArticleAction;
use App\Actions\Article\GetAllArticleAction;
use App\Actions\Article\UpdateArticleAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Article\Web\CreateArticleRequest;
use App\Http\Requests\Article\Web\DeleteArticleRequest;
use App\Http\Requests\Article\Web\FindArticleRequest;
use App\Http\Requests\Article\Web\GetAllArticleRequest;
use App\Http\Requests\Article\Web\StoreArticleRequest;
use App\Http\Requests\Article\Web\UpdateArticleRequest;
use Illuminate\Http\Request;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class ArticleController extends AutoWebController
{
    public function getClass() : array
    {
        return [
            'indexRequest' => GetAllArticleRequest::class ,
            'createRequest' => CreateArticleRequest::class ,
            'editRequest' => FindArticleRequest::class ,
            'storeRequest' => StoreArticleRequest::class ,
            'updateRequest' => UpdateArticleRequest::class ,
            'deleteRequest' => DeleteArticleRequest::class ,
            'indexAction' => GetAllArticleAction::class ,
            'createAction' => CreateArticleAction::class ,
            'deleteAction' => DeleteArticleAction::class,
            'findAction' => FindArticleAction::class,
            'updateAction' => UpdateArticleAction::class,
            'form' => ArticleForm::class,
            'viewPath' => 'admin.layouts.article',
            'routePrefix' => 'article',
            'list_title' => 'مقالات',
            'add_title' => 'مقاله',
        ];
    }
}
