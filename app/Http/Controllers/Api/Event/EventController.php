<?php

namespace App\Http\Controllers\Api\Event;

use App\Actions\Event\FindEventAction;
use App\Actions\Event\GetAllEventAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\Api\FindEventRequest;
use App\Http\Requests\Event\Api\GetAllEventRequest;
use App\Http\Resources\Event\EventCollection;
use App\Http\Resources\Event\EventResource;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(GetAllEventRequest $request)
    {
        $data = app(GetAllEventAction::class)->handle($request);

        return new EventCollection($data);
    }


    public function find(FindEventRequest $request)
    {
        $data = app(FindEventAction::class)->handle($request);

        return new EventResource($data);
    }
}
