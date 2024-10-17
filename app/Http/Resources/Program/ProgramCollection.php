<?php

namespace App\Http\Resources\Program;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProgramCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'thump' => env('APP_URL') . '/' .$item->thump,
                    'program_url' => @$item->url,
                    'sort' => @$item->sort,
                    'description' => @$item->description,
                    'url' => route('api.program.find' , ['id' => $item->id])
                ];
            }),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
