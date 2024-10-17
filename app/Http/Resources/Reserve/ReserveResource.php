<?php

namespace App\Http\Resources\Reserve;

use App\Http\Resources\Artist\ArtistResource;
use App\Http\Resources\Museum\MuseumResource;
use App\Util;
use Illuminate\Http\Resources\Json\JsonResource;

class ReserveResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'artist' =>  new ArtistResource($this->artist),
            'museum' =>  new MuseumResource($this->museum),
            'date' =>  Util::toJalali($this->date),
        ];

    }
}
