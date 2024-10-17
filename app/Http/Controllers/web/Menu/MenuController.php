<?php

namespace App\Http\Controllers\web\Menu;

use App\Actions\Language\GetAllLanguageAction;
use App\Actions\Menu\CreateMenuAction;
use App\Actions\Menu\DeleteMenuAction;
use App\Actions\Menu\FindMenuAction;
use App\Actions\Menu\GetAllMenuAction;
use App\Actions\Menu\GetAllMenuByLangAction;
use App\Actions\Menu\UpdateMenuAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\Web\CreateMenuRequest;
use App\Http\Requests\Menu\Web\DeleteMenuRequest;
use App\Http\Requests\Menu\Web\FindMenuRequest;
use App\Http\Requests\Menu\Web\GetAllMenuRequest;
use App\Http\Requests\Menu\Web\StoreMenuRequest;
use App\Http\Requests\Menu\Web\UpdateMenuRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class MenuController extends AutoWebController
{
    public function getClass() : array
    {
        return [
            'indexRequest' => GetAllMenuRequest::class ,
            'createRequest' => CreateMenuRequest::class ,
            'editRequest' => FindMenuRequest::class ,
            'storeRequest' => StoreMenuRequest::class ,
            'updateRequest' => UpdateMenuRequest::class ,
            'deleteRequest' => DeleteMenuRequest::class ,
            'indexAction' => GetAllMenuAction::class ,
            'createAction' => CreateMenuAction::class ,
            'deleteAction' => DeleteMenuAction::class,
            'findAction' => FindMenuAction::class,
            'updateAction' => UpdateMenuAction::class,
            'form' => MenuForm::class,
            'viewPath' => 'admin.layouts.menu',
            'routePrefix' => 'menu',
            'list_title' => 'منو',
            'add_title' => 'منو',
        ];
    }
}
