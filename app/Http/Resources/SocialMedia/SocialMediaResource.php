<?php

namespace App\Http\Resources\SocialMedia;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialMediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ,
            'title' => $this->title,
            'key' => $this->key,
            'icon' => $this->icon,
            'value' => $this->pivot->value,
        ];
    }
}
