<?php

namespace App\Http\Resources\Event;

use App\Util;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EventCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'second_title' => @$item->second_title,
                    'summary' => @$item->summary,
                    'price' => @$item->price,
                    'thump' => env('APP_URL') . '/' .$item->thump,
                    'start_date' => $this->when(!empty($item->start_date)  , Util::getJalaliDate(@$item->start_date)),
                    'end_date' => $this->when(!empty($item->end_date) && @$item->end_date != null , Util::getJalaliDate(@$item->end_date)),
                    'url' => route('api.event.find' , ['id' => $item->id])
                ];
            }),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
