<?php

namespace App\Http\Controllers\web\Museum;

use App\Actions\Museum\CreateMuseumAction;
use App\Actions\Museum\DeleteMuseumAction;
use App\Actions\Museum\FindMuseumAction;
use App\Actions\Museum\GetAllMuseumAction;
use App\Actions\Museum\UpdateMuseumAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Museum\Web\CreateMuseumRequest;
use App\Http\Requests\Museum\Web\DeleteMuseumRequest;
use App\Http\Requests\Museum\Web\FindMuseumRequest;
use App\Http\Requests\Museum\Web\GetAllMuseumRequest;
use App\Http\Requests\Museum\Web\StoreMuseumRequest;
use App\Http\Requests\Museum\Web\UpdateMuseumRequest;
use Illuminate\Http\Request;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class MuseumController extends AutoWebController
{
    public function getClass() : array
    {
        return [
            'indexRequest' => GetAllMuseumRequest::class ,
            'createRequest' => CreateMuseumRequest::class ,
            'editRequest' => FindMuseumRequest::class ,
            'storeRequest' => StoreMuseumRequest::class ,
            'updateRequest' => UpdateMuseumRequest::class ,
            'deleteRequest' => DeleteMuseumRequest::class ,
            'indexAction' => GetAllMuseumAction::class ,
            'createAction' => CreateMuseumAction::class ,
            'deleteAction' => DeleteMuseumAction::class,
            'findAction' => FindMuseumAction::class,
            'updateAction' => UpdateMuseumAction::class,
            'form' => MuseumForm::class,
            'viewPath' => 'admin.layouts.museum',
            'routePrefix' => 'museum',
            'list_title' => 'خدمات',
            'add_title' => 'خدمت',
        ];
    }
}
