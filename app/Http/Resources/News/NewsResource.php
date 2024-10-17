<?php

namespace App\Http\Resources\News;

use App\Http\Resources\Attachment\AttachmentCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\MetaTag\MetaTagCollection;
use App\Http\Resources\User\UserResource;
use App\Util;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'top_title' => $this->top_title,
            'date' => Util::getJalaliDate($this->date),
            'timestamp' => $this->created_at->timestamp,
            'thump' => env('APP_URL') . '/' . $this->thump,
            'description' => $this->description,
            'content' => $this->content,
            'views' => $this->views,
            'user' => $this->when(!empty($this->user_id), new UserResource($this->user)),
            'category' => $this->when(!empty($item->category), new CategoryResource(@$this->category->category)),
            'meta_tags_label' => $this->when(!empty($this->tags) && count($this->tags) > 0, new MetaTagCollection($this->tags)),
            'comments' => $this->when(!empty($this->comments) && count($this->comments) > 0, CommentResource::collection($this->comments)),
            'attachments' => $this->when(!empty($this->attachments) && count($this->attachments) > 0, new AttachmentCollection($this->attachments)),
//            'related' => $this->when(!empty(@$this->relatedItems()) && count(@$this->relatedItems()) > 0 , new NewsCollection(@$this->relatedItems())),
        ];

    }
}
