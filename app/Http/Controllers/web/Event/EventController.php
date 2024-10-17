<?php

namespace App\Http\Controllers\web\Event;

use App\Actions\Event\CreateEventAction;
use App\Actions\Event\DeleteEventAction;
use App\Actions\Event\FindEventAction;
use App\Actions\Event\GetAllEventAction;
use App\Actions\Event\UpdateEventAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\Web\CreateEventRequest;
use App\Http\Requests\Event\Web\DeleteEventRequest;
use App\Http\Requests\Event\Web\FindEventRequest;
use App\Http\Requests\Event\Web\GetAllEventRequest;
use App\Http\Requests\Event\Web\StoreEventRequest;
use App\Http\Requests\Event\Web\UpdateEventRequest;
use Illuminate\Http\Request;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class EventController extends AutoWebController
{
    public function getClass() : array
    {
        return [
            'indexRequest' => GetAllEventRequest::class ,
            'createRequest' => CreateEventRequest::class ,
            'editRequest' => FindEventRequest::class ,
            'storeRequest' => StoreEventRequest::class ,
            'updateRequest' => UpdateEventRequest::class ,
            'deleteRequest' => DeleteEventRequest::class ,
            'indexAction' => GetAllEventAction::class ,
            'createAction' => CreateEventAction::class ,
            'deleteAction' => DeleteEventAction::class,
            'findAction' => FindEventAction::class,
            'updateAction' => UpdateEventAction::class,
            'form' => EventForm::class,
            'viewPath' => 'admin.layouts.event',
            'routePrefix' => 'event',
            'list_title' => 'رویداد ها',
            'add_title' => 'رویداد',
        ];
    }
}
