<?php

namespace App\Http\Resources\Language;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LanguageCollection extends ResourceCollection
{

    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id ,
                    'title' => $item->title,
                    'key' => $item->key,
                    'active' => @$item->active,
                    'rtl' => @$item->rtl,
                    'default' => @$item->default,
                ];
            }),
        ];
    }
}
