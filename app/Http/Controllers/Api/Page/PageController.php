<?php

namespace App\Http\Controllers\Api\Page;

use App\Actions\Page\FindPageByUrlAction;
use App\Actions\Page\GetAllPageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Page\Api\FindPageRequest;
use App\Http\Requests\Page\Api\GetAllPageRequest;
use App\Http\Resources\Page\PageCollection;
use App\Http\Resources\Page\PageResource;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(GetAllPageRequest $request)
    {
        $data = app(GetAllPageAction::class)->handle($request);

        return new PageCollection($data);
    }


    public function find(FindPageRequest $request)
    {
        $data = app(FindPageByUrlAction::class)->handle($request);

        return new PageResource($data);
    }
}
