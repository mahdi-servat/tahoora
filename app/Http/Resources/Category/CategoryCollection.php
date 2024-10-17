<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{

    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(function ($item){
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'type' => [
                        'id' => $item->type->id ,
                        'title' => $item->type->title
                    ],
                    'parent' => $this->when(!empty($item->parent_id) , new CategoryResource($item->parent)),
                ];
            }),
            'links' => [
                'self' => 'link-value',
            ],
        ];

    }
}
