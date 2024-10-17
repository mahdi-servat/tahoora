<?php

namespace App\Http\Resources\Testimonials;

use App\Http\Resources\Museum\MuseumResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TestimonialsResources extends JsonResource
{
    public function toArray(Request $request): array
    {
        return  [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'museum_id' => new MuseumResource($this->museum),
            'thump' => !empty($this->thump) ? env('APP_URL') . '/' . $this->thump->path : null,
        ];
    }
}
