<?php

namespace App\Http\Resources\Event;

use App\Util;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ,
            'title' => $this->title,
            'thump' => env('APP_URL') . '/' .$this->thump,
            'second_title' => @$this->second_title,
            'price' => @$this->price,
            'url_path' => @$this->url_path,
            'live_url_path' => @$this->live_url_path,
            'contacts' => @$this->contacts,
            'location_text' => @$this->location_text,
            'summary' => @$this->summary,
            'content' => @$this->content,
            'start_date' => $this->when(!empty($this->start_date)  , Util::getJalaliDate(@$this->start_date)),
            'end_date' => $this->when(!empty($this->end_date)  , Util::getJalaliDate(@$this->end_date)),
        ];
    }
}
