<?php

namespace App\Http\Controllers\web\Language;

use App\Actions\Language\CreateLanguageAction;
use App\Actions\Language\DeleteLanguageAction;
use App\Actions\Language\FindLanguageAction;
use App\Actions\Language\GetAllLanguageAction;
use App\Actions\Language\UpdateLanguageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Languages\CreateLanguageRequest;
use App\Http\Requests\Languages\DeleteLanguageRequest;
use App\Http\Requests\Languages\FindLanguageRequest;
use App\Http\Requests\Languages\GetAllLanguagesRequest;
use App\Http\Requests\Languages\StoreLanguageRequest;
use App\Http\Requests\Languages\UpdateLanguageRequest;
use Illuminate\Support\Facades\DB;
use Kris\LaravelFormBuilder\FormBuilder;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class LanguageController extends AutoWebController
{

    public function getClass() : array
    {
        return [
            'indexRequest' => GetAllLanguagesRequest::class ,
            'createRequest' => CreateLanguageRequest::class ,
            'editRequest' => FindLanguageRequest::class ,
            'storeRequest' => StoreLanguageRequest::class ,
            'updateRequest' => UpdateLanguageRequest::class ,
            'deleteRequest' => DeleteLanguageRequest::class ,
            'indexAction' => GetAllLanguageAction::class ,
            'createAction' => CreateLanguageAction::class ,
            'deleteAction' => DeleteLanguageAction::class,
            'findAction' => FindLanguageAction::class,
            'updateAction' => UpdateLanguageAction::class,
            'form' => LanguageForm::class,
            'viewPath' => 'admin.layouts.language',
            'routePrefix' => 'languages',
            'list_title' => 'زبان ها',
            'add_title' => 'زبان',
        ];
    }
}
