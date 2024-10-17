<?php

namespace App\Http\Resources\Testimonials;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SampleTestimonialResources extends JsonResource
{
    public function toArray(Request $request): array
    {
        return  [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'thump' => !empty($this->thump) ? env('APP_URL') . '/' . $this->thump->path : null,
        ];
    }
}
