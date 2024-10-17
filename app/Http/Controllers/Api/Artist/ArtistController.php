<?php

namespace App\Http\Controllers\Api\Artist;

use App\Actions\Artist\FindArtistAction;
use App\Actions\Artist\GetAllArtistAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Artist\Api\FindArtistRequest;
use App\Http\Requests\Artist\Api\GetAllArtistRequest;
use App\Http\Resources\Artist\ArtistCollection;
use App\Http\Resources\Artist\ArtistResource;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index(GetAllArtistRequest $request)
    {
        $data = app(GetAllArtistAction::class)->handle($request);

        return new ArtistCollection($data);
    }

    public function find(FindArtistRequest $request)
    {
        $request->content_type = "api";

        $data = app(FindArtistAction::class)->handle($request);

        return new ArtistResource($data);
    }
}
