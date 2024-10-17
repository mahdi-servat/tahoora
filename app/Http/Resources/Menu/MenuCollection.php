<?php

namespace App\Http\Resources\Menu;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MenuCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item['id'],
                    'title' => $item['title'],
                    'url' => $item['url'],
                    'children' => $this->when(!empty($item['children']) && (count($item['children']) > 0) , MenuResource::collection($item['children'])),
                ];
            }),
        ];
    }
}
