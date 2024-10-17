<?php

namespace App\Http\Controllers\Api\Footer;

use App\Actions\Footer\FindFooterAction;
use App\Actions\Footer\GetAllFooterByParentAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Footer\Api\FindFooterRequest;
use App\Http\Requests\Footer\Api\GetAllFooterRequest;
use App\Http\Resources\Footer\FooterCollection;
use App\Http\Resources\Footer\FooterResource;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index(GetAllFooterRequest $request)
    {
        $data = app(GetAllFooterByParentAction::class)->handle($request , false);

        return FooterResource::collection($data);
    }


    public function find(FindFooterRequest $request)
    {
        $data = app(FindFooterAction::class)->handle($request);

        return new FooterResource($data);
    }
}
