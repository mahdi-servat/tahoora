<?php

namespace App\Http\Resources\Artist;

use App\Http\Resources\Attachment\AttachmentCollection;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\MetaTag\MetaTagResource;
use App\Http\Resources\SocialMedia\SocialMediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArtistResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'thump' => $this->when(!empty($this->thump), env('APP_URL') . '/' . @$this->thump),
            'summary' => @$this->summary,
            'content' => @$this->content,
            'website_address' => @$this->website_address,
            'social_media' => SocialMediaResource::collection($this->whenLoaded('socialMedia')),
            'meta_tags_label' => $this->when(!empty($this->tags) && count($this->tags) > 0, MetaTagResource::collection($this->tags)),
            'attachments' => $this->when(!empty($this->attachments) && count($this->attachments) > 0, new AttachmentCollection($this->attachments)),
            'comments' => $this->when(!empty($this->comments) && count($this->comments) > 0, CommentResource::collection($this->comments)),
        ];
    }
}
