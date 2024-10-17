<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => [
                'id' => $this->type->id ,
                'title' => $this->type->title
            ],
            'parent' => $this->when(!empty($this->parent_id) , new CategoryResource($this->parent)),
        ];
    }
}
