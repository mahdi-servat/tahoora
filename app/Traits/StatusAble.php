<?php

namespace App\Traits;

use App\Models\Comment\Comment;
use App\Models\MetaTag\MetaTag;
use App\Models\MetaTag\ModelMetaTag;
use App\Models\Status;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait StatusAble
{
    public function status(): HasOne
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
}
