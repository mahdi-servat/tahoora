<?php

namespace App\Http\Controllers\Api\Museum;

use App\Actions\Museum\FindMuseumAction;
use App\Actions\Museum\GetAllMuseumAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Museum\Api\FindMuseumRequest;
use App\Http\Requests\Museum\Api\GetAllMuseumRequest;
use App\Http\Resources\Museum\MuseumCollection;
use App\Http\Resources\Museum\MuseumResource;
use Illuminate\Http\Request;

class MuseumController extends Controller
{
    public function index(GetAllMuseumRequest $request)
    {
        $data = app(GetAllMuseumAction::class)->handle($request);

        return new MuseumCollection($data);
    }

    public function find(FindMuseumRequest $request)
    {
        $request->content_type = "api";

        $data = app(FindMuseumAction::class)->handle($request);

        return new MuseumResource($data);
    }
}
