<?php

namespace App\Http\Resources\Article;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'second_title' => @$this->second_title,
            'author' => @$this->author,
            'thump' => env('APP_URL') . '/' .$this->thump,
            'summary' => @$this->summary,
            'content' => @$this->content,
            'user' => $this->when(!empty($this->user_id) , new UserResource($this->user)),
            'category' => $this->when(!empty($this->category) , new CategoryResource(@$this->category->category)),
        ];
    }
}
