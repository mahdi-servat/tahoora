<?php

namespace App\Traits;

use App\Models\Category\ModelCategory;
use App\Models\Comment\Comment;
use App\Models\MetaTag\MetaTag;
use App\Models\MetaTag\ModelMetaTag;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait CategoryAble
{
    public function category(): MorphOne
    {
        return $this->morphOne(ModelCategory::class, 'model');
    }
}
