<?php

namespace App\Http\Resources\MetaTag;

use Illuminate\Http\Resources\Json\JsonResource;

class MetaTagResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id ,
            'title' => $this->title,
        ];
    }
}
