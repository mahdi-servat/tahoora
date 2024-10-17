<?php

namespace App\Http\Resources\Language;

use App\Http\Resources\PageSetting\PageSettingResource;
use App\Http\Resources\SocialMedia\SocialMediaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id ,
            'title' => $this->title,
            'key' => $this->key,
            'active' => @$this->active,
            'rtl' => @$this->rtl,
            'social_media' => SocialMediaResource::collection($this->whenLoaded('socialMedia')),
            'page_settings' => PageSettingResource::collection($this->whenLoaded('pageSetting')),
        ];
    }
}
