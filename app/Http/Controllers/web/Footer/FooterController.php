<?php

namespace App\Http\Controllers\web\Footer;

use App\Actions\Footer\CreateFooterAction;
use App\Actions\Footer\DeleteFooterAction;
use App\Actions\Footer\FindFooterAction;
use App\Actions\Footer\GetAllFooterAction;
use App\Actions\Footer\UpdateFooterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Footer\Web\CreateFooterRequest;
use App\Http\Requests\Footer\Web\DeleteFooterRequest;
use App\Http\Requests\Footer\Web\FindFooterRequest;
use App\Http\Requests\Footer\Web\GetAllFooterRequest;
use App\Http\Requests\Footer\Web\StoreFooterRequest;
use App\Http\Requests\Footer\Web\UpdateFooterRequest;
use Illuminate\Http\Request;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class FooterController extends AutoWebController
{
    public function getClass() : array
    {
        return [
            'indexRequest' => GetAllFooterRequest::class ,
            'createRequest' => CreateFooterRequest::class ,
            'editRequest' => FindFooterRequest::class ,
            'storeRequest' => StoreFooterRequest::class ,
            'updateRequest' => UpdateFooterRequest::class ,
            'deleteRequest' => DeleteFooterRequest::class ,
            'indexAction' => GetAllFooterAction::class ,
            'createAction' => CreateFooterAction::class ,
            'deleteAction' => DeleteFooterAction::class,
            'findAction' => FindFooterAction::class,
            'updateAction' => UpdateFooterAction::class,
            'form' => FooterForm::class,
            'viewPath' => 'admin.layouts.footer',
            'routePrefix' => 'footer',
            'list_title' => 'فوتر سایت',
            'add_title' => 'فوتر سایت',
        ];
    }
}
