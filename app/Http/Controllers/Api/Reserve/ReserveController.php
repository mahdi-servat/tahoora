<?php

namespace App\Http\Controllers\Api\Reserve;

use App\Actions\Museum\GetAllMuseumAction;
use App\Actions\Reserve\CreateReserveAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Museum\MuseumCollection;
use App\Http\Resources\Reserve\ReserveResource;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function index(Request $request)
    {
        $data = app(GetAllMuseumAction::class)->handle($request);
        return new MuseumCollection($data);
    }

    public function getReserve(Request $request)
    {
        return [
            'services' => app(GetAllMuseumAction::class)->handle($request),
        ];
    }

    public function postReserve(Request $request)
    {
        return new ReserveResource(app(CreateReserveAction::class)->handle($request));
    }

}
