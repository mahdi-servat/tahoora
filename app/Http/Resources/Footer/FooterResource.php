<?php

namespace App\Http\Resources\Footer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FooterResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['id'],
            'title' => $this['title'],
            'url' => $this['url'],
            'children' => $this->when(!empty($this['children']) && (count($this['children']) > 0) , FooterResource::collection($this['children'])),
        ];
    }
}
