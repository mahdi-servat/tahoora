<?php

namespace App\Traits;

use App\Models\Comment\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Comments
{
    public function comments(): morphMany
    {
        return $this->morphMany(Comment::class, 'model')->whereNull('parent_id');
    }

    public function commentsCount()
    {
        return $this->morphMany(Comment::class, 'model')->count();
    }
}
