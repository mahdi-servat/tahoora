<?php

namespace App\Http\Resources\Media;

use App\Http\Resources\Attachment\AttachmentCollection;
use App\Http\Resources\MetaTag\MetaTagCollection;
use App\Util;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'date' => Util::toJalali($this->created_at->format('Y-m-d')),
            'timestamp' => $this->created_at->timestamp,
            'description' => $this->description,
            'content' => $this->content,
            'meta_tags_label' => $this->when(!empty($this->tags) && count($this->tags) > 0 , new MetaTagCollection($this->tags)),
            'attachments' => $this->when(!empty($this->attachments) && count($this->attachments) > 0 , new AttachmentCollection($this->attachments))
        ];
    }
}
