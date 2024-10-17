<?php

namespace App\Http\Resources\Menu;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'title' => $this['title'],
            'url' => $this['url'],
            'children' => $this->when(!empty($this['children']) && (count($this['children']) > 0) , MenuResource::collection($this['children'])),
        ];
    }
}
