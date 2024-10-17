<?php

namespace App\Http\Controllers\Api\Language;

use App\Actions\Language\FindLanguageAction;
use App\Actions\Language\GetAllLanguageAction;
use App\Actions\Language\GetLanguagePageSettingAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Languages\Api\FindLanguageRequest;
use App\Http\Requests\Languages\Api\GetAllLanguageRequest;
use App\Http\Resources\Language\LanguageCollection;
use App\Http\Resources\Language\LanguageResource;
use App\Models\Language\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index(GetAllLanguageRequest $request)
    {
        $data = app(GetAllLanguageAction::class)->handle($request);

        return new LanguageCollection($data);
    }


    public function find(FindLanguageRequest $request)
    {
        $data = app(FindLanguageAction::class)->handle($request);

        $data->load('socialMedia', 'pageSetting');

        return new LanguageResource($data);
    }
    public function findByKey(FindLanguageRequest $request)
    {
        $data = Language::where('key' , $request->key)->first();

        $data->load('socialMedia' , 'pageSetting');

        return new LanguageResource($data);
    }


    public function getPageSettingAsKeyValue(Request $request)
    {
        return app(GetLanguagePageSettingAction::class)->handle($request);
    }
}
