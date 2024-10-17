<?php

namespace App\Http\Resources\News;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\User\UserResource;
use App\Util;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsCollection extends ResourceCollection
{

    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'top_title' => $item->top_title,
                    'thump' => env('APP_URL') . '/' .$item->thump,
                    'date' => Util::getJalaliDate($item->date),
                    'timestamp' => $item->created_at->timestamp,
                    'description' => $item->description,
                    'views' => $item->views,
                    'user' => $this->when(!empty($item->user_id) , new UserResource($item->user)),
                    'category' => $this->when(!empty($item->category) , new CategoryResource(@$item->category->category)),
                    'url' => route('api.news.find' , ['id' => $item->id])
                ];
            }),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
