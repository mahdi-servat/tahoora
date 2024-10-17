<?php

namespace App\Http\Resources\Media;

use App\Util;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MediaCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'thump' => env('APP_URL') . '/' .$item->thump,
                    'description' => $item->description,
                    'sort' => $item->sort,
                    'date' => Util::toJalali($item->created_at->format('Y-m-d')),
                    'timestamp' => $item->created_at->timestamp,
                ];
            }),
        ];
    }
}
