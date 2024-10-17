<?php

namespace App\Http\Resources\Page;

use App\Http\Resources\Language\LanguageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PageCollection extends ResourceCollection
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
                $thumpUrl = null ;
                if (!empty($item->thump)){
                    $thumpUrl = env('APP_URL') . '/' .@$item->thump ;
                }

                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'thump' => $thumpUrl,
                    'description' => @$item->description,
                    'language' => $this->when(!empty($item->language_id) , new LanguageResource($item->language)),
                    'status_id' => @$item->status_id,
                    'status' => @$item->status->title,
                ];
            }),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
