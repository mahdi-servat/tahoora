<?php

namespace App\Http\Resources\MetaTag;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MetaTagCollection extends ResourceCollection
{

    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                ];
            })
        ];
    }
}
