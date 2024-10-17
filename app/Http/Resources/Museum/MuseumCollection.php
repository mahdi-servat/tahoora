<?php

namespace App\Http\Resources\Museum;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MuseumCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'price' => $item->price,
                    'icon' =>  !empty($item->icon) ? env('APP_URL') . '/' . $item->icon :null,
                    'summary' => @$item->summary,
                    'url' => route('api.museum.find' , ['id' => $item->id])
                ];
            }),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
