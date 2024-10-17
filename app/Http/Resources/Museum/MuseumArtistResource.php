<?php

namespace App\Http\Resources\Museum;

use Illuminate\Http\Resources\Json\JsonResource;

class MuseumArtistResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->artist->id,
            'title' => $this->artist->title,
            'avatar' => $this->artist->thump,
        ];
    }
}
