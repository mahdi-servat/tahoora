<?php

namespace App\Http\Controllers\Api\SocialMedia;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMedia\Api\GetAllSocialMediaRequest;
use App\Http\Resources\SocialMedia\SocialMediaResource;
use App\Models\Language\Language;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index(GetAllSocialMediaRequest $request)
    {
        $language = Language::where('key',app()->getLocale())->first();

        return SocialMediaResource::collection($language->socialMedia);
    }


//    public function find(FindPageRequest $request)
//    {
//        $data = app(FindPageByUrlAction::class)->handle($request);
//
//        return new PageResource($data);
//    }
}
