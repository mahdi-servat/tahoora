<?php

namespace App\Http\Resources\Attachment;

use App\Util;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AttachmentCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'thump' => env('APP_URL') . '/' . $item->path,
                    'description' => $item->description,
                    'sort' => $item->sort,
                    'mime_type' => $item->mime_type,
                    'attachment_type' => $this->when(!empty($item->attachment_type_id), [
                        'id' => $item->attachment_type_id,
                        'title' => $item->type->title
                    ]),
                    'date' => Util::toJalali($item->created_at),
                ];
            }),
        ];
    }
}
