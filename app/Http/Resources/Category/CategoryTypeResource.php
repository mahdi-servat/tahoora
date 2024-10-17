<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryTypeResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }
}
