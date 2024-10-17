<?php

namespace App\Http\Resources\Article;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\User\UserResource;
use App\Util;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{

    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'second_title' => @$item->second_title,
                    'author' => @$item->author,
                    'thump' => env('APP_URL') . '/' .$item->thump,
                    'summary' => @$item->summary,
                    'user' => $this->when(!empty($item->user_id) , new UserResource($item->user)),
                    'category' => $this->when(!empty($item->category) , new CategoryResource(@$item->category->category)),
                    'url' => route('api.article.find' , ['id' => $item->id])
                ];
            }),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
