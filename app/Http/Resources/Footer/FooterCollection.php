<?php

namespace App\Http\Resources\Footer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FooterCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item['id'],
                    'title' => $item['title'],
                    'url' => $item['url'],
                    'children' => $this->when(!empty($item['children']) && (count($item['children']) > 0) , FooterResource::collection($item['children'])),
                ];
            }),
        ];
    }
}
