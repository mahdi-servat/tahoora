<?php

namespace App\Http\Resources\Page;

use App\Http\Resources\Language\LanguageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $thumpUrl = null;
        if (!empty($this->thump)){
            $thumpUrl = env('APP_URL') . '/' .$this->thump;
        }
        return [
            'id' => $this->id ,
            'title'=> @$this->title ,
            'url'=> route('api.page.find' , ['url' => $this->url]) ,
            'description'=> @$this->description ,
            'content'=> @$this->content ,
            'thump' =>  $thumpUrl ,
            'language' => $this->when(!empty($this->language_id) , new LanguageResource($this->language)),
            'status_id' => @$this->status_id ,
            'status' => @$this->status->title
        ];
    }
}
