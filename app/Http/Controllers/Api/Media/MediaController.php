<?php

namespace App\Http\Controllers\Api\Media;

use App\Actions\Media\FindMediaAction;
use App\Actions\Media\GetAllMediaAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Media\Api\FindMediaRequest;
use App\Http\Requests\Media\Api\GetAllMediaRequest;
use App\Http\Resources\Media\MediaCollection;
use App\Http\Resources\Media\MediaResource;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index(GetAllMediaRequest $request)
    {
        $data = app(GetAllMediaAction::class)->handle($request , false);

        return new MediaCollection($data);
    }


    public function find(FindMediaRequest $request)
    {
        $data = app(FindMediaAction::class)->handle($request);
        $related = $data->modelAttachments;
        $data = (new MediaResource($data))->resolve();
        $data['related'] = (new MediaCollection($related))->resolve()['data'];

        return $data;
    }
}
