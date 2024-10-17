<?php

namespace App\Http\Resources\Artist;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArtistCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'summary' => @$item->summary,
                    'website_address' => @$item->website_address,
                    'thump' => env('APP_URL') . '/' .$item->thump,
                    'url' => route('api.artist.find' , ['id' => $item->id])
                ];
            }),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
