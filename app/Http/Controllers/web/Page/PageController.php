<?php

namespace App\Http\Controllers\web\Page;

use App\Actions\Page\CreatePageAction;
use App\Actions\Page\DeletePageAction;
use App\Actions\Page\FindPageAction;
use App\Actions\Page\GetAllPageAction;
use App\Actions\Page\UpdatePageAction;
use App\Http\Controllers\Controller;

use App\Http\Requests\Page\Web\CreatePageRequest;
use App\Http\Requests\Page\Web\DeletePageRequest;
use App\Http\Requests\Page\Web\FindPageRequest;
use App\Http\Requests\Page\Web\GetAllPageRequest;
use App\Http\Requests\Page\Web\StorePageRequest;
use App\Http\Requests\Page\Web\UpdatePageRequest;
use Illuminate\Http\Request;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class PageController extends AutoWebController
{
    public function getClass() : array
    {
        return [
            'indexRequest' => GetAllPageRequest::class ,
            'createRequest' => CreatePageRequest::class ,
            'editRequest' => FindPageRequest::class ,
            'storeRequest' => StorePageRequest::class ,
            'updateRequest' => UpdatePageRequest::class ,
            'deleteRequest' => DeletePageRequest::class ,
            'indexAction' => GetAllPageAction::class ,
            'createAction' => CreatePageAction::class ,
            'deleteAction' => DeletePageAction::class,
            'findAction' => FindPageAction::class,
            'updateAction' => UpdatePageAction::class,
            'form' => PageForm::class,
            'viewPath' => 'admin.layouts.page',
            'routePrefix' => 'page',
            'list_title' => 'صفحات',
            'add_title' => 'صفحه',
        ];
    }
}
