<?php

namespace App\Http\Controllers\web\PageSetting;

use App\Actions\PageSetting\CreatePageSettingAction;
use App\Actions\PageSetting\DeletePageSettingAction;
use App\Actions\PageSetting\FindPageSettingAction;
use App\Actions\PageSetting\GetAllPageSettingAction;
use App\Actions\PageSetting\UpdatePageSettingAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\PageSetting\Web\CreatePageSettingRequest;
use App\Http\Requests\PageSetting\Web\DeletePageSettingRequest;
use App\Http\Requests\PageSetting\Web\FindPageSettingRequest;
use App\Http\Requests\PageSetting\Web\GetAllPageSettingRequest;
use App\Http\Requests\PageSetting\Web\StorePageSettingRequest;
use App\Http\Requests\PageSetting\Web\UpdatePageSettingRequest;
use Illuminate\Http\Request;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class PageSettingController extends AutoWebController
{
    public function getClass() : array
    {
        return [
            'indexRequest' => GetAllPageSettingRequest::class ,
            'createRequest' => CreatePageSettingRequest::class ,
            'editRequest' => FindPageSettingRequest::class ,
            'storeRequest' => StorePageSettingRequest::class ,
            'updateRequest' => UpdatePageSettingRequest::class ,
            'deleteRequest' => DeletePageSettingRequest::class ,
            'indexAction' => GetAllPageSettingAction::class ,
            'createAction' => CreatePageSettingAction::class ,
            'deleteAction' => DeletePageSettingAction::class,
            'findAction' => FindPageSettingAction::class,
            'updateAction' => UpdatePageSettingAction::class,
            'form' => PageSettingForm::class,
            'viewPath' => 'admin.layouts.page_setting',
            'routePrefix' => 'pageSetting',
            'list_title' => 'تنظیمات صفحات',
            'add_title' => 'تنظیمات صفحات',
        ];
    }
}
