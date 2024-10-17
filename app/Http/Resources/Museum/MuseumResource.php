<?php

namespace App\Http\Resources\Museum;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\MetaTag\MetaTagCollection;
use App\Http\Resources\Testimonials\SampleTestimonialResources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MuseumResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'summary' => @$this->summary,
            'icon' => env('APP_URL') . '/' . @$this->icon,
            'content' => @$this->content,
            'thump' => env('APP_URL') . '/' . @$this->thump,
            'category' => $this->when(!empty($this->category), new CategoryResource(@$this->category->category)),
            'meta_tags_label' => $this->when(!empty($this->tags) && count($this->tags) > 0, new MetaTagCollection($this->tags)),
            'testimonials' => $this->when(!empty($this->testimonials) && count($this->testimonials) > 0, new SampleTestimonialResources($this->randomTestimonials($this->id))),
            'comments' => $this->when(!empty($this->comments) && count($this->comments) > 0, CommentResource::collection($this->comments)),
            'doctors' => MuseumArtistResource::collection($this->artists),
        ];
    }
}
