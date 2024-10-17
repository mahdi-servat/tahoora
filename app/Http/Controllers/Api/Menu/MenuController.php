<?php

namespace App\Http\Controllers\Api\Menu;

use App\Actions\Menu\FindMenuAction;
use App\Actions\Menu\GetAllMenuByParentAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\Api\FindMenuRequest;
use App\Http\Requests\Menu\Api\GetAllMenuRequest;
use App\Http\Resources\Menu\MenuCollection;
use App\Http\Resources\Menu\MenuResource;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(GetAllMenuRequest $request)
    {
        $data = app(GetAllMenuByParentAction::class)->handle($request , false);

        return MenuResource::collection($data);
    }


    public function find(FindMenuRequest $request)
    {
        $data = app(FindMenuAction::class)->handle($request);

        return new MenuResource($data);
    }
}
