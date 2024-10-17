<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'title' => $this->title,
            'description' => $this->description,
        ];
        if ($this->childs->count() > 0)
            $data['childs'] = CommentResource::collection($this->childs);
        return $data;
    }
}
